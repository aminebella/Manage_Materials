@extends('structure')

@section('title', 'Create Material')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h1>Create new Material</h1>

            @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif

            <form action="{{ route('materials.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="type_id">Type</label>
                    <select name="type_id" id="type_id" class="form-control" required>
                        <option value="" disabled selected>-- Select a type --</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id_type }}">{{ $type->type_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="brand_id">Brand</label>
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="" disabled selected>-- Select a brand --</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id_brand }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name"> Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" required>
                </div>

                {{-- <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status" class="form-control" required>
                </div> --}}
                {{-- <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="" disabled selected>-- Sélectionnez un status --</option>
                        <option value="libre">Libre</option>
                        <option value="occupé">Occupé</option>
                        <option value="en maintenance">En Maintenance</option>
                        <option value="réparé">Réparé</option>
                    </select>
                </div> --}}

                <div class="form-group">
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="" selected>-- left it like that if you want to be free(no user) ,if not Select a user --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id_user }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add Material</button>
                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Retour</a>
            </form>
        </div>
    </div>
@endsection

