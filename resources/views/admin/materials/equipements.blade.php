@extends('structure')

@section('title', 'equipements')

@section('content')
<!-- Begin Page Content -->


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Equipements</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
        <nav class="navbar navbar-expand navbar-light topbar static-top">
            <form
                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                method="GET" action="{{route('materials.index')}}">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for Materials..."
                        aria-label="Search" aria-describedby="basic-addon2" name="search" list="materials" />
                    <datalist id="materials">
                        @foreach ($AllMaterials as $material)
                            <option value="{{ $material->name}}">
                                {{ $material->name }}
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
        
        <form method="GET" action="{{route('materials.index')}}">
            <div class="row">
                <!-- Sort By user status -->
                <div class="col-md-6">
                    <label for="filter" class="form-label">Filter Sort By :</label>
                    <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                        <option value="" disabled selected>Choose criteria</option>
                        <option value="type_id" {{ request('filter') === 'type_id' ? 'selected' : '' }}>Material type</option>
                        <option value="brand_id" {{ request('filter') === 'brand_id' ? 'selected' : '' }}>Material Brand</option>
                        <option value="status" {{ request('filter') === 'status' ? 'selected' : '' }}>Material Status</option>
                    </select>
                </div>

                @if(request('filter') === "type_id")
                {{-- $filter --}}
                    <div class="col-md-6">
                        <label for="order" class="form-label">By types :</label>
                        <select name="order" id="order" class="form-select">
                            @foreach($AllTypes as $type)
                            {{-- $AllMaterials->$types() as $type --}}
                                <option value="{{$type->id_type}}" {{request('order') === $type->id_type? 'selected' : ''}}>{{$type->type_name}}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif(request('filter')  === "brand_id")
                    <div class="col-md-6">
                        <label for="order" class="form-label">By Brand :</label>
                        <select name="order" id="order" class="form-select">
                            @foreach($AllBrands as $brand)
                                <option value="{{ $brand->id_brand }}" {{ request('order') === $brand->id_brand ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @elseif(request('filter')  === "status")
                    <div class="col-md-6">
                        <label for="order" class="form-label">By Status :</label>
                        <select name="order" id="order" class="form-select">
                            <option value="libre" {{ request('order') === 'libre' ? 'selected' : '' }}>Libre</option>
                            <option value="occupé" {{ request('order') === 'occupé' ? 'selected' : '' }}>Occupé</option>
                            <option value="en maintenance" {{ request('order') === 'en maintenance' ? 'selected' : '' }}>En maintenance</option>
                            <option value="réparé" {{ request('order') === 'réparé' ? 'selected' : '' }}>Réparé</option>
                        </select>
                    </div>
                @endif
        
                <!-- Button for submiting from -->
                <div class="mt-3">
                    <button type="submit" class="btn btn-dark">Applicate Sort</button>
                </div>
            </div>
        </form>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des materielles</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('materials.create') }}" class="btn btn-primary">Ajouter un materielle</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>type</th>
                            <th>brand</th>
                            <th>name</th>
                            <th>user name</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>type</th>
                            <th>brand</th>
                            <th>name</th>
                            <th>user name</th>
                            <th>status</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($materials as $material)
                            <tr>
                                <td>{{ $material->id_material }}</td>
                                <td>{{ $material->type->type_name  }} </td>
                                <td>{{ $material->brand->brand_name  }}</td>
                                <td>{{ $material->name }}</td>
                                <td>
                                    @if($material->user_id==1)
                                        <b>no user affected</b>
                                    @else
                                        <b> {{ $material->user->firstname }} {{ $material->user->lastname }}</b>
                                    @endif
                                    {{-- {{ $material->user->firstname }} {{ $material->user->lastname }} --}}
                                </td>
                                <td>{{ $material->status }}</td>
                                <td>
                                    <a href="{{ route('materials.edit', $material->id_material) }}" class="btn btn-warning">edit</a>
                                    <form action="{{ route('materials.destroy', $material->id_material) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-danger" >delete</button>
                                    </form>
                                    
                                    {{-- <a href="{{ route('materials.show', $material->id_material) }}" class="btn btn-info">show</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div>
                {{ $materials->links() }}
            </div>

        </div>
    </div>



@endsection
