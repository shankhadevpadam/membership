<?php

namespace App\Livewire\Membership;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
class Members extends Component
{
    #[Title('Members')]
    public function render()
    {
        return view('livewire.membership.members');
    }
}
