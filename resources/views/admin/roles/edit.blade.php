@extends('admin.layouts.master')
@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
@endpush
@section('content')
    <form action="{{route('roles.update', $role->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputEmail1">Name Role</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $role->name }}">
            @error('name')
                <span id="name-error" class="error text-danger" style="display: block">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group"&ggt;>
            <label for="exampleInputPassword1">Description Role</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="description" value="{{ $role->description }}">
            @error('description')
                <span id="name-error" class="error text-danger" style="display: block">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="exampleInputPermission">Permissons</label>
            <div class="row d-flex justify-content-center mt-100">
                <div class="col-md-12">
                    <select id="choices-multiple-remove-button" placeholder="Select permissions" multiple name="permissions[]" >
                        @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}" @selected($role->permissions->contains($permission->id))>
                            {{ $permission->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="{{asset('/assets/js/main.js')}}"></script>
@endpush
