<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        "email" => 'required|email:dns|max:255',
        "password" => 'required|max:255',
    ];

    public function submit(){
       $credential = $this->validate();
       if(auth()->attempt($credential)){
        if(auth()->user()->is_email_verified == 1){
            return redirect()->route("home");
        }
        return session()->flash('error', 'validate your account!');
       }
       return session()->flash('error', 'Login fail');
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('layouts.auth-layout');
    }
}
