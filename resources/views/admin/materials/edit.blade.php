<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    {{-- Assuming a layout file exists --}}
    {{-- @extends('admin.layout') 
    @section('content') --}}
    <div class="container">
        <h1>Edit Material</h1>
        
        <form action="{{ route('materials.update', $material->id_material) }}" method="POST">
            @csrf
            @method('PUT') {{-- HTTP PUT request for updating the material --}}
    
            <select name="type_id" id="type_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez un type --</option>
                @foreach($types as $type)
                    <option value="{{ $type->id_type }}" 
                        {{ $material->type_id == $type->id_type ? 'selected' : '' }}>
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>

            <select name="brand_id" id="brand_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez un brand --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id_brand }}" 
                        {{ $material->brand_id == $brand->id_brand ? 'selected' : '' }}>
                        {{ $brand->brand_name }}
                    </option>
                @endforeach
            </select>
            
            
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $material->name }}" required>
            </div>
            
            {{-- <div class="form-group">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="{{ $material->status }}" required>
            </div> --}}
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="libre" {{ $material->status == 'libre' ? 'selected' : '' }}>Libre</option>
                    <option value="occupé" {{ $material->status == 'occupé' ? 'selected' : '' }}>Occupé</option>
                    <option value="en maintenance" {{ $material->status == 'en maintenance' ? 'selected' : '' }}>En Maintenance</option>
                    <option value="réparé" {{ $material->status == 'réparé' ? 'selected' : '' }}>Réparé</option>
                </select>
            </div>
            
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez un user --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" 
                        {{ $material->user_id == $user->id_user ? 'selected' : '' }}>
                        {{ $user->firstname }} {{ $user->lastname }}
                    </option>
                @endforeach
            </select>
    
            <button type="submit" class="btn btn-primary">Update Material</button>
        </form>

        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Retour</a>
    </div>
    {{-- @endsection --}}
</body>
</html>




