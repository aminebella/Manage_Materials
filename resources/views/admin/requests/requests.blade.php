@extends('structure')

@section('title', 'requests')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <h1 class="h3 mb-0 text-gray-800">requests</h1> --}}
        <a href="{{ route('requests.create') }}" class="btn btn-primary mb-3">Create Request</a>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">List Of Maintenance</h6>
            </div>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Material</th>
                                <th>Status</th>
                                <th>date of request</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($requests as $request)
                                <tr>
                                    <td>{{ $request->id_request }}</td>
                                    <td>{{ $request->user->firstname }} {{ $request->user->lastname }}</td>
                                    <td>{{ $request->material->name }}</td>
                                    <td>{{ $request->status }}</td>
                                    <td>{{ $request->created_at }}</td>
                                    <td>
                                        <a href="{{ route('requests.edit', $request->id_request) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('requests.destroy', $request->id_request) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                        @if($request->status ==='en attente')
                                            <a href="{{ route('requests.accepte', $request->id_request) }}" class="btn btn-success">Accepter</a>
                                            <a href="{{ route('requests.deny', $request->id_request) }}" class="btn btn-danger">Deny</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $requests->links() }}
        
        </div>
    </div>
@endsection
