<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

class AdminLivewire extends Component
{
    use WithPagination;

    public $type = "ADMIN";
    public $showModal = false;

    public $name;
    public $email;
    public $password;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ];

    public function getUsersProperty()
    {
        return User::where('user_type', strtoupper($this->type))->orderBy('created_at', 'desc')->paginate(10);
    }

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function store()
    {
        $data = $this->validate();
        $data['user_type'] = 'ADMIN';
        $data['email_verified_at'] = Carbon::now();
        $data['password'] = Hash::make($this->password);
        
        if($store = User::create($data)) {
            $this->resetData();
            $this->resetPage();
        }
        
    }

    public function render()
    {
        return view('livewire.admin')->layout('layouts.app');
    }

    private function resetData()
    {
        $this->name = "";
        $this->email = "";
        $this->password = "";
    }
}
