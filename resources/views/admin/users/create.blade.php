@extends('structure')

@section('title', 'users')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <h1>Create a New User</h1>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="Enter your First Name" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ old('lastname') }}" placeholder="Enter your Last Name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Unique Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your Password" required>
            </div>

            <div class="form-group">
                <label for="sector_id">Sector:</label>
                <select id="sector_id" name="sector_id" class="form-control" required>
                    <option value="" disabled selected>-- Select a Sector --</option>
                    @foreach($sectors as $sector)
                        <option value="{{ $sector->id_sector }}">{{ $sector->sector_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="role">User Type:</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="" disabled selected>-- Select a Type --</option>
                    <option value="admin">Admin</option>
                    <option value="user">Normal User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save User</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
        </form>

        {{-- @error('sector_id')
                <span class="text-danger">{{ $message }}</span>
        @enderror --}}

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