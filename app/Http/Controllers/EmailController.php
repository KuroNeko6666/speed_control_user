<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;

use App\Models\EmailVerification;
use App\Mail\SpeedControlEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EmailController extends Controller
{
	public function index($token){

        $validator = EmailVerification::where('token', $token)->first();
        if($validator != null){
                event(new Registered($validator->user()->first()));
                $validator->user()->first()->update(['is_email_verified' => 1]);
                $validator->delete();
                return '<h3> Email berhasil divalidasi</h3>';
        }

        return '<h3>Link validator is invalid</h3>';



	}

}
