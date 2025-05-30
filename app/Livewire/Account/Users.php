<?php

namespace App\Livewire\Account;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class Users extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Validate('required|max:255')]
    public string $name;

    public bool $editMode = false;

    #[Title('Users')]
    public function render()
    {
        return view('livewire.account.users', [
            'users' => User::where('name', 'LIKE', "{$this->search}%")->paginate(),
        ]);
    }
}
