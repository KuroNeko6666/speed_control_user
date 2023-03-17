<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="statistics-details d-flex align-items-center justify-content-between">

                                    <div class="card card-rounded flex-fill me-3">
                                        <div class="card-body">
                                            <p class="statistics-title">Jumlah Device</p>
                                            <h3 class="rate-percentage">{{ count($devices) }}</h3>
                                        </div>
                                    </div>
                                    <div class="card card-rounded flex-fill">
                                        <div class="card-body">
                                            <p class="statistics-title">Jumlah Device Active</p>
                                            <h3 class="rate-percentage">{{ $device_active }}</h3>
                                        </div>
                                    </div>
                                    {{-- <div class="card card-rounded flex-fill">
                                        <div class="card-body">
                                            <p class="statistics-title me-3">Jumlah Device</p>
                                            <h3 class="rate-percentage">{{ count($devices) }}</h3>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-lg btn-primary dropdown-toggle text-light"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $current_device->name }}
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach ($devices as $device)
                                            <li><button class="dropdown-item"
                                                    wire:click='changeCurrent({{ $device['id'] }})'>{{ $device['name'] }}</button>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Data Device Harian</h4>
                                                        <h5 class="card-subtitle card-subtitle-dash">Grafik penampilan
                                                            data {{ $current_device['name'] }} masuk perhari.</h5>
                                                    </div>
                                                    <div id="register-user-line"></div>
                                                </div>
                                                <div class="chartjs-wrapper mt-5">
                                                    <canvas id="registerUserLine"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="card-title card-title-dash">Kecepatan hari ini</h4>
                                                        </div>
                                                        <canvas class="my-auto" id="speed"
                                                            height="200"></canvas>
                                                        <div id="speed-legend" class="mt-5 text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-3">
                                                            <h4 class="card-title card-title-dash">Kecepatan bulan ini</h4>
                                                        </div>
                                                        <canvas class="my-auto" id="speed-monthly"
                                                            height="200"></canvas>
                                                        <div id="speed-monthly-legend" class="mt-5 text-center">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 d-flex flex-column">
                                <div class="row flex-grow">
                                    <div class="col-12 grid-margin stretch-card">
                                        <div class="card card-rounded">
                                            <div class="card-body">
                                                <div class="d-sm-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h4 class="card-title card-title-dash">Data Device Bulanan</h4>
                                                        <p class="card-subtitle card-subtitle-dash">Grafik penampilan
                                                            data {{ $current_device['name'] }} masuk perbulan.</p>
                                                    </div>
                                                    <div>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                                                type="button" id="dropdownMenuButton2"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false"> This month </button>
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton2">
                                                                <h6 class="dropdown-header">Settings</h6>
                                                                <a class="dropdown-item" href="#">Action</a>
                                                                <a class="dropdown-item" href="#">Another
                                                                    action</a>
                                                                <a class="dropdown-item" href="#">Something else
                                                                    here</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Separated
                                                                    link</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                                                    <div
                                                        class="d-sm-flex align-items-center mt-4 justify-content-between">
                                                        <h2 class="me-2 fw-bold">5.000</h2>
                                                        <h4 class="me-2">DATA</h4>
                                                        <h4 class="text-success">(+100)</h4>
                                                    </div>
                                                    <div class="me-3">
                                                        <div id="monthly-register-legend"></div>
                                                    </div>
                                                </div>
                                                <div class="chartjs-bar-wrapper mt-3">
                                                    <canvas id="monthly-register"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
       @include('livewire.home.scripts.data-chart')
       @include('livewire.home.scripts.line-chart')
       @include('livewire.home.scripts.daily-speed')
       @include('livewire.home.scripts.monthly-speed')
    @endpush
</div>
