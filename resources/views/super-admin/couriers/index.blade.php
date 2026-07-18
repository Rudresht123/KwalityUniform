@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title">Couriers</h5>
            <a href="{{ route('couriers.create') }}" class="btn btn-primary">Add Courier</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($couriers as $courier)
                        <tr>
                            <td>{{ $courier->name }}</td>
                            <td>{{ $courier->contact_person }}</td>
                            <td>{{ $courier->phone }}</td>
                            <td>
                                <a href="{{ route('couriers.edit', $courier->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('couriers.destroy', $courier->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $couriers->links() }}
        </div>
    </div>
</div>
@endsection
