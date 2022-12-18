<div class="row">

    <div class="col-lg-12 grid-margin stretch-card p-3">
        <div class="card">
            <div class="card-body">
                <div class="row justify-align-between">
                    <div class="col">
                        <h4 class="card-title">Admin Management</h4>
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
                                    Name
                                </th>
                                <th>
                                    address
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key => $data)
                                <tr>
                                    <td>{{ $key + $datas->firstItem() }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->address }}</td>
                                    <td>{{ $data->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datas->links() }}
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

    <script>
        window.addEventListener('closeCreateModal', event => {
            $('#createModal').modal('hide')
        })
        window.addEventListener('closeUpdateModal', event => {
            $('#updateModal').modal('hide')
        })
    </script>
</div>
