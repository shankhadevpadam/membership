<?php

namespace App\Livewire\Membership;

use Flux\Flux;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\MembershipType;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
class Types extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    public MembershipType $type;

    #[Validate('required|max:255')]
    public string $name;

    #[Validate('required|numeric|min:0')]
    public float $amount;

    public int $duration = 1;

    public bool $isActive = true;

    public bool $editMode = false;

    public bool $showConfirmModal = false;

    public function store()
    {
        $this->validate();

        MembershipType::create([
            'name' => $this->name,
            'amount' => $this->amount,
            'duration_years' => $this->duration,
            'is_active' => $this->isActive,
        ]);

        $this->reset('name', 'amount', 'duration', 'isActive');

        Flux::modal('type-modal')->close();

        $this->dispatch('toast', message: 'Membership Type created successfully.');
    }

    public function edit(int $id)
    {
        $this->resetValidation();
        
        $this->editMode = true;

        $this->type = MembershipType::find($id);

        $this->fill([
            'name' => $this->type->name,
            'amount' => $this->type->amount,
            'duration' => $this->type->duration_years,
            'isActive' => $this->type->is_active,
        ]);

        Flux::modal('type-modal')->show();
    }

    public function update()
    {
        $this->validate();

        $this->type->update([
            'name' => $this->name,
            'amount' => $this->amount,
            'duration_years' => $this->duration,
            'is_active' => $this->isActive,
        ]);

        $this->reset('name', 'amount', 'duration', 'isActive');

        Flux::modal('type-modal')->close();

        $this->dispatch('toast', message: 'Membership Type updated successfully.');
    }

    public function confirmDelete(int $id)
    {
        $this->showConfirmModal = true;

        $this->type = MembershipType::find($id);
    }

    public function delete()
    {
        $this->type->delete();

        $this->reset();

        Flux::modals()->close();

        $this->dispatch('toast', message: 'Membership Type deleted successfully.');
    }

    #[Title('Membership Types')]
    public function render()
    {
        return view('livewire.membership.types', [
            'types' => MembershipType::where('name', 'LIKE', "{$this->search}%")->paginate(),
        ]);
    }
}
