@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Edit Courier</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('couriers.update', $courier->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $courier->name }}" required>
                </div>
                <div class="form-group mb-3">
                    <label>API Integration Key</label>
                    <input type="text" name="api_integration_key" class="form-control" value="{{ $courier->api_integration_key }}">
                </div>
                <div class="form-group mb-3">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ $courier->contact_person }}">
                </div>
                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $courier->phone }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('couriers.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
