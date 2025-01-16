@extends('structure')

@section('title', 'users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>This is The Materials list for User : <br> <b>{{ $user->firstname }} {{ $user->lastname }}</b></h1>
                @if ($user->materials->isEmpty())
                    <h4>There is no materials for this user, give him one with button above.</h4>
                @else
                    <table class="table table-bordered" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->materials as $material)
                                <tr>
                                    <th scope="row">{{ $material->id_material }}</th>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->type->type_name ?? 'N/A' }}</td>
                                    <td>{{ $material->brand->brand_name ?? 'N/A' }}</td>
                                    <td>{{ $material->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endsection