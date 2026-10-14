<?php

namespace App\Livewire\Website\Dashboard;

use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;

class ChangePassword extends Component
{
    public $user, $screen = 'dashboard';
    public $oldPassword, $password, $password_confirmation, $existPassword;
    public function mount($user)
    {
        $this->user = $user;
        $this->existPassword = $this->user->password;
    }
    #[On('changePasswordselectScreen')]
    public function updateScreen($screen)
    {
        $this->screen = $screen;
    }

    public function updatePassword()
    {
        $this->validate([
            'oldPassword' => 'required',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8',
        ]);

        if (!Hash::check($this->oldPassword, $this->existPassword)) {
            return $this->dispatch('error-message', 'Old Password Not Match');
        }
        auth('web')->user()->update([
            'password' => Hash::make($this->password)
        ]);
        $this->reset('oldPassword', 'password', 'password_confirmation', 'existPassword');
        return $this->dispatch('success-message', 'Password Updated Successfuly');
    }
    public function resetform()
    {
        $this->reset('oldPassword', 'password', 'password_confirmation', 'existPassword');
    }
    public function render()
    {
        return view('livewire.website.dashboard.change-password');
    }
}
