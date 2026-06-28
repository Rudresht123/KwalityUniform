@extends('layouts.common')

@section('content')
    <div class="col-lg-12">
        <div class="card custom-card mg-b-20 tasks">
            <div class="card-body">
                <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 pb-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Product Assignments: {{ $product->product_name }}</div>
                        <p class="mb-0 fs-12 mb-3 text-muted">Assign product to specific standards or sections</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-12">
                        <form action="{{ route('product-assignment.store') }}" method="POST" class="row g-3 align-items-end">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            
                            <div class="col-md-3">
                                <label class="form-label fs-12">Assignment Type</label>
                                <select name="assignment_type" class="form-select" required onchange="toggleAssignmentFields(this.value)">
                                    <option value="standard">Standard</option>
                                    <option value="section">Section</option>
                                </select>
                            </div>
                            
                            <div class="col-md-5" id="standard-field">
                                <label class="form-label fs-12">Select Standard</label>
                                <select name="standard_id" class="form-select">
                                    <option value="">-- Select Standard --</option>
                                    @foreach($standards as $standard)
                                        <option value="{{ $standard->id }}">{{ $standard->standard_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-5 d-none" id="section-field">
                                <label class="form-label fs-12">Select Section</label>
                                <select name="section_id" class="form-select">
                                    <option value="">-- Select Section --</option>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3">
                                    <i class="ti ti-plus me-1"></i> Assign
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datatable align-middle">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th class="text-center">Type</th>
                                <th>Assigned To</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($assignments as $assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-info-subtle text-info fs-11 rounded-pill px-2">
                                            {{ ucfirst($assignment->assignment_type) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $assignment->assignment_type == 'standard' ? $assignment->standard->standard_name : $assignment->section->section_name }}
                                    </td>
                                    <td class="text-center">
                                        <form action="{{ route('product-assignment.delete', $assignment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Are you sure you want to remove this assignment?')">
                                                <i class="ti ti-trash me-1"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4">No assignments found for this product.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleAssignmentFields(type) {
            const standardField = document.getElementById('standard-field');
            const sectionField = document.getElementById('section-field');
            
            if (type === 'standard') {
                standardField.classList.remove('d-none');
                sectionField.classList.add('d-none');
            } else {
                standardField.classList.add('d-none');
                sectionField.classList.remove('d-none');
            }
        }
    </script>
@endsection
