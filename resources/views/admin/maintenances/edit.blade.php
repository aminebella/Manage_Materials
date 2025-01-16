@extends('structure')

@section('title', 'users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>Edit Maintenance</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('maintenances.update', $maintenance->id_maintenance) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select id="user_id" name="user_id" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}" 
                                    {{ $maintenance->user_id == $user->id_user ? 'selected' : '' }}>
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="material_id">Material</label>
                        <select id="material_id" name="material_id" class="form-control" required>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id_material }}" 
                                    {{ $maintenance->material_id == $material->id_material ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="en cours" {{ $maintenance->status == 'en cours' ? 'selected' : '' }}>En Cours</option>
                            <option value="terminé" {{ $maintenance->status == 'terminé' ? 'selected' : '' }}>Terminé</option>
                        </select>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('maintenances.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div> 
@endsection