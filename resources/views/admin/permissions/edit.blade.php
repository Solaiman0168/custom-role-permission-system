@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Permission: {{ $permission->name }}</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label class="form-label">Assign to Roles</label>
                <div class="row">
                    @foreach($roles as $role)
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" 
                                   name="roles[]" 
                                   value="{{ $role->id }}" 
                                   id="role-{{ $role->id }}"
                                   {{ $permission->roles->contains($role->id) ? 'checked' : '' }}>
                            <label class="form-check-label" for="role-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Permission</button>
            </div>
        </form>
    </div>
</div>
@endsection