@extends('admin.layouts.master')

@section('content')
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a href="{{ route('users.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>Create User</a>
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
    <table id="users-list" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Create at</th>
                @hasPermission('edit-user')
                <th>Action</th>
                @endhasPermission
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach ($user->roles as $role)
                            <span class="badge bg-info text-white">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td class="d-flex">
                        @hasPermission('edit-user')
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                        @endhasPermission
                        @hasPermission('delete-user')
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                        </form>
                        @endhasPermission
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endpush
