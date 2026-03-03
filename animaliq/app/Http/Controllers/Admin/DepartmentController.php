<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:departments,slug',
            'mandate' => 'nullable|string',
        ]);
        Department::create($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department created.');
    }

    public function edit(Department $department)
    {
        $users = User::orderBy('first_name')->get();
        $department->load('departmentMembers.user');
        return view('admin.departments.edit', compact('department', 'users'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:departments,slug,' . $department->id,
            'mandate' => 'nullable|string',
        ]);
        $department->update($validated);
        return redirect()->route('admin.departments.index')->with('success', 'Department updated.');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted.');
    }
}
