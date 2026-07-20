@extends('layouts.common')

@section('content')
    <div class="container-fluid">
        <!-- Filter Card -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Filters</h5>
            </div>
            <div class="card-body">
                <div class="row align-items-end">

                    <div class="col-md-3">
                        <label class="form-label">Order Number</label>
                        <input type="text" id="filter_order_no" class="form-control" placeholder="Search Order #">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status</label>

                        <select id="filter_status" class="select2">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="packed">Packed</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3">

                        <button type="button" id="btn-filter" class="btn btn-primary">

                            <i class="ti ti-filter"></i>

                            Filter

                        </button>

                        <button type="button" id="btn-reset" class="btn btn-light">

                            <i class="ti ti-refresh"></i>

                            Reset

                        </button>

                    </div>

                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Recent Orders</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="orders-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

  @push('scripts')
<script>
    $(document).ready(function () {

        const table = initializeDatatable('#orders-table', {
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ auth()->user()->hasRole('vendor') ? route('vendor.recent-orders.data') : route('reports.recent-orders.data') }}",
                data: function (d) {
                    d.order_no = $('#filter_order_no').val();
                    d.status   = $('#filter_status').val();
                }
            },
            columns: [
                {
                    data: 'order_number',
                    name: 'order_number'
                },
                {
                    data: 'customer',
                    name: 'customer'
                },
                {
                    data: 'grand_total',
                    name: 'grand_total'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                }
            ],
            order: [[4, 'desc']]
        });

        // Filter
        $('#btn-filter').on('click', function () {
            table.ajax.reload();
        });

        // Reset
        $('#btn-reset').on('click', function () {
            $('#filter_order_no').val('');
            $('#filter_status').val('').trigger('change');

            table.ajax.reload();
        });

        // Optional: Auto filter on Enter
        $('#filter_order_no').on('keypress', function (e) {
            if (e.which === 13) {
                table.ajax.reload();
            }
        });

        // Optional: Auto filter when status changes
        $('#filter_status').on('change', function () {
            table.ajax.reload();
        });

    });
</script>
@endpush
