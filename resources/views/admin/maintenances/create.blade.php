@extends('structure')

@section('title', 'users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>Create Maintenance</h1>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('maintenances.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">User:</label>
                        <select id="user_id" name="user_id" class="form-control" required>
                            <option value="" disabled selected>-- Select a User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="material_id">Material:</label>
                        <select id="material_id" name="material_id" class="form-control" required>
                            <option value="" disabled selected>-- Select a meterial --</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id_material }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="en cours">En Cours</option>
                            <option value="terminé">Terminé</option>
                        </select>
                    </div> --}}
            
                    <button type="submit" class="btn btn-success">Create A Maintenance</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
    
@endsection