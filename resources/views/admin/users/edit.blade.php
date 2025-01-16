@extends('structure')

@section('title', 'users')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="container">
                <h1>Edit User</h1>
                <h2>For The User with number: <b>{{$user->id_user}}</b></h2>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('users.update', $user->id_user) }}" method="POST">
                    @csrf
                    @method('PUT') {{-- HTTP PUT request for updating the user --}}
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" value="{{ $user->firstname }}" placeholder="Enter The First Name" required>
                    </div>
            
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" value="{{ $user->lastname }}" placeholder="Enter The Last Name" required>
                    </div>
            
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Enter The Unique Email" required>
                    </div>
            
                    <div class="form-group">
                        <label for="sector_id">Sector:</label>
                        <select id="sector_id" name="sector_id" class="form-control">
                            <option value="" disabled>-- Select a Sector --</option>
                                @foreach ($sectors as $sector)
                                    <option value="{{ $sector->id_sector }}" 
                                        {{ $user->sector_id == $sector->id_sector ? 'selected' : '' }}>
                                        {{ $sector->sector_name }}
                                    </option>
                                @endforeach
                            {{-- @error('sector_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror --}}
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="role">User Type:</label>
                        <select id="role" name="role" class="form-control">
                            <option value="" disabled>-- Select a Type --</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Normal User</option>
                        </select>
                    </div>
            
                    <div class="form-group">
                        <label for="password">Password (leave blank to keep current)</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
            
                    <button type="submit" class="btn btn-primary">Update User</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
                </form>
            </div>
        </div>
    </div>
@endsection




