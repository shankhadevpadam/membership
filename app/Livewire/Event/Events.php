<?php

namespace App\Livewire\Event;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Events extends Component
{
    #[Title('Events')]
    public function render()
    {
        return view('livewire.event.events');
    }
}
