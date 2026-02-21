<?php

namespace App\Livewire\Agent\Profile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use WireElements\Pro\Components\Modal\Modal;

class ChangePassword extends Modal
{
    use LivewireAlert;

    public $agent; // Add this property

    public $old_password;

    public $password;

    public $password_confirmation;

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
            $this->close();
        }
    }

    public function mount()
    {
        $this->agent = auth()->user(); // Initialize with the currently logged-in agent
    }

    public function render()
    {
        return view('livewire.agent.profile.change-password');
    }
}
