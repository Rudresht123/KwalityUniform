@extends('layouts.common')

@section('content')
<div class="container-fluid fulfillment-hub">
    {{-- Pipeline Columns --}}
    <div class="row flex-nowrap overflow-auto pb-3 gap-3">
        @foreach(['ready' => 'Pending / Ready', 'shipment_created' => 'Shipment Created', 'transit' => 'In Transit', 'delivered' => 'Delivered'] as $key => $title)
        <div class="col-md-3 pipeline-col p-2 bg-light rounded shadow-sm">
            <h6 class="fw-bold mb-3 px-2">{{ $title }} ({{ $pipeline[$key]->count() }})</h6>
            <div class="pipeline-items">
                @foreach($pipeline[$key] as $item)
                    <div class="card mb-2 shadow-sm border-0 cursor-pointer" 
                         data-bs-toggle="offcanvas" 
                         data-bs-target="#shipmentDrawer"
                         onclick="loadShipmentDetails('{{ $item->id ?? '' }}')">
                        <div class="card-body p-3">
                            <h6 class="mb-1 fw-bold">{{ $item->order_number ?? $item->tracking_number }}</h6>
                            <p class="small text-muted mb-0">Priority: High</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Offcanvas Side Drawer --}}
<div class="offcanvas offcanvas-end w-50" tabindex="-1" id="shipmentDrawer" aria-labelledby="shipmentDrawerLabel">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title" id="shipmentDrawerLabel">Shipment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body" id="drawerContent">
        <div class="text-center p-5">Loading...</div>
    </div>
</div>

@push('scripts')
<script>
function loadShipmentDetails(id) {
    if(!id) return;
    fetch(`/vendor/fulfillment-hub/shipment/${id}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('drawerContent').innerHTML = html;
        });
}
</script>
@endpush
@endsection
