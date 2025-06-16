<?php

use App\Livewire\Membership\Type;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Type::class)
        ->assertStatus(200);
});
