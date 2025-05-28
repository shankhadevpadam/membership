<?php

namespace App\Livewire\Account;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Role;

#[Layout('components.layouts.app')]
class Roles extends Component
{
    #[Validate('required|max:255')]
    public string $name;

    public bool $editMode = false;

    public Role $role;

    public bool $showConfirmModal = false;

    public function store()
    {
        $this->validate();

        Role::create([
            'name' => $this->name
        ]);

        Flux::modal('role-modal')->close();
    }

    public function edit(int $id)
    {
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
    }

    #[Title('Roles')]
    public function render()
    {
        return view('livewire.account.roles', [
            'roles' => Role::paginate()
        ]);
    }
}
