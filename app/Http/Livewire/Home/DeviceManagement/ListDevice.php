<?php

namespace App\Http\Livewire\Home\DeviceManagement;

use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Mail\SpeedControlEmail;
use App\Models\EmailVerification;
use Illuminate\Support\Facades\Mail;

class ListDevice extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;


    public function render()
    {
        $datas =  Device::latest()->filter(["search" => $this->search])->paginate(10)->withQueryString();
        return view('livewire.home.device-management.list-device', ['datas' => $datas])
        ->layout('layouts.home-layout');
    }
}
