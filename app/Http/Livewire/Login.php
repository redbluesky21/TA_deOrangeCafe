<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    public function render()
    {
        return view('livewire.login');
    }
    public function store()
    {
        $this->validate();
        $login = Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);
        if ($login) {
            return redirect(route('admin.home'));
            $this->email = '';
            $this->password = '';
        } else {
            session()->flash('error', 'Periksa kembali username dan password anda');
        }
    }
}
