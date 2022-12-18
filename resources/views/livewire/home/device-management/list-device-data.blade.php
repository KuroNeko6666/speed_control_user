<div class="p-3">
    <div class="row">
        <div class="col">
            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-body">
                        <div class="row justify-align-between">
                            <div class="col">
                                <h4 class="card-title">Admin Management</h4>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-md btn-primary dropdown-toggle text-light" data-bs-toggle="dropdown"
                                        aria-expanded="false">
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
                        @if (session()->has('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <p class="card-description">
                        <div class="form-group">
                            <input wire:model='search' type="text" class="form-control" placeholder="Search">
                        </div>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Speed
                                        </th>
                                        <th>
                                            Distance
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $data)
                                        <tr>
                                            <td>{{ $key + $datas->firstItem() }}</td>
                                            <td>{{ $data->speed }}</td>
                                            <td>{{ $data->distance }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $datas->links() }}
                        </div>
                    </div>
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
                                        <h4 class="card-title card-title-dash">Data Device Masuk</h4>
                                        <h5 class="card-subtitle card-subtitle-dash">Chart progress
                                            data {{ $current_device['name'] }}</h5>
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
                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card bg-primary card-rounded">
                            <div class="card-body pb-0">
                                <h4 class="card-title card-title-dash text-white mb-4">Status
                                    Summary
                                </h4>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p class="status-summary-ight-white mb-1">Closed Value</p>
                                        <h2 class="text-info">357</h2>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="status-summary-chart-wrapper pb-4">
                                            <canvas id="status-summary"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 grid-margin stretch-card">
                        <div class="card card-rounded">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div
                                            class="d-flex justify-content-between align-items-center mb-2 mb-sm-0">
                                            <div class="circle-progress-width">
                                                <div id="totalVisitors"
                                                    class="progressbar-js-circle pr-2"></div>
                                            </div>
                                            <div>
                                                <p class="text-small mb-2">Total Visitors</p>
                                                <h4 class="mb-0 fw-bold">26.80%</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="circle-progress-width">
                                                <div id="visitperday"
                                                    class="progressbar-js-circle pr-2"></div>
                                            </div>
                                            <div>
                                                <p class="text-small mb-2">Visits per day</p>
                                                <h4 class="mb-0 fw-bold">9065</h4>
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

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModal">Create New Device</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='store'>
                    <div class="modal-body">
                        <div class="form-group">
                            <input wire:model='name' type="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Device Name">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input wire:model='address' type="address"
                                class="form-control form-control-lg @error('address') is-invalid @enderror"
                                placeholder="Address">
                            @error('address')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModal">Update Device</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form wire:submit.prevent='update'>
                    <div class="modal-body">
                        <div class="form-group">
                            <input wire:model='name' type="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Device Name">
                            @error('name')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input wire:model='address' type="address"
                                class="form-control form-control-lg @error('address') is-invalid @enderror"
                                placeholder="Address">
                            @error('address')
                                <span class="invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModal">Delete this account?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                        wire:click='delete'>Delete</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        window.addEventListener('closeCreateModal', event => {
            $('#createModal').modal('hide')
        })
        window.addEventListener('closeUpdateModal', event => {
            $('#updateModal').modal('hide')
        })
        events = ['livewire:load', 'update']
        events.forEach(event => {
            document.addEventListener(event, function(e) {
                var graphGradient = document.getElementById("registerUserLine").getContext('2d');
                var saleGradientBg = graphGradient.createLinearGradient(5, 0, 5, 100);
                saleGradientBg.addColorStop(0, 'rgba(26, 115, 232, 0.18)');
                saleGradientBg.addColorStop(1, 'rgba(26, 115, 232, 0.02)');
                register = null
                if(e.detail != undefined){
                    register =e.detail;
                } else {
                    register = @json($data_register);
                }
                data_label = Object.keys(register)
                data_register = Object.values(register)

                var salesTopData = {
                    labels: data_label.reverse(),
                    datasets: [{
                        label: 'Data Device Masuk',
                        data: data_register.reverse(),
                        backgroundColor: saleGradientBg,
                        borderColor: [
                            '#1F3BB3',
                        ],
                        borderWidth: 1.5,
                        fill: true, // 3: no fill
                        pointBorderWidth: 1,
                        pointRadius: [4, 4, 4, 4, 4, 4, 4],
                        pointHoverRadius: [2, 2, 2, 2, 2, 2, 2],
                        pointBackgroundColor: ['#1F3BB3)', '#1F3BB3', '#1F3BB3', '#1F3BB3',
                            '#1F3BB3)', '#1F3BB3', '#1F3BB3'
                        ],
                        pointBorderColor: ['#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
                            '#fff', '#fff', '#fff', '#fff', '#fff', '#fff', '#fff',
                        ],
                    }]
                };

                var salesTopOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                drawBorder: false,
                                color: "#F0F0F0",
                                zeroLineColor: '#F0F0F0',
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 4,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false,
                            },
                            ticks: {
                                beginAtZero: false,
                                autoSkip: true,
                                maxTicksLimit: 7,
                                fontSize: 10,
                                color: "#6B778C"
                            }
                        }],
                    },
                    legend: false,
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<div class="chartjs-legend"><ul>');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            console.log(chart.data.datasets[i]); // see what's inside the obj.
                            text.push('<li>');
                            text.push('<span style="background-color:' + chart.data.datasets[i]
                                .borderColor + '">' + '</span>');
                            text.push(chart.data.datasets[i].label);
                            text.push('</li>');
                        }
                        text.push('</ul></div>');
                        return text.join("");
                    },

                    elements: {
                        line: {
                            tension: 0.4,
                        }
                    },
                    tooltips: {
                        backgroundColor: 'rgba(31, 59, 179, 1)',
                    }
                }
                var salesTop = new Chart(graphGradient, {
                    type: 'line',
                    data: salesTopData,
                    options: salesTopOptions
                });
                document.getElementById('register-user-line').innerHTML = salesTop.generateLegend();

            });
        });
    </script>
@endpush
</div>
