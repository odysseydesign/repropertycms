<?php

namespace App\Livewire\Agent\Profile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ChangePassword extends Component
{
    use LivewireAlert;

    public bool $show = false;

    public $agent;

    public $old_password;

    public $password;

    public $password_confirmation;

    #[On('open-change-password')]
    public function openModal(): void
    {
        $this->show = true;
    }

    public function closeModal(): void
    {
        $this->show = false;
        $this->reset(['old_password', 'password', 'password_confirmation']);
    }

    public function save()
    {
        if (! Hash::check($this->old_password, $this->agent->password)) {
            $this->addError('old_password', 'The provided password does not match your current password.');
        } else {
            $this->validate([
                'password' => ['required', Rules\Password::defaults()],
                'password_confirmation' => 'required_with:password|same:password',
            ]);

            $this->agent->update([
                'password' => Hash::make($this->password),
            ]);

            $this->alert('success', 'Password Updated Successfully!', [
                'toast' => true,
            ]);

            $this->dispatch('refresh');
            $this->show = false;
            $this->reset(['old_password', 'password', 'password_confirmation']);
        }
    }

    public function mount()
    {
        $this->agent = auth()->user();
    }

    public function render()
    {
        return view('livewire.agent.profile.change-password');
    }
}
