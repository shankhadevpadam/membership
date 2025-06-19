<?php

namespace App\Livewire\Account;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

#[Layout('components.layouts.app')]
class Roles extends Component
{
    use WithPagination;
    
    #[Url]
    public string $search = '';

    #[Validate('required|max:255')]
    public string $name;

    public bool $editMode = false;

    public Role $role;

    public ?Role $selectedRole = null;

    public array $selectedPermissions = [];

    public bool $showConfirmModal = false;

    public bool $showPermissionsModal = false;

    public function store()
    {
        $this->validate();

        Role::create([
            'name' => $this->name
        ]);

        $this->reset('name');

        Flux::modal('role-modal')->close();

        $this->dispatch('toast', message: 'Role created successfully.');
    }

    public function edit(int $id)
    {
        $this->resetValidation();
        
        $this->editMode = true;

        $this->role = Role::findById($id);

        $this->fill([
            'name' => $this->role->name,
        ]);

        Flux::modal('role-modal')->show();
    }

    public function update()
    {
        $this->validate();

        $this->role->update([
            'name' => $this->name,
        ]);

        $this->reset('name');

        Flux::modal('role-modal')->close();

        $this->dispatch('toast', message: 'Role updated successfully.');
    }

    public function confirmDelete(int $id)
    {
        $this->showConfirmModal = true;

        $this->role = Role::findById($id);
    }

    public function delete()
    {
        $this->role->delete();

        $this->reset();

        Flux::modals()->close();

        $this->dispatch('toast', message: 'Role deleted successfully.');
    }

    public function assignPermissions(int $roleId)
    {
        $this->selectedRole = Role::findOrFail($roleId);

        $this->selectedPermissions = $this->selectedRole->permissions->pluck('id')->toArray();

        Flux::modal('assign-permissions')->show();
    }

    #[Computed(persist: true)]
    public function groupPermissions()
    {
        $permissions = Permission::select('id', 'name')->get();

        $groupPermissions = $permissions->groupBy(function ($permission) {
            $parts = explode('_', $permission->name);

            return end($parts);
        })
            ->sortKeys();

        return $groupPermissions;
    }

    public function togglePermissionForRole($permissionId)
    {
        if (in_array($permissionId, $this->selectedPermissions)) {
            $this->selectedPermissions = array_diff($this->selectedPermissions, [$permissionId]);
        } else {
            $this->selectedPermissions[] = $permissionId;
        }
    }

    private function resetAssignmentForm()
    {
        $this->selectedRole = null;
        $this->selectedPermissions = [];
    }

    public function saveAssignment()
    {
        $this->selectedRole->syncPermissions(array_map('intval', $this->selectedPermissions));

        $this->resetAssignmentForm();

        $this->showPermissionsModal = false;

        $this->dispatch('toast', message: 'Assign permission successfully.');
    }

    #[Title('Roles')]
    public function render()
    {
        return view('livewire.account.roles', [
            'roles' => Role::where('name', 'LIKE', "{$this->search}%")->paginate(),
        ]);
    }
}
