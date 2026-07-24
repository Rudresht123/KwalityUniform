@extends('layouts.common')

@section('content')
<div class="container-fluid">
    <div class="row">
        {{-- Request Form --}}
        <div class="col-md-4">
            <h4 class="fw-bold">Request New Tie-up</h4>
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('tieups.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select School</label>
                            <select name="school_id" class="form-control" required>
                                <option value="">Choose School...</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Categories</label>
                            <div class="checkbox-group">
                                @foreach($categories as $cat)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $cat->category_id }}" id="cat_{{ $cat->category_id }}">
                                        <label class="form-check-label" for="cat_{{ $cat->category_id }}">{{ $cat->category_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Existing Requests --}}
        <div class="col-md-8">
            <h4 class="fw-bold">My Tie-up Requests</h4>
            <div class="card custom-card">
                <div class="card-body">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>School</th>
                                <th>Category</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tieups as $tieup)
                                <tr>
                                    <td>{{ $tieup->school->school_name ?? 'N/A' }}</td>
                                    <td>{{ $tieup->category->category_name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-{{ $tieup->status == 'approved' ? 'success' : ($tieup->status == 'rejected' ? 'danger' : 'warning') }}">{{ ucfirst($tieup->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
