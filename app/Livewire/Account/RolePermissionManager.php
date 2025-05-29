<?php

namespace App\Livewire\Account;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

#[Layout('components.layouts.app')]
class RolePermissionManager extends Component
{
    use WithPagination;

    public $activeTab = 'roles';

    // Role properties
    public $roleId;
    public $roleName = '';
    public $roleGuardName = 'web';

    // Permission properties
    public $permissionId;
    public $permissionName = '';
    public $permissionGuardName = 'web';

    // Assignment properties
    public $selectedRole;
    public $selectedPermissions = [];

    // Search and filters
    public $searchRoles = '';
    public $searchPermissions = '';

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'roleName' => 'required|string|max:255|unique:roles,name',
        'roleGuardName' => 'required|string|max:255',
        'permissionName' => 'required|string|max:255|unique:permissions,name',
        'permissionGuardName' => 'required|string|max:255',
    ];

    public function updatingSearchRoles()
    {
        $this->resetPage();
    }

    public function updatingSearchPermissions()
    {
        $this->resetPage();
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    // Role Methods
    public function createRole()
    {
        $this->resetRoleForm();
        $this->modal('role-form')->show();
    }

    public function editRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $this->roleId = $role->id;
        $this->roleName = $role->name;
        $this->roleGuardName = $role->guard_name;
        $this->modal('role-form')->show();
    }

    public function saveRole()
    {
        $this->validate([
            'roleName' => 'required|string|max:255|unique:roles,name,' . $this->roleId,
            'roleGuardName' => 'required|string|max:255',
        ]);

        if ($this->roleId) {
            $role = Role::findOrFail($this->roleId);
            $role->update([
                'name' => $this->roleName,
                'guard_name' => $this->roleGuardName,
            ]);
            Flux::toast('Role updated successfully!', variant: 'success');
        } else {
            Role::create([
                'name' => $this->roleName,
                'guard_name' => $this->roleGuardName,
            ]);
            Flux::toast('Role created successfully!', variant: 'success');
        }

        $this->modal('role-form')->close();
        $this->resetRoleForm();
    }

    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();
        Flux::toast('Role deleted successfully!', variant: 'success');
    }

    // Permission Methods
    public function createPermission()
    {
        $this->resetPermissionForm();
        $this->modal('permission-form')->show();
    }

    public function editPermission($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $this->permissionId = $permission->id;
        $this->permissionName = $permission->name;
        $this->permissionGuardName = $permission->guard_name;
        $this->modal('permission-form')->show();
    }

    public function savePermission()
    {
        $this->validate([
            'permissionName' => 'required|string|max:255|unique:permissions,name,' . $this->permissionId,
            'permissionGuardName' => 'required|string|max:255',
        ]);

        if ($this->permissionId) {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update([
                'name' => $this->permissionName,
                'guard_name' => $this->permissionGuardName,
            ]);
            Flux::toast('Permission updated successfully!', variant: 'success');
        } else {
            Permission::create([
                'name' => $this->permissionName,
                'guard_name' => $this->permissionGuardName,
            ]);
            Flux::toast('Permission created successfully!', variant: 'success');
        }

        $this->modal('permission-form')->close();
        $this->resetPermissionForm();
    }

    public function deletePermission($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);
        $permission->delete();
        Flux::toast('Permission deleted successfully!', variant: 'success');
    }

    // Assignment Methods
    public function assignPermissions($roleId)
    {
        $this->selectedRole = Role::findOrFail($roleId);
        $this->selectedPermissions = $this->selectedRole->permissions->pluck('id')->toArray();
        $this->modal('assign-permissions')->show();
    }

    public function saveAssignment()
    {
        $this->selectedRole->syncPermissions($this->selectedPermissions);
        Flux::toast('Permissions assigned successfully!', variant: 'success');
        $this->modal('assign-permissions')->close();
        $this->resetAssignmentForm();
    }

    public function togglePermissionForRole($permissionId)
    {
        if (in_array($permissionId, $this->selectedPermissions)) {
            $this->selectedPermissions = array_diff($this->selectedPermissions, [$permissionId]);
        } else {
            $this->selectedPermissions[] = $permissionId;
        }
    }

    // Helper Methods
    private function resetRoleForm()
    {
        $this->roleId = null;
        $this->roleName = '';
        $this->roleGuardName = 'web';
        $this->resetErrorBag(['roleName', 'roleGuardName']);
    }

    private function resetPermissionForm()
    {
        $this->permissionId = null;
        $this->permissionName = '';
        $this->permissionGuardName = 'web';
        $this->resetErrorBag(['permissionName', 'permissionGuardName']);
    }

    private function resetAssignmentForm()
    {
        $this->selectedRole = null;
        $this->selectedPermissions = [];
    }

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->searchRoles . '%')
            ->withCount('permissions')
            ->paginate(10, ['*'], 'rolesPage');

        $permissions = Permission::where('name', 'like', '%' . $this->searchPermissions . '%')
            ->withCount('roles')
            ->paginate(10, ['*'], 'permissionsPage');

        $allPermissions = Permission::all();

        return view('livewire.account.role-permission-manager', [
            'roles' => $roles,
            'permissions' => $permissions,
            'allPermissions' => $allPermissions,
        ]);
    }
}
