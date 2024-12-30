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
    <h1>Créer un Utilisateur</h1>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <input type="text" name="firstname" placeholder="Prénom" required>
        <input type="text" name="lastname" placeholder="Nom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <label for="sector_id">Secteur</label>
        <select name="sector_id" id="sector_id" class="form-control" required>
            <option value="" disabled selected>-- Sélectionnez un secteur --</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id_sector }}">{{ $sector->sector_name }}</option>
            @endforeach
        </select>
        {{-- @error('sector_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror --}}
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">Utilisateur</option>
        </select>
        <button type="submit">Créer</button>
    </form>

    <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>

</body>
</html>