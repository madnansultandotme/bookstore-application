@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<h2>Manage Users</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete
                                </button>
                            </form>
                        @else
                            <span class="text-muted">Current User</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
