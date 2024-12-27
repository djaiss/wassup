<?php

namespace App\Livewire\Organizations;

use App\Actions\CreateOrganization as CreateOrganizationAction;
use Illuminate\Database\UniqueConstraintViolationException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateOrganization extends Component
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
            $organization = (new CreateOrganizationAction(
                name: $this->name,
            ))->execute();

            $this->redirectRoute('organizations.show', ['slug' => $organization->slug]);
        } catch (UniqueConstraintViolationException) {
            $this->addError('name', trans('This name can not be taken. Please choose another one.'));

            return;
        }
    }
}
