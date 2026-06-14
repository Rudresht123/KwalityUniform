@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            {{-- LEFT SIDEBAR --}}
            <div class="col-xl-3">

                <div class="card custom-card">

                    <div class="card-body p-0">

                        <div class="vendor-cover"></div>

                        <div class="text-center p-4">

                            <span class="avatar avatar-xxl avatar-rounded profile-avatar">
                                <img src="{{ getFileUrl($vendor->logo_url) }}">
                            </span>

                            <h5 class="mt-4 mb-1">
                                {{ $vendor->business_name }}
                            </h5>

                            <p class="text-muted mb-2">
                                {{ $vendor->owner_name }}
                            </p>
                            @php
                                $statusClass = match ($vendor->status) {
                                    'approved' => 'success',
                                    'pending' => 'warning',
                                    'suspended' => 'danger',
                                    default => 'secondary',
                                };
                            @endphp

                            <span class="badge bg-{{ $statusClass }}">
                                {{ ucfirst($vendor->status) }}
                            </span>

                        </div>

                        <div class="list-group list-group-flush">

                            <a href="#overview" class="list-group-item list-group-item-action active">

                                <i class="ti ti-layout-dashboard me-2"></i>
                                Overview

                            </a>


                            {{-- Quick Stats --}}
                            <div class="card custom-card">

                                <div class="card-header">
                                    <div class="card-title">
                                        Quick Stats
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="d-flex justify-content-between mb-3">

                                        <span class="text-muted">
                                            Commission
                                        </span>

                                        <strong>
                                            {{ $vendor->commission_rate }}%
                                        </strong>

                                    </div>

                                    <div class="d-flex justify-content-between mb-3">

                                        <span class="text-muted">
                                            Status
                                        </span>

                                        <strong>
                                            {{ ucfirst($vendor->status) }}
                                        </strong>

                                    </div>

                                    <div class="d-flex justify-content-between">

                                        <span class="text-muted">
                                            Member Since
                                        </span>

                                        <strong>
                                            {{ $vendor->created_at->format('d M Y') }}
                                        </strong>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>

            {{-- RIGHT CONTENT --}}
            <div class="col-xl-9">

                <div class="card custom-card">

                    <div class="card-header">
                        <div class="card-title">
                            Vendor Information
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered align-middle mb-0">

                            <tbody>

                                <tr>
                                    <th width="250">Business Name</th>
                                    <td>{{ $vendor->business_name }}</td>
                                </tr>

                                <tr>
                                    <th>Owner Name</th>
                                    <td>{{ $vendor->owner_name }}</td>
                                </tr>

                                <tr>
                                    <th>Email Address</th>
                                    <td>{{ $vendor->email }}</td>
                                </tr>

                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $vendor->phone }}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>
                                        {{ $vendor->address }},
                                        {{ $vendor->city }},
                                        {{ $vendor->state }}
                                        -
                                        {{ $vendor->pincode }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>GST Number</th>
                                    <td>{{ $vendor->gstin ?: 'N/A' }}</td>
                                </tr>

                                <tr>
                                    <th>PAN Number</th>
                                    <td>{{ $vendor->pan_number ?: 'N/A' }}</td>
                                </tr>

                                <tr>
                                    <th>Commission Rate</th>
                                    <td>{{ $vendor->commission_rate }}%</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ ucfirst($vendor->status) }}
                                        </span>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- BANK DETAILS --}}
                <div class="card custom-card" id="bank">

                    <div class="card-header">
                        <div class="card-title">
                            Bank Information
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered align-middle mb-0">

                            <tbody>

                                <tr>
                                    <th width="250">
                                        Account Number
                                    </th>

                                    <td>
                                        {{ $vendor->bank_account_no ?: 'N/A' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>
                                        IFSC Code
                                    </th>

                                    <td>
                                        {{ $vendor->ifsc_code ?: 'N/A' }}
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

                {{-- DOCUMENTS --}}
                {{-- <div class="card custom-card" id="documents">

                <div class="card-header">
                    <div class="card-title">
                        Documents
                    </div>
                </div>

                <div class="card-body">

                    <div class="row g-3">

                        <div class="col-md-4">

                            <div class="document-card">

                                <i class="ti ti-file-certificate fs-30 text-primary"></i>

                                <h6 class="mt-3 mb-1">
                                    GST Certificate
                                </h6>

                                <small class="text-muted">
                                    Uploaded Document
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="document-card">

                                <i class="ti ti-id fs-30 text-success"></i>

                                <h6 class="mt-3 mb-1">
                                    PAN Card
                                </h6>

                                <small class="text-muted">
                                    Uploaded Document
                                </small>

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="document-card">

                                <i class="ti ti-building-bank fs-30 text-warning"></i>

                                <h6 class="mt-3 mb-1">
                                    Cancelled Cheque
                                </h6>

                                <small class="text-muted">
                                    Uploaded Document
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div> --}}


            </div> {{-- Right Content --}}
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .vendor-cover {
            height: 120px;
            background: linear-gradient(135deg,
                    #6259ca,
                    #8c68cd);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            margin-top: -55px;
            border: 4px solid #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
        }

        .list-group-item {
            border-left: 0;
            border-right: 0;
        }

        .document-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            transition: .3s;
        }

        .document-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
        }

        .timeline-item {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f1f3f9;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .table th {
            background: #f8f9fb;
            font-weight: 600;
        }

        .card-title {
            font-weight: 600;
        }
    </style>
@endpush
