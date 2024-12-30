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
    
    <div class="container">
        <h1>Create Request</h1>
        
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf
    
            <div class="form-group">
                <label for="user_id">User</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="" disabled selected>-- Sélectionnez un Utilisateur --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id_user }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="material_id">Material</label>
                <select id="material_id" name="material_id" class="form-control" required>
                    <option value="" disabled selected>-- Sélectionnez un material --</option>
                    @foreach ($materials as $material)
                        <option value="{{ $material->id_material }}">{{ $material->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="" disabled selected>-- Sélectionnez un status --</option>
                    <option value="en attente">En Attente</option>
                    <option value="accepté">Accepté</option>
                    <option value="refusé">Refusé</option>
                </select>
            </div>
    
            <button type="submit" class="btn btn-success">Create</button>
        </form>
    </div>
</body>
</html>