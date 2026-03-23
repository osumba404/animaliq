<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminRoleNotification;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('first_name')->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function formCreate()
    {
        return view('admin.users._form', ['user' => null]);
    }

    public function formEdit(User $user)
    {
        return view('admin.users._form', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => ['required', 'confirmed', Password::defaults()],
            'status' => 'in:active,inactive,suspended',
            'role' => 'in:member,admin,super_admin',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = $validated['role'] ?? 'member';
        User::create($validated);
        return redirect()->route('admin.users.index')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'status' => 'in:active,inactive,suspended',
            'role' => 'in:member,admin,super_admin',
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $validated['role'] = $validated['role'] ?? 'member';
        $oldRole = $user->role;
        $user->update($validated);

        $adminRoles = ['admin', 'super_admin'];
        if (in_array($user->role, $adminRoles) && !in_array($oldRole, $adminRoles)) {
            Notification::create([
                'user_id' => $user->id,
                'type'    => 'role',
                'title'   => 'Admin access granted',
                'body'    => 'You have been granted ' . ($user->role === 'super_admin' ? 'Super Admin' : 'Admin') . ' access on Animal IQ.',
                'url'     => route('admin.dashboard'),
            ]);
            Mail::to($user->email)->send(new AdminRoleNotification($user));
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete yourself.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted.');
    }
}
