@extends('structure')

@section('title', 'users')

@section('content')
<!-- Begin Page Content -->


    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">users</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p>
    
    <nav class="navbar navbar-expand navbar-light topbar static-top">
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
            method="GET" action="{{route('users.index')}}">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for user..."
                    aria-label="Search" aria-describedby="basic-addon2" name="search" list="users" />
                <datalist id="users">
                    @foreach ($Allusers as $user)
                        <option value="{{ $user->firstname . ' ' . $user->lastname }}">
                            {{ $user->firstname . ' ' . $user->lastname }}
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
    <form method="GET" action="{{route('users.index')}}">
        <div class="row">
            <!-- Sort By user status -->
            <div class="col-md-6">
                <label for="filter" class="form-label">Sort By :</label>
                <select name="filter" id="filter" class="form-select">
                    <option value="user" {{ request('filter') === 'user' ? 'selected' : '' }}>Normal User</option>
                    <option value="admin" {{ request('filter') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
    
            <!-- Button for submiting from -->
            <div class="mt-3">
                <button type="submit" class="btn btn-dark">Applicate Sort</button>
            </div>
        </div>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Utilisateurs</h6>
        </div>
        <div class="card-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Ajouter un utilisateur</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id_user }}</td>
                                {{-- <td>{!! nl2br(wordwrap($user->firstname, 10, "\n", true)) !!} {!! nl2br(wordwrap($user->lastname, 10, "\n", true)) !!}</td> --}}
                                <td>
                                    @php
                                        $fullName = $user->firstname . ' ' . $user->lastname; // Combiner prénom et nom
                                        if (strlen($fullName) > 20) {
                                            // Si la longueur dépasse 20 caractères, insérer un retour à la ligne après le prénom
                                            $fullName = wordwrap($fullName, 20, "\n", true);
                                        }
                                    @endphp
                                    {!! nl2br(e($fullName)) !!}
                                </td>
                                
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role=="admin")
                                        <h4></h4><b>Admin</b></h4>
                                    @elseif($user->role=="user")
                                        <h4></h4><b>Normal User</b></h4>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('users.edit', $user->id_user) }}" class="btn btn-warning">edit</a>
                                    <form action="{{ route('users.destroy', $user->id_user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to remove this user, this will implicate removing the user definitivly ?')" class="btn btn-danger" >delete</button>
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
