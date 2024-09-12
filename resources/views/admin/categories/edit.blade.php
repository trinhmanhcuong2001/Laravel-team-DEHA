@extends('admin.layouts.master')

@section('content')
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $category->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ $category->description }}">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label">Parent Category</label>
                <select class="form-control" id="parent_id" name="parent_id">
                    <option value="">None</option>
                    @foreach ($categories as $parent)
                        @if ($parent->parent_id == null && $parent->id !== $category->id)
                        <option value="{{ $parent->id }}" {{ $category->parent_id === $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
@endsection
