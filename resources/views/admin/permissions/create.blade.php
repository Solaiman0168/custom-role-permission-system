@extends('layouts.admin')

@section('title', 'Create Permission')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Create New Permission</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Permission Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Permission</button>
            </div>
        </form>
    </div>
</div>
@endsection