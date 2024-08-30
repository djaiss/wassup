<?php

namespace App\Livewire\Organizations;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    public function render()
    {
        return view('livewire.organizations.create');
    }

    public function save(): void
    {}
}
