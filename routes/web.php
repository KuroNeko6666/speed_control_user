<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Home\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;
use App\Http\Livewire\Home\DeviceManagement\ListDevice;
use App\Http\Livewire\Home\DeviceManagement\ListDeviceData;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['checkstatus'])->group(function () {
    Route::get('/', function (){ return redirect()->route('home'); });
    Route::get('/home', Dashboard::class)->name("home");
    Route::get('/device/list-device', ListDevice::class);
    Route::get('/device/list-data', ListDeviceData::class);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', Login::class)->name("login");
    Route::get('/register', Register::class)->name("register");
});

Route::get('/account/validate/{token}', [EmailController::class, 'index']);
