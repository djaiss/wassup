<?php

namespace App\Livewire\Organizations;

use App\Actions\JoinOrganization as JoinOrganizationAction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Attributes\Validate;
use Livewire\Component;

class JoinOrganization extends Component
{
    #[Validate('required|string|min:3|max:255')]
    public string $name = '';

    #[Validate('required|string|min:14|max:14')]
    public string $code = '';

    public function render()
    {
        return view('livewire.organizations.join');
    }

    public function store(): void
    {
        $this->validate();

        try {
            $organization = (new JoinOrganizationAction(
                name: $this->name,
                code: $this->code,
            ))->execute();

            $this->redirectRoute('organizations.show', ['slug' => $organization->slug]);
        } catch (ModelNotFoundException) {
            $this->addError('code', trans('Please validate your information. Ask your administrators for the right information.'));

            return;
        }
    }
}
