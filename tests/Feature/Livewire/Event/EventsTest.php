<?php

use App\Livewire\Event\Events;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Events::class)
        ->assertStatus(200);
});
