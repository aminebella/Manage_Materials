@extends('structure')

@section('title', 'equipements')

@section('content')
<!-- Begin Page Content -->


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">equipements</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

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
                            <th>status</th>
                            <th>user name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>type</th>
                            <th>brand</th>
                            <th>name</th>
                            <th>status</th>
                            <th>user name</th>
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
                                <td>{{ $material->status }}</td>
                                <td>{{ $material->user->firstname }} {{ $material->user->lastname }}</td>
                                <td>
                                    <a href="{{ route('materials.edit', $material->id_material) }}" class="btn btn-warning">edit</a>
                                    <form action="{{ route('materials.destroy', $material->id_material) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-danger" >delete</button>
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
