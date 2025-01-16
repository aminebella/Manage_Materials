@extends('structure')

@section('title', 'Edit Material')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>Edit Material</h1>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('materials.update', $material->id_material) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- HTTP PUT request for updating the material --}}
            
                    <div class="form-group">
                        <label for="type_id">Type</label>
                        <select name="type_id" id="type_id" class="form-control" required>
                            <option value="" disabled selected>-- Select a type --</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id_type }}" 
                                    {{ $material->type_id == $type->id_type ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type_id">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control" required>
                            <option value="" disabled selected>-- Select a brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id_brand }}" 
                                    {{ $material->brand_id == $brand->id_brand ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ $material->name }}" required>
                    </div>
                    
                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" class="form-control" value="{{ $material->status }}" required>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="libre" {{ $material->status == 'libre' ? 'selected' : '' }}>Libre</option>
                            <option value="occupé" {{ $material->status == 'occupé' ? 'selected' : '' }}>Occupé</option>
                            <option value="en maintenance" {{ $material->status == 'en maintenance' ? 'selected' : '' }}>En Maintenance</option>
                            <option value="réparé" {{ $material->status == 'réparé' ? 'selected' : '' }}>Réparé</option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" class="form-control" value="{{ $material->status }}" required readonly>
                    </div>
                    
                    <div class="form-group">
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="{{1}}"
                            @if($material->user_id===1)
                                selected
                            @endif>-- left it like that if you want to be free(no user) ,if not Select a user --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id_user }}" 
                                    @if($material->user_id!=1)
                                        {{ $material->user_id == $user->id_user ? 'selected' : '' }}
                                    @endif>
                                    {{ $user->firstname }} {{ $user->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update Material</button>
                </form>

                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
@endsection
    




