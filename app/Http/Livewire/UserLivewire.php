<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class UserLivewire extends Component
{
    public function getUsersProperty()
    {
        return User::where('user_type', 'USER')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function render()
    {
        return view('livewire.user');
    }
}
