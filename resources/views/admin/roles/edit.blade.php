@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Role: {{ $role->name }}</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Role Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $role->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="permissions[]" 
                                   value="{{ $permission->id }}" 
                                   id="permission-{{ $permission->id }}"
                                   {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Role</button>
            </div>
        </form>
    </div>
</div>
@endsection