<?php

namespace App\Http\Livewire\Home\DeviceManagement;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Device;
use Livewire\Component;
use App\Models\DeviceData;
use Livewire\WithPagination;


class ListDeviceData extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $user;
    public $devices;
    public $current_device, $current_data;
    public $data_register;
    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $user_devices = $this->user->device()->get();
        $this->devices = [];
        foreach ($user_devices as $key => $user_device) {
            $this->devices[] = $user_device->device()->first();
        }
        if($this->current_device == null){
            $this->current_device = $this->devices[0];
            $this->current_data = $this->current_device->data()->get();
            for ($i=0; $i < 7 ; $i++) {
                $count =  DeviceData::where('device_id', $this->current_device->id)->whereDate( 'created_at', Carbon::today()->subDay($i))->count();
                $date = Carbon::today()->subDay($i)->toDateString();
                $this->data_register[$date] = $count;
            }
        }
        // dd($this->current_data);
    }

    public function changeCurrent(Device $device)
    {
        $this->current_device = $device;
        $this->current_data = $device->data()->get();
        $register = [];
        for ($i=0; $i < 7 ; $i++) {
            $count =  DeviceData::where('device_id', $device->id)->whereDate( 'created_at', Carbon::today()->subDay($i))->count();
            $date = Carbon::today()->subDay($i)->toDateString();
            $register[$date] = $count;
        }
        $this->data_register= $register;
        $this->dispatchBrowserEvent('update', $this->data_register);
    }

    public function render()
    {
        $datas = DeviceData::where('device_id', $this->current_device->id)->filter(['search' => $this->search])->paginate(10)->withQueryString();
        return view('livewire.home.device-management.list-device-data', ['datas' => $datas])
        ->layout('layouts.home-layout');
    }
}
