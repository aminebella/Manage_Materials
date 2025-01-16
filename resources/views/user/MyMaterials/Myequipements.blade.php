@extends('user.structureUser')

@section('title', 'My equipements')

@section('content')
<!-- Begin Page Content -->


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">My equipements</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mes Matériels</h6>
        </div>
        <div class="card-body">
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
                                <td>{{ $material->user_id }}</td>
                                <td>
                                    <form action="{{ route('user.my-materials.maintenance') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="material_id" value="{{ $material->id_material }}">
                                        <button type="submit" class="btn btn-warning">Envoyer en Maintenance</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 

            <!-- Pagination links -->
            <div>
                {{-- {{ $materials->links() }} --}}
            </div>

        </div>
    </div>



@endsection
