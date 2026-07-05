@extends('layouts.common')

@section('title', 'Partnership Requests')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div
                    class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Partnership Requests</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Manage and approve partnership requests from schools and
                            vendors</p>
                    </div>
                    <div class="filter-wrapper d-flex align-items-center">
                        <label class="me-2 mb-0 fs-12 text-muted">Filter by Type:</label>
                        <select id="partnership-type-filter" class="form-select form-select-sm d-inline-block"
                            style="width: auto;" onchange="filterRequests()">
                            <option value="school">School Requests</option>
                            <option value="vendor">Vendor Requests</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <!-- School Requests Table -->
                    <div id="school-requests-container" class="request-container">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>School Name</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Document</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schoolRequests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->school_name }}</td>
                                        <td>{{ $request->contact_person }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->phone }}</td>
                                        <td><a href="{{ getFileUrl($request->document_path) }}" target="_blank"
                                                class="btn btn-sm btn-info">View Document</a></td>
                                        <td>
                                            <div class="btn-list">
                                                <button onclick="handleAction('approve', 'school', {{ $request->id }})"
                                                    class="action-badge success-badge" title="Approve">
                                                    <i class="ti-check"></i>
                                                </button>
                                                <button onclick="handleAction('reject', 'school', {{ $request->id }})"
                                                    class="action-badge delete-badge" title="Reject">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Vendor Requests Table -->
                    <div id="vendor-requests-container" class="request-container" style="display: none;">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Category</th>
                                    <th>Email</th>
                                    <th>GSTIN</th>
                                    <th>Document</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendorRequests as $request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $request->company_name }}</td>
                                        <td>{{ $request->category }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->gstin }}</td>
                                        <td><a href="{{ getFileUrl($request->document_path) }}" target="_blank"
                                                class="btn btn-sm btn-info">View Document</a></td>
                                        <td>
                                            <div class="btn-list">
                                                <button onclick="handleAction('approve', 'vendor', {{ $request->id }})"
                                                    class="btn btn-sm btn-success" title="Approve">
                                                    <i class="ti-check"></i>
                                                </button>
                                                <button onclick="handleAction('reject', 'vendor', {{ $request->id }})"
                                                    class="btn btn-sm btn-danger" title="Reject">
                                                    <i class="ti ti-x"></i>
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

            <script>
                function filterRequests() {
                    const type = document.getElementById('partnership-type-filter').value;
                    const schoolContainer = document.getElementById('school-requests-container');
                    const vendorContainer = document.getElementById('vendor-requests-container');

                    if (type === 'school') {
                        schoolContainer.style.display = 'block';
                        vendorContainer.style.display = 'none';
                    } else {
                        schoolContainer.style.display = 'none';
                        vendorContainer.style.display = 'block';
                    }
                }

                async function handleAction(action, type, id) {
                    const isApprove = action === 'approve';
                    const title = isApprove ? 'Approve Request' : 'Reject Request';
                    const text = isApprove ?
                        'Are you sure you want to approve this partnership request? This will create a user account.' :
                        'Are you sure you want to reject this partnership request?';
                    const icon = isApprove ? 'success' : 'error';
                    const confirmButtonText = isApprove ? 'Yes, Approve it!' : 'Yes, Reject it!';

                    const result = await Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonText: confirmButtonText,
                        cancelButtonText: 'Cancel',
                        reverseButtons: true,
                        customClass: {
                            confirmButton: isApprove ? 'btn btn-success' : 'btn btn-danger',
                            cancelButton: 'btn btn-light'
                        },
                        buttonsStyling: false
                    });

                    if (!result.isConfirmed) return;

                    // Show Loading
                    Swal.fire({
                        title: 'Processing...',
                        text: `Please wait while we ${action} the request.`,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    try {
                        let url = '';
                        if (isApprove) {
                            url = type === 'school' 
                                ? `/super-admin/partnerships/approve-school/${id}` 
                                : `/super-admin/partnerships/approve-vendor/${id}`;
                        } else {
                            url = `/super-admin/partnerships/reject/${type}/${id}`;
                        }

                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        });
                        const data = await response.json();

                        if (data.success) {
                            await Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: data.message,
                                confirmButtonText: 'Continue',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                },
                                buttonsStyling: false
                            });
                            location.reload();
                        } else {
                            throw new Error(data.message || 'Something went wrong.');
                        }
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            text: error.message,
                            confirmButtonText: 'Close',
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        });
                    }
                }
            </script>
        </div>
    </div>
    
@endsection
