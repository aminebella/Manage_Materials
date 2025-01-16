@extends('user.structureUser')

@section('title', 'maintenance')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">maintenance</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>
<div class="container">
    <h1>maintenance</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('maintenances.create') }}" class="btn btn-primary mb-3">Create Maintenance</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Material</th>
                <th>Status</th>
                <th>date de maintenance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->id_maintenance }}</td>
                    <td>{{ $maintenance->user->firstname }} {{ $maintenance->user->lastname }}</td>
                    <td>{{ $maintenance->material->name }}</td>
                    <td>{{ $maintenance->status }}</td>
                    <td>{{ $maintenance->created_at }}</td>
                    <td>
                        <a href="{{ route('maintenances.edit', $maintenance->id_maintenance) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('maintenances.destroy', $maintenance->id_maintenance) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $maintenances->links() }}
</div>
@endsection
