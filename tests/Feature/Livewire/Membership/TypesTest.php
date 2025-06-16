<?php

use Livewire\Livewire;
use App\Livewire\Membership\Types;

it('renders successfully', function () {
    Livewire::test(Types::class)
        ->assertStatus(200);
});
