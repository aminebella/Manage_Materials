@extends('structure')

@section('title', 'maintenance')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">maintenance</h1> --}}
        <a href="{{ route('maintenances.create') }}" class="btn btn-primary mb-3">Create Maintenance</a>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <nav class="navbar navbar-expand navbar-light topbar static-top">
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            method="GET" action="{{route('maintenances.index')}}">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for Maintenance..."
                    aria-label="Search" aria-describedby="basic-addon2" name="search" list="maintenances" />
                <datalist id="maintenances">
                    @foreach ($Allmaintenances as $maintenance)
                        <option value="{{ $maintenance->material->name}}">
                            {{-- {{ $maintenance->material->id_material}} --}}
                            {{ $maintenance->material->name}}
                        </option>
                    @endforeach
                </datalist>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>  
    </nav>

    <form method="GET" action="{{route('maintenances.index')}}">
        <div class="row">
            <!-- Sort By user status -->
            <div class="col-md-6">
                <label for="filter" class="form-label">Filter Sort By :</label>
                <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                    <option value="" disabled selected>Choose criteria</option>
                    <option value="status" {{ request('filter') === 'status' ? 'selected' : '' }}>maintenance status</option>
                    <option value="created_at" {{ request('filter') === 'created_at' ? 'selected' : '' }}>Date Begin Maintenance</option>
                    <option value="updated_at" {{ request('filter') === 'updated_at' ? 'selected' : '' }}>Date End Maintenance</option>
                </select>
            </div>

            @if(request('filter') === "created_at")
                <div class="col-md-6">
                    <label for="order" class="form-label">By the Begining Date of maintenance :</label>
                    <select name="order" id="order" class="form-select">
                        <option value="desc" {{request('order') === 'desc'? 'selected' : ''}}>Desc</option>
                        <option value="asc" {{request('order') === 'asc'? 'selected' : ''}}>Asc</option>
                    </select>
                </div>
            @elseif(request('filter') === "updated_at")
                <div class="col-md-6">
                    <label for="order" class="form-label">By the Ending Date of maintenance :</label>
                    <select name="order" id="order" class="form-select">
                        <option value="desc" {{request('order') === 'desc'? 'selected' : ''}}>Desc</option>
                        <option value="asc" {{request('order') === 'asc'? 'selected' : ''}}>Asc</option>
                    </select>
                </div>
            @elseif(request('filter')  === "status")
                <div class="col-md-6">
                    <label for="order" class="form-label">By Status :</label>
                    <select name="order" id="order" class="form-select">
                        <option value="en cours" {{ request('order') === 'en cours' ? 'selected' : '' }}>en cours</option>
                        <option value="terminé" {{ request('order') === 'terminé' ? 'selected' : '' }}>terminé</option>  
                    </select>
                </div>
            @endif
    
            <!-- Button for submiting from -->
            <div class="mt-3">
                <button type="submit" class="btn btn-dark">Applicate Sort</button>
            </div>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Of Maintenance</h6>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Material</th>
                                <th>Status</th>
                                <th>date start maintenance</th>
                                <th>date end maintenance</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Material</th>
                                <th>Status</th>
                                <th>date start maintenance</th>
                                <th>date end maintenance</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($maintenances as $maintenance)
                                <tr>
                                    <td>{{ $maintenance->id_maintenance }}</td>
                                    <td>{{ $maintenance->user->firstname }} {{ $maintenance->user->lastname }}</td>
                                    <td>{{ $maintenance->material->name }}</td>
                                    <td>{{ $maintenance->status }}</td>
                                    <td>{{ $maintenance->created_at }}</td>
                                    <td>
                                        @if($maintenance->status === "terminé")
                                            {{ $maintenance->updated_at }}
                                        @else
                                            <b>Still in Maintenance</b>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('maintenances.edit', $maintenance->id_maintenance) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('maintenances.destroy', $maintenance->id_maintenance) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @if($maintenance->status==="en cours")
                                            <a href="{{ route('maintenances.finish', $maintenance->id_maintenance) }}" class="btn btn-info">End the Maintenance</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $maintenances->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
