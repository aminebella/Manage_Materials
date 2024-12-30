@extends('structure')

@section('title', 'users')

@section('content')
<!-- Begin Page Content -->


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">users</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Utilisateurs</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id_user }}</td>
                                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning">edit</a>
                                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-danger" >delete</button>
                                    </form>
                                    {{-- <a href="{{ route('users.destroy', $user->id_user) }}" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')" class="btn btn-danger">Supprimer</a> --}}

                                    <a href="{{ route('users.show', $user->id_user) }}" class="btn btn-info">show</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div>
                {{ $users->links() }}
            </div>

        </div>
    </div>



@endsection
