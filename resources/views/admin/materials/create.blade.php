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
    <h1>Créer un Materielle</h1>
    <form action="{{ route('materials.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Type</label>
            <select name="type_id" id="type_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez un type --</option>
                @foreach($types as $type)
                    <option value="{{ $type->id_type }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">Type</label>
            <select name="brand_id" id="brand_id" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez une brand --</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id_brand }}">{{ $brand->brand_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="name"> Name</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        {{-- <div class="form-group">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" class="form-control" required>
        </div> --}}
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" class="form-control" required>
                <option value="" disabled selected>-- Sélectionnez un status --</option>
                <option value="libre">Libre</option>
                <option value="occupé">Occupé</option>
                <option value="en maintenance">En Maintenance</option>
                <option value="réparé">Réparé</option>
            </select>
        </div>

        <select name="user_id" id="user_id" class="form-control" required>
            <option value="" disabled selected>-- Sélectionnez une user --</option>
            @foreach($users as $user)
                <option value="{{ $user->id_user }}">{{ $user->firstname }} {{ $user->lastname }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Add Material</button>
    </form>

    <a href="{{ route('materials.index') }}" class="btn btn-secondary">Retour</a>

</body>
</html>