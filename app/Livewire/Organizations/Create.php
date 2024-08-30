<?php

namespace App\Livewire\Organizations;

use App\Actions\CreateOrganization;
use Illuminate\Database\UniqueConstraintViolationException;
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

    public function store(): void
    {
        $this->validate();

        try {
            (new CreateOrganization(
                name: $this->name,
            ))->execute();
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', trans('This name can not be taken. Please choose another one.'));
        }
    }
}
