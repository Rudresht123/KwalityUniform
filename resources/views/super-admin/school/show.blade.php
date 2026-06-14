@extends('layouts.common')

@section('content')
<div class="container-fluid">

    <div class="row">

        {{-- School Profile --}}
        <div class="col-xl-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body text-center p-4">

                    <div class="mb-4">

                        <img
                            src="{{ getFileUrl($school->logo_url) }}"
                            alt="{{ $school->school_name }}"
                            class="rounded-circle shadow-sm"
                            style="
                                width:140px;
                                height:140px;
                                object-fit:cover;
                                border:5px solid #fff;
                            ">

                    </div>

                    <h3 class="fw-bold mb-1">
                        {{ $school->school_name }}
                    </h3>

                    <p class="text-muted mb-3">
                        Principal: {{ $school->principal_name }}
                    </p>

                    <div class="mb-4">
                        <x-status-badge
                            :value="$school->is_active"
                            :active="true"
                            :inactive="false" />
                    </div>

                    <hr>

                    <div class="text-start">

                        <div class="d-flex align-items-center mb-3">

                            <div class="avatar avatar-sm bg-primary-transparent me-3">
                                <i class="ti ti-mail text-primary"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Email Address
                                </small>

                                <span class="fw-medium">
                                    {{ $school->email }}
                                </span>
                            </div>

                        </div>

                        <div class="d-flex align-items-center">

                            <div class="avatar avatar-sm bg-success-transparent me-3">
                                <i class="ti ti-phone text-success"></i>
                            </div>

                            <div>
                                <small class="text-muted d-block">
                                    Phone Number
                                </small>

                                <span class="fw-medium">
                                    {{ $school->phone }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Details --}}
        <div class="col-xl-8">

            {{-- Summary Cards --}}
            <div class="row g-3 mb-4">

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">

                            <small class="text-muted">
                                Affiliation Number
                            </small>

                            <h6 class="mt-2 mb-0 fw-semibold">
                                {{ $school->affiliation_no ?: 'N/A' }}
                            </h6>

                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">

                            <small class="text-muted">
                                Created On
                            </small>

                            <h6 class="mt-2 mb-0 fw-semibold">
                                {{ $school->created_at->format('d M Y') }}
                            </h6>

                        </div>
                    </div>

                </div>

                <div class="col-md-4">

                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">

                            <small class="text-muted">
                                Last Updated
                            </small>

                            <h6 class="mt-2 mb-0 fw-semibold">
                                {{ $school->updated_at->format('d M Y') }}
                            </h6>

                        </div>
                    </div>

                </div>

            </div>

            {{-- School Details --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-bottom">

                    <h5 class="mb-0">
                        <i class="ti ti-building-community me-2"></i>
                        School Information
                    </h5>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-4">

                            <label class="text-muted mb-1">
                                School Name
                            </label>

                            <div class="fw-semibold">
                                {{ $school->school_name }}
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted mb-1">
                                Principal Name
                            </label>

                            <div class="fw-semibold">
                                {{ $school->principal_name }}
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted mb-1">
                                Email Address
                            </label>

                            <div class="fw-semibold">
                                {{ $school->email }}
                            </div>

                        </div>

                        <div class="col-md-6 mb-4">

                            <label class="text-muted mb-1">
                                Phone Number
                            </label>

                            <div class="fw-semibold">
                                {{ $school->phone }}
                            </div>

                        </div>

                        <div class="col-md-12">

                            <label class="text-muted mb-1">
                                Address
                            </label>

                            <div class="fw-semibold">

                                {{ $school->address }}

                                <br>

                                {{ $school->city }},
                                {{ $school->state }}
                                - {{ $school->pincode }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Actions --}}
            <div class="mt-4 d-flex gap-2">

                <a
                    href="{{ route('school.edit', $school->school_id) }}"
                    class="btn btn-primary">

                    <i class="ti ti-edit me-1"></i>
                    Edit School

                </a>

                <a
                    href="{{ route('school.index') }}"
                    class="btn btn-outline-secondary">

                    <i class="ti ti-arrow-left me-1"></i>
                    Back

                </a>

            </div>

        </div>

    </div>

</div>
@endsection