@extends('layouts.common')

@push('styles')
<style>
    :root {
        --hub-primary: #2563eb;
        --hub-primary-soft: rgba(37, 99, 235, 0.08);
        --hub-success: #10b981;
        --hub-success-soft: rgba(16, 185, 129, 0.08);
        --hub-border: #e2e8f0;
        --hub-radius: 16px;
        --hub-card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .fulfillment-hub-container {
        font-family: 'Inter', sans-serif;
        padding: 1rem 0;
    }

    /* KPI Cards */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .kpi-card {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        box-shadow: var(--hub-card-shadow);
        transition: transform 0.2s;
    }

    .kpi-card:hover { transform: translateY(-2px); }

    .kpi-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .kpi-data h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .kpi-data p {
        font-size: 0.875rem;
        color: #64748b;
        margin: 0;
    }

    /* Pipeline Layout */
    .pipeline-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
        align-items: start;
    }

    .pipeline-col {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .pipeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 2px solid var(--hub-border);
        margin-bottom: 1rem;
    }

    .pipeline-label {
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pipeline-count {
        background: var(--hub-primary-soft);
        color: var(--hub-primary);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.125rem 0.625rem;
        border-radius: 9999px;
    }

    /* Order Card */
    .order-card {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.25rem;
        box-shadow: var(--hub-card-shadow);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--hub-primary);
    }

    .order-card.selected {
        border-color: var(--hub-primary);
        background-color: var(--hub-primary-soft);
        box-shadow: 0 0 0 2px var(--hub-primary);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .order-id {
        font-weight: 700;
        font-size: 0.875rem;
        color: #1e293b;
    }

    .order-date {
        font-size: 0.75rem;
        color: #94a3b8;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.875rem;
    }

    .item-row:last-child { border-bottom: none; }

    .item-name { font-weight: 500; color: #334155; }
    .item-qty { 
        font-weight: 700; 
        color: var(--hub-primary); 
        background: var(--hub-primary-soft);
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Dispatch Control Center */
    .dispatch-control-center {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.5rem;
        box-shadow: var(--hub-card-shadow);
        position: sticky;
        top: 2rem;
    }

    .control-title {
        font-weight: 600;
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #1e293b;
    }

    .form-label-premium {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: block;
        text-transform: uppercase;
    }

    .input-premium {
        border-radius: 8px;
        border: 1px solid var(--hub-border);
        padding: 0.625rem;
        font-size: 0.875rem;
        width: 100%;
        transition: all 0.2s;
        margin-bottom: 1.25rem;
    }

    .input-premium:focus {
        outline: none;
        border-color: var(--hub-primary);
        box-shadow: 0 0 0 3px var(--hub-primary-soft);
    }

    .btn-dispatch-action {
        background: var(--hub-primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-dispatch-action:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
    }

    .checkbox-premium {
        width: 1.1rem;
        height: 1.1rem;
        cursor: pointer;
        accent-color: var(--hub-primary);
    }

    /* Shipment Card */
    .shipment-card {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.25rem;
        box-shadow: var(--hub-card-shadow);
        transition: all 0.2s;
    }

    .shipment-card:hover {
        border-color: var(--hub-primary);
    }

    .shipment-tracking {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        font-size: 0.875rem;
        color: var(--hub-primary);
    }
</style>
@endpush

@section('content')


    {{-- KPI Stats --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon" style="background: var(--hub-primary-soft); color: var(--hub-primary);">
                <i class="ti ti-package"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['pending_count'] }}</h3>
                <p>Items to Ship</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background: rgba(0, 123, 255, 0.1); color: #007bff;">
                <i class="ti ti-truck"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['transit_count'] }}</h3>
                <p>Active Shipments</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background: var(--hub-success-soft); color: var(--hub-success);">
                <i class="ti ti-circle-check"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['delivered_count'] }}</h3>
                <p>Completed</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon" style="background: rgba(0,0,0,0.05); color: #333;">
                <i class="ti ti-list-details"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['total_items'] }}</h3>
                <p>Total Volume</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-9">
            <div class="pipeline-grid">
                {{-- Ready for Dispatch Column --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-package text-primary"></i> Ready to Dispatch
                        </span>
                        <span class="pipeline-count">{{ $pendingItems->count() }}</span>
                    </div>

                    <div class="dispatch-list">
                        @forelse($pendingItems as $item)
                            <div class="order-card" data-order-id="{{ $item->order_id }}">
                                <div class="order-card-header">
                                    <span class="order-id">Order #{{ $item->order->order_number }}</span>
                                    <span class="order-date">{{ $item->order->created_at->format('d M, H:i') }}</span>
                                </div>
                                <div class="item-details">
                                    <div class="item-row">
                                        <span class="item-name">{{ $item->product->product_name }}</span>
                                        <span class="item-qty">x{{ $item->quantity }}</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input checkbox-premium ship-checkbox" 
                                               type="checkbox" 
                                               value="{{ $item->id }}" 
                                               id="check-{{ $item->id }}">
                                        <label class="form-check-label small text-muted" for="check-{{ $item->id }}">Select for shipment</label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5 border rounded-4 bg-white">
                                <i class="ti ti-check-circle fs-1 text-success opacity-50"></i>
                                <p class="text-muted mt-2 small">All caught up! No pending items.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- In Transit Column --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-truck text-info"></i> In Transit
                        </span>
                        <span class="pipeline-count">{{ $inTransitShipments->count() }}</span>
                    </div>
                    <div class="dispatch-list">
                        @forelse($inTransitShipments as $shipment)
                            <div class="shipment-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="shipment-tracking">{{ $shipment->tracking_number }}</span>
                                    <span class="badge bg-info-soft text-info" style="background: rgba(0, 123, 255, 0.1); color: #007bff; font-size: 0.7rem;">
                                        {{ $shipment->status->value }}
                                    </span>
                                </div>
                                <div class="small text-muted mb-2">
                                    <i class="ti ti-building-community me-1"></i> {{ $shipment->courier->name }}
                                </div>
                                <div class="item-details">
                                    @foreach($shipment->items as $item)
                                        <div class="item-row">
                                            <span class="item-name">{{ $item->orderItem->product->product_name }}</span>
                                            <span class="item-qty">x{{ $item->quantity_shipped }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5 border rounded-4 bg-white opacity-75">
                                <i class="ti ti-clock fs-1 text-muted"></i>
                                <p class="text-muted mt-2 small">No active shipments.</p>
                                </div>
                            @endforelse
                    </div>
                </div>

                {{-- Delivered Column --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-circle-check text-success"></i> Delivered
                        </span>
                        <span class="pipeline-count">{{ $deliveredShipments->count() }}</span>
                    </div>
                    <div class="dispatch-list">
                        @forelse($deliveredShipments as $shipment)
                            <div class="shipment-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="shipment-tracking">{{ $shipment->tracking_number }}</span>
                                    <span class="badge bg-success-soft text-success" style="background: var(--hub-success-soft); color: var(--hub-success); font-size: 0.7rem;">
                                        {{ $shipment->status->value }}
                                        </span>
                                </div>
                                <div class="small text-muted mb-2">
                                    <i class="ti ti-building-community me-1"></i> {{ $shipment->courier->name }}
                                </div>
                                <div class="item-details">
                                    @foreach($shipment->items as $item)
                                        <div class="item-row">
                                            <span class="item-name">{{ $item->orderItem->product->product_name }}</span>
                                            <span class="item-qty">x{{ $item->quantity_shipped }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5 border rounded-4 bg-white opacity-75">
                                <i class="ti ti-circle-check fs-1 text-muted"></i>
                                <p class="text-muted mt-2 small">No delivered items yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="dispatch-control-center">
                <div class="control-title">
                    <i class="ti ti-send text-primary"></i> Dispatch Items
                </div>
                <form action="{{ route('vendor.orders.dispatch') }}" method="POST" id="shipmentForm" class="no-loader">
                    @csrf
                    <div class="form-group">
                        <label class="form-label-premium">Select Courier</label>
                        <select name="courier_id" class="form-select input-premium" required>
                            <option value="">-- Select Courier --</option>
                            @foreach(\App\Models\Courier::all() as $courier)
                                <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label-premium">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-control input-premium" 
                               placeholder="Enter courier tracking ID" required>
                    </div>

                    <button type="submit" class="btn-dispatch-action">
                        <i class="ti ti-upload"></i> Create Shipment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.ship-checkbox');
        const form = document.getElementById('shipmentForm');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const card = checkbox.closest('.order-card');
                if (checkbox.checked) {
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });
        });

        form.addEventListener('submit', function(e) {
            const selected = Array.from(checkboxes).filter(i => i.checked);
            if (selected.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Selection Required',
                    text: 'Please select at least one item to ship.',
                    confirmButtonColor: '#2563eb'
                });
                return;
            }

            const existingInputs = form.querySelectorAll('input[name="order_item_ids[]"]');
            existingInputs.forEach(el => el.remove());

            selected.forEach(item => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'order_item_ids[]';
                input.value = item.value;
                form.appendChild(input);
            });
        });
    });
</script>
@endpush
