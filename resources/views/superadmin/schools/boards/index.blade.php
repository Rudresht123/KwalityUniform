@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-semibold">
                                <i class="ti ti-list-details me-2"></i>
                                Manage School Boards
                            </h4>
                            <a href="{{ route('school-boards.create') }}" class="btn btn-primary btn-sm">
                                <i class="ti ti-plus me-1"></i> Add New Board
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>Board Name</th>
                                        <th>Description</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($boards as $board)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="fw-semibold">{{ $board->name }}</td>
                                            <td>{{ Str::limit($board->description, 50) }}</td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('school-boards.edit', $board->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="ti ti-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-danger deleteBtn" 
                                                            data-url="{{ route('school-boards.destroy', $board->id) }}" 
                                                            data-title="School Board">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </div>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted">
                                                No school boards found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $boards->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
