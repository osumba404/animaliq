<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DepartmentAddedNotification;
use App\Models\Department;
use App\Models\DepartmentMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('departmentMembers')->with('departmentMembers.user')->orderBy('name')->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    public function create()
    {
        $users = User::orderBy('first_name')->get();
        return view('admin.departments.create', compact('users'));
    }

    public function formCreate()
    {
        return view('admin.departments._form', ['department' => null]);
    }

    public function formEdit(Department $department)
    {
        return view('admin.departments._form', ['department' => $department]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150',
            'mandate' => 'nullable|string',
            'admin_sections' => 'nullable|array',
            'admin_sections.*' => 'string|in:' . implode(',', array_keys(config('admin_sections.assignable_sections', []))),
        ]);
        $validated['slug'] = $this->uniqueSlugForDepartment(
            $validated['slug'] ?: Str::slug($validated['name']),
            null
        );
        $validated['admin_sections'] = array_values($validated['admin_sections'] ?? []);
        Department::create($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department created.');
    }

    public function edit(Department $department)
    {
        $users = User::orderBy('first_name')->get();
        $department->load('departmentMembers.user');
        $memberUserIds = $department->departmentMembers->pluck('user_id')->all();
        return view('admin.departments.edit', compact('department', 'users', 'memberUserIds'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150',
            'mandate' => 'nullable|string',
            'admin_sections' => 'nullable|array',
            'admin_sections.*' => 'string|in:' . implode(',', array_keys(config('admin_sections.assignable_sections', []))),
        ]);
        $validated['slug'] = $this->uniqueSlugForDepartment(
            $validated['slug'] ?: Str::slug($validated['name']),
            $department->id
        );
        $validated['admin_sections'] = array_values($validated['admin_sections'] ?? []);
        $department->update($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department updated.');
    }

    public function addMember(Request $request, Department $department)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position_title' => 'nullable|string|max:150',
            'is_lead' => 'boolean',
        ]);
        if ($department->departmentMembers()->where('user_id', $validated['user_id'])->exists()) {
            return back()->with('error', 'User is already a member of this department.');
        }
        $department->departmentMembers()->create([
            'user_id'        => $validated['user_id'],
            'position_title' => $validated['position_title'] ?? null,
            'is_lead'        => $request->boolean('is_lead'),
            'display_order'  => $department->departmentMembers()->max('display_order') + 1,
        ]);

        $addedUser = User::find($validated['user_id']);
        if ($addedUser) {
            Mail::to($addedUser->email)->queue(
                new DepartmentAddedNotification($addedUser, $department, $validated['position_title'] ?? null)
            );
        }

        return back()->with('success', 'Member added.');
    }

    public function removeMember(Department $department, DepartmentMember $member)
    {
        if ($member->department_id !== $department->id) {
            abort(404);
        }
        $member->delete();
        return back()->with('success', 'Member removed.');
    }

    private function uniqueSlugForDepartment(string $slug, ?int $excludeId): string
    {
        $base = Str::slug($slug);
        $base = $base ?: 'department';
        $candidate = $base;
        $n = 1;
        while (true) {
            $q = Department::where('slug', $candidate);
            if ($excludeId !== null) {
                $q->where('id', '!=', $excludeId);
            }
            if (!$q->exists()) {
                return $candidate;
            }
            $candidate = $base . '-' . (++$n);
            if (strlen($candidate) > 150) {
                $candidate = substr($base, 0, 147) . '-' . $n;
            }
        }
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted.');
    }
}
