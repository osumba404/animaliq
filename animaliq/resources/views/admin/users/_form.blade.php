@php $isEdit = isset($user); @endphp
<form action="{{ $isEdit ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" class="max-w-md">
    @csrf
    @if($isEdit) @method('PUT') @endif
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">First name</label><input type="text" name="first_name" value="{{ old('first_name', $user->first_name ?? '') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Last name</label><input type="text" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" class="theme-input w-full" required></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Email</label>@if($isEdit)<input type="hidden" name="email" value="{{ $user->email }}"><input type="email" value="{{ $user->email }}" class="theme-input w-full" readonly>@else<input type="email" name="email" value="{{ old('email') }}" class="theme-input w-full" required>@endif</div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Phone</label><input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="theme-input w-full"></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Password {{ $isEdit ? '(leave blank to keep)' : '' }}</label><input type="password" name="password" class="theme-input w-full" {{ $isEdit ? '' : 'required' }}></div>
    @if(!$isEdit)
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Confirm password</label><input type="password" name="password_confirmation" class="theme-input w-full" required></div>
    @endif
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Role</label><select name="role" class="theme-input w-full">
        <option value="member" {{ old('role', $user->role ?? 'member') === 'member' ? 'selected' : '' }}>Member</option>
        <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="super_admin" {{ old('role', $user->role ?? '') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
    </select></div>
    <div class="mb-4"><label class="block font-medium theme-text-secondary mb-1">Status</label><select name="status" class="theme-input w-full">
        <option value="active" {{ old('status', $user->status ?? 'active') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status', $user->status ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="suspended" {{ old('status', $user->status ?? '') === 'suspended' ? 'selected' : '' }}>Suspended</option>
    </select></div>
    <button type="submit" class="theme-btn">{{ $isEdit ? 'Update' : 'Create' }}</button>
    <button type="button" class="ml-2 theme-btn-outline" onclick="document.getElementById('crud-modal').classList.add('hidden');document.body.style.overflow='';">Cancel</button>
</form>
