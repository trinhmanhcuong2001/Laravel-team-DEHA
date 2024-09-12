@extends('admin.layouts.master')

@section('content')
<div class="card-header bg-white text-black d-flex justify-content-between align-items-center">
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-2"><i class="mdi mdi-plus-circle mr-2"></i>Add New Category</a>
    <form method="GET" action="{{ route('categories.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by Name or Description" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
</div>
    <table id="categories-list" class="table dt-responsive nowrap w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Parent</th>
                @hasPermission('edit-category')
                <th>Actions</th>
                @endhasPermission
            </tr>
        </thead>
        <tbody>
            @php
                $displayedCategories = [];
            @endphp
            @foreach ($categories as $key => $category)
                @if(!in_array($category->id, $displayedCategories))
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->parent ? $category->parent->name : 'None' }}</td>
                    <td class="d-flex">
                        @hasPermission('edit-category')
                        <a href="{{ route('categories.edit', $category->id) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                        @endhasPermission
                        @hasPermission('delete-category')
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                        </form>
                        @endhasPermission
                    </td>
                </tr>
                
                @foreach ($categories as $childKey => $child)
                    @if ($child->parent_id === $category->id)
                    <tr>
                        <td>{{ $child->id }}</td>
                        <td>-- {{ $child->name }}</td>
                        <td>{{ $child->description }}</td>
                        <td>{{ $child->parent->name }}</td>
                        <td class="d-flex">
                            @hasPermission('edit-category')
                                <a href="{{ route('categories.edit', $child->id) }}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                            @endhasPermission
                            @hasPermission('delete-category')
                                <form action="{{ route('categories.destroy', $child->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure to delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-icon btn"><i class="mdi mdi-delete"></i></button>
                                </form>
                            @endhasPermission
                        </td>
                        
                    </tr>
                    @php
                        $displayedCategories[] = $child->id;
                    @endphp
                    @endif
                @endforeach
                @endif
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
