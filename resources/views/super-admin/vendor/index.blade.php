@extends('layouts.common')

@section('content')
    {{-- Table Section --}}
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between">
                    <div>
                        <div class="card-title">Vendors</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage All Vendors From Here</p>
                    </div>
                    <div class="mb-0 fs-12 mb-3 text-muted">
                        <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-sm">
                            <i class="ti ti-plus"></i>
                            Add Vendor
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Business Name</th>
                                <th>Owner Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>City</th>

                                <th>Status</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($vendors as $vendor)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $vendor->business_name }}</td>

                                    <td>{{ $vendor->owner_name }}</td>

                                    <td>{{ $vendor->email }}</td>

                                    <td>{{ $vendor->owner_mobile }}</td>

                                    <td>{{ $vendor->city }}</td>


                                    <td>
                                        <x-status-badge :value="$vendor->is_active" active="1" inactive="0" />

                                    </td>



                                    <td>

                                        <div class="btn-list">

                                            <x-show :url="route('vendor.show', $vendor->vendor_id)" title="View Vendor" />


                                            <x-edit-button :url="route('vendor.edit', $vendor->vendor_id)" title="Edit Vendor" />


                                            <x-delete-button :url="route('deleteRecord', [
                                                'table' => $vendor->getTable(),
                                                'id' => $vendor->vendor_id,
                                            ])" :id="$vendor->vendor_id" title="Delete Vendor" />



                                        </div>

                                    </td>

                                </tr>

                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Section --}}
@endsection
