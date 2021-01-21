<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class UserLivewire extends Component
{
    use WithPagination;

    public $type = "USER";
    public $showModal = false;

    public function getUsersProperty()
    {
        return User::where('user_type', strtoupper($this->type))->whereHas('locations')->orderBy('created_at', 'desc')->paginate(10);
    }

    public function render()
    {
        return view('livewire.user')->layout('layouts.app');
    }
}
