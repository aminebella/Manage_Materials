@extends('structure')

@section('title', 'users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>Edit Request</h1>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('requests.update', $request->id_request) }}" method="POST">
                    @csrf
                    @method('PUT')
            
                    <div class="form-group">
                        <label for="user_id">User</label>
                        <select id="user_id" name="user_id" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->id_user }}" 
                                    {{ $request->user_id == $user->id_user ? 'selected' : '' }}>
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
                                    {{ $request->material_id == $material->id_material ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="en attente" {{ $request->status == 'en attente' ? 'selected' : '' }}>En Attente</option>
                            <option value="accepté" {{ $request->status == 'accepté' ? 'selected' : '' }}>Accepté</option>
                            <option value="refusé" {{ $request->status == 'refusé' ? 'selected' : '' }}>Refusé</option>
                        </select>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('requests.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection