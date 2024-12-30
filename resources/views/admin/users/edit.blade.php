
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
        <h1>Edit User</h1>
        
        <form action="{{ route('users.update', $user->id_user) }}" method="POST">
            @csrf
            @method('PUT') {{-- HTTP PUT request for updating the user --}}
    
            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $user->firstname }}" required>
            </div>
    
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $user->lastname }}" required>
            </div>
    
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
    
            <div class="form-group">
                <label for="sector_id">Sector</label>
                <select id="sector_id" name="sector_id" class="form-control">
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id_sector }}" 
                            {{ $user->sector_id == $sector->id_sector ? 'selected' : '' }}>
                            {{ $sector->sector_name }}
                        </option>
                    @endforeach
                    @error('sector_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </select>
            </div>
    
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
    
            <div class="form-group">
                <label for="password">Password (leave blank to keep current)</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>
    
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>

        <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
    </div>
    {{-- @endsection --}}
</body>
</html>




