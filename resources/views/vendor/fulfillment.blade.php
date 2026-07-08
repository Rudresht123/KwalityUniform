<div class="container-fluid p-4">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Vendor Fulfillment Center</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <h6>Create Bulk Shipment</h6>
                    <form action="{{ route('vendor.fulfillment.bulk') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label>Select School</label>
                            <select name="school_id" id="school_select" class="form-select" required>
                                <option value="">-- Choose School --</option>
                                @foreach($schools as $school)
                                    <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Select Courier</label>
                            <select name="courier_id" class="form-select" required>
                                <option value="">-- Choose Courier --</option>
                                @foreach($couriers as $courier)
                                    <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Generate Bulk Shipment</button>
                    </form>
                </div>
                
                <div class="col-md-8">
                    <h6>Pending Bulk Orders</h6>
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>School</th>
                                <th>Pending Orders</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingBulkOrders as $item)
                                <tr>
                                    <td>{{ $item['school']->school_name }}</td>
                                    <td>{{ $item['count'] }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" 
                                                onclick="document.getElementById('school_select').value = '{{ $item['school']->school_id }}'">
                                            Select
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
