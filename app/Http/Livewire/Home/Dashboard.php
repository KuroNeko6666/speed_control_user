<?php

namespace App\Http\Livewire\Home;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use App\Models\DeviceData;

class Dashboard extends Component
{

    public $user;
    public $devices;
    public $device_active;
    public $current_device, $current_data;
    public $data_register, $today_register, $yesterday_register, $monthly_register;
    public $daily_speed, $monthly_speed;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $user_devices = $this->user->device()->get();
        $this->devices = [];
        foreach ($user_devices as $key => $user_device) {
            $this->devices[] = $user_device->device()->first();
        }
        $this->device_active = $user_device->device()->first()->filter(['status' => 'active'])->count();
        if($this->current_device == null){
            $this->current_device = $this->devices[0];
            $this->current_data = $this->current_device->data()->get();

            for ($i=0; $i < 7 ; $i++) {
                $count =  DeviceData::where('device_id', $this->current_device->id)->whereDate( 'created_at', Carbon::today()->subDay($i))->count();
                $date = Carbon::today()->subDay($i)->toDateString();
                $this->data_register[$date] = $count;
            }

            for ($i=0; $i < 12; $i++) {
                $count = DeviceData::where('device_id', $this->current_device->id)->whereMonth('created_at', Carbon::now()->subMonth($i)->month)->count();
                $month = Carbon::now()->subMonth($i)->month;
                $this->monthly_register[$month] = $count;
            }
            $this->getSpeedData();
            $this->today_register = $this->data_register[Carbon::today()->toDateString()];
            $this->yesterday_register = $this->today_register - $this->data_register[Carbon::today()->subDay(1)->toDateString()];
        }

    }

    public function changeCurrent(Device $device)
    {
        $this->current_device = $device;
        $this->current_data = $device->data()->get();
        $register = [];
        $monthly = [];

        for ($i=0; $i < 7 ; $i++) {
            $count =  DeviceData::where('device_id', $device->id)->whereDate( 'created_at', Carbon::today()->subDay($i))->count();
            $date = Carbon::today()->subDay($i)->toDateString();
            $register[$date] = $count;
        }
        for ($i=0; $i < 12; $i++) {
            $count = DeviceData::where('device_id', $this->current_device->id)->whereMonth('created_at', Carbon::now()->subMonth($i)->month)->count();
            $month = Carbon::now()->subMonth($i)->month;
            $monthly[$month] = $count;
         }
        $this->getSpeedData();
        $this->data_register= $register;
        $this->monthly_register = $monthly;
        $this->today_register = $this->data_register[Carbon::today()->toDateString()];
        $this->yesterday_register = $this->today_register - $this->data_register[Carbon::today()->subDay(1)->toDateString()];

        $data_update = [
            'daily_register' => $this->data_register,
            'monthly_register' => $this->monthly_register,
            'daily_speed' => $this->daily_speed,
            'monthly_speed' => $this->monthly_speed,
        ];
        $this->dispatchBrowserEvent('update', $data_update);
    }

    private function getSpeedData(){
        $slow = [];
        $normal = [];
        $fast = [];
        $slow_m = [];
        $normal_m = [];
        $fast_m = [];
        $device_data = DeviceData::where('device_id', $this->current_device->id)->whereDate( 'created_at', Carbon::today())->get();
        $device_data_month = DeviceData::where('device_id', $this->current_device->id)->whereMonth('created_at', Carbon::now()->month)->get();

        foreach ($device_data as $value) {
            $speed = $value['speed'];
            if($speed <= 30){
                $slow[] = $speed;
            }
            if($speed > 30 && $speed < 80){
                $normal[] = $speed;
            }
            if($speed >= 80){
                $fast[] = $speed;
            }
        }

        foreach ($device_data_month as $value) {
            $speed = $value['speed'];
            if($speed <= 30){
                $slow_m[] = $speed;
            }
            if($speed > 30 && $speed < 80){
                $normal_m[] = $speed;
            }
            if($speed >= 80){
                $fast_m[] = $speed;
            }
        }

        $this->daily_speed = [count($slow), count($normal), count($fast)];
        $this->monthly_speed = [count($slow_m), count($normal_m), count($fast_m)];
    }

    public function render()
    {
        return view('livewire.home.dashboard')
        ->layout('layouts.home-layout');
    }
}
