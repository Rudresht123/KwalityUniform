@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="card custom-card">
            <div class="card-body">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tieups as $tieup)
                            <tr>
                                <td>{{ $tieup->vendor->business_name ?? 'N/A' }}</td>
                                <td>{{ $tieup->category->category_name ?? 'N/A' }}</td>
                                <td>

                                    @if ($tieup->status == 'approved')
                                        <span class="badge bg-success-transparent">

                                            <i class="ri-checkbox-circle-fill me-1"></i>

                                            Approved

                                        </span>
                                    @elseif($tieup->status == 'rejected')
                                        <span class="badge bg-danger-transparent">

                                            <i class="ri-close-circle-fill me-1"></i>

                                            Rejected

                                        </span>
                                    @else
                                        <span class="badge bg-warning-transparent">

                                            <i class="ri-time-fill me-1"></i>

                                            Pending

                                        </span>
                                    @endif

                                </td>
                                <td>
                                    <div class="btn-list">

                                        <button class="btn btn-icon btn-success-light btn-wave approveTieup"
                                            data-id="{{ $tieup->id }}" title="Approve">

                                            <i class="ri-check-line"></i>

                                        </button>

                                        <button class="btn btn-icon btn-danger-light btn-wave rejectTieup"
                                            data-id="{{ $tieup->id }}" title="Reject">

                                            <i class="ri-close-line"></i>

                                        </button>

                                        <button class="btn btn-icon btn-info-light btn-wave" title="View">

                                            <i class="ri-eye-line"></i>

                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
