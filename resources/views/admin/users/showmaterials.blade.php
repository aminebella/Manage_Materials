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
        <h1>Matériels de l'utilisateur : {{ $user->firstname }} {{ $user->lastname }}</h1>
    
        @if ($user->materials->isEmpty())
            <p>Aucun matériel attribué à cet utilisateur.</p>
        @else
            <table class="table table-bordered" class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Type</th>
                        <th scope="col">Marque</th>
                        <th scope="col">Status</th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($user->materials as $material)
                        <tr>
                            <th scope="row">{{ $material->id_material }}</th>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->type->type_name ?? 'N/A' }}</td>
                            <td>{{ $material->brand->brand_name ?? 'N/A' }}</td>
                            <td>{{ $material->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
    </div>
</body>
</html>