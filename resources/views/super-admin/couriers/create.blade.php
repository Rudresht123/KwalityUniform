@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ isset($courier) ? 'Edit Courier' : 'Add Courier' }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ isset($courier) ? route('couriers.update', $courier->id) : route('couriers.store') }}" method="POST">
                @csrf
                @if(isset($courier)) @method('PUT') @endif
                
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $courier->name ?? old('name') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label>API Integration Key</label>
                    <input type="text" name="api_integration_key" class="form-control" value="{{ $courier->api_integration_key ?? old('api_integration_key') }}">
                </div>
                <div class="form-group mb-3">
                    <label>Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" value="{{ $courier->contact_person ?? old('contact_person') }}">
                </div>
                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ $courier->phone ?? old('phone') }}">
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($courier) ? 'Update' : 'Save' }}</button>
                <a href="{{ route('couriers.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
