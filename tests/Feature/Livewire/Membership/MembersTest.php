<?php

use App\Livewire\Membership\Members;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Members::class)
        ->assertStatus(200);
});
