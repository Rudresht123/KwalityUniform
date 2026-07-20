@extends('layouts.common')

@push('styles')
<style>
    /* ============================
       Fulfillment Hub — Premium
       Same neutral-first language as the rest of the app:
       flat cards with hairline borders, color reserved for
       status meaning, no glow/blur shadows.
    ============================ */

    :root {
        --hub-primary: #375aa8;
        --hub-primary-soft: #eef2fb;
        --hub-success: #1a7f5a;
        --hub-success-soft: #eaf6f0;
        --hub-warning: #9a6a1e;
        --hub-warning-soft: #faf3e6;
        --hub-neutral: #4b5058;
        --hub-neutral-soft: #f4f5f7;
        --hub-border: #ececef;
        --hub-text: #1c1e21;
        --hub-muted: #8a8e96;
        --hub-radius: 14px;
    }

    .fulfillment-hub-container {
        font-family: 'Inter', sans-serif;
        padding: 4px 0 1rem;
    }

    /* ---------- KPI Cards ---------- */
    .kpi-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .kpi-card {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.375rem;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        box-shadow: 0 1px 2px rgba(16, 24, 40, 0.04);
        transition: box-shadow .2s ease, border-color .2s ease, transform .2s ease;
    }

    .kpi-card:hover {
        transform: translateY(-1px);
        border-color: #e0e2e7;
        box-shadow: 0 4px 12px rgba(16, 24, 40, 0.05);
    }

    .kpi-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
        background: var(--hub-neutral-soft);
        color: var(--hub-neutral);
    }

    .kpi-icon.primary { background: var(--hub-primary-soft); color: var(--hub-primary); }
    .kpi-icon.success { background: var(--hub-success-soft); color: var(--hub-success); }
    .kpi-icon.warning { background: var(--hub-warning-soft); color: var(--hub-warning); }

    .kpi-data h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: var(--hub-text);
        letter-spacing: -0.01em;
    }

    .kpi-data p {
        font-size: 0.8rem;
        color: var(--hub-muted);
        margin: 2px 0 0;
    }

    /* ---------- Pipeline Layout ---------- */
    .pipeline-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.25rem;
        align-items: start;
    }

    .pipeline-col {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .pipeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem 0.25rem 0.75rem;
        border-bottom: 1px solid var(--hub-border);
        margin-bottom: 0.25rem;
    }

    .pipeline-label {
        font-weight: 600;
        font-size: 0.82rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--hub-muted);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pipeline-label i { font-size: 0.95rem; }

    .pipeline-count {
        background: var(--hub-neutral-soft);
        color: var(--hub-neutral);
        font-size: 0.72rem;
        font-weight: 700;
        padding: 2px 9px;
        border-radius: 9999px;
    }

    .dispatch-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    /* ---------- Order / Shipment Cards — flat, hairline border, no glow ---------- */
    .order-card,
    .shipment-card {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.1rem 1.2rem;
        transition: border-color .15s ease, background .15s ease;
        cursor: pointer;
        position: relative;
    }

    .order-card:hover,
    .shipment-card:hover {
        border-color: #d7dae0;
    }

    .order-card.selected {
        border-color: var(--hub-primary);
        background-color: var(--hub-primary-soft);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .order-id {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--hub-text);
    }

    .order-date {
        font-size: 0.72rem;
        color: #a3a7ae;
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.4rem 0;
        border-bottom: 1px solid #f4f5f7;
        font-size: 0.85rem;
    }

    .item-row:last-child { border-bottom: none; }

    .item-name { font-weight: 500; color: #33363b; }

    .item-qty {
        font-weight: 700;
        font-size: 0.78rem;
        color: var(--hub-neutral);
        background: var(--hub-neutral-soft);
        padding: 2px 8px;
        border-radius: 6px;
    }

    .select-shipment-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.85rem;
        padding-top: 0.75rem;
        border-top: 1px dashed var(--hub-border);
    }

    .select-shipment-row label {
        font-size: 0.78rem;
        color: var(--hub-muted);
        cursor: pointer;
    }

    .checkbox-premium {
        width: 1.05rem;
        height: 1.05rem;
        cursor: pointer;
        accent-color: var(--hub-primary);
    }

    /* Shipment status pill */
    .shipment-tracking {
        font-family: 'SFMono-Regular', Consolas, monospace;
        font-weight: 700;
        font-size: 0.8rem;
        color: var(--hub-text);
        letter-spacing: .01em;
    }

    .status-pill {
        display: inline-block;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 20px;
        letter-spacing: .02em;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-pill.info    { background: var(--hub-primary-soft); color: var(--hub-primary); }
    .status-pill.success { background: var(--hub-success-soft); color: var(--hub-success); }
    .status-pill.warning { background: var(--hub-warning-soft); color: var(--hub-warning); }

    .shipment-courier {
        font-size: 0.78rem;
        color: var(--hub-muted);
        margin-bottom: 0.6rem;
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    /* ---------- Empty states ---------- */
    .pipeline-empty {
        text-align: center;
        padding: 2.75rem 1.25rem;
        border: 1px dashed var(--hub-border);
        border-radius: var(--hub-radius);
        background: #fafafb;
    }

    .pipeline-empty i {
        font-size: 1.6rem;
        color: #c4c7cd;
        margin-bottom: 0.5rem;
        display: block;
    }

    .pipeline-empty p {
        font-size: 0.82rem;
        color: var(--hub-muted);
        margin: 0;
    }

    /* ---------- Dispatch Control Center ---------- */
    .dispatch-control-center {
        background: #fff;
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 1.375rem;
        box-shadow: 0 1px 2px rgba(16, 24, 40, 0.04);
        position: sticky;
        top: 1.5rem;
    }

    .control-title {
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.65rem;
        color: var(--hub-text);
    }

    .control-title-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--hub-primary-soft);
        color: var(--hub-primary);
        font-size: 1rem;
        flex-shrink: 0;
    }

    .form-label-premium {
        font-size: 0.72rem;
        font-weight: 600;
        color: var(--hub-muted);
        margin-bottom: 0.4rem;
        display: block;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    .input-premium {
        border-radius: 8px;
        border: 1px solid var(--hub-border);
        padding: 0.6rem 0.7rem;
        font-size: 0.85rem;
        width: 100%;
        transition: border-color .15s ease, box-shadow .15s ease;
        margin-bottom: 1.1rem;
        background: #fff;
        color: var(--hub-text);
    }

    .input-premium:focus {
        outline: none;
        border-color: var(--hub-primary);
        box-shadow: 0 0 0 3px var(--hub-primary-soft);
    }

    .selection-summary {
        font-size: 0.78rem;
        color: var(--hub-muted);
        background: var(--hub-neutral-soft);
        border-radius: 8px;
        padding: 0.6rem 0.75rem;
        margin-bottom: 1.1rem;
    }

    .selection-summary strong {
        color: var(--hub-text);
    }

    .btn-dispatch-action {
        background: var(--hub-text);
        color: #fff;
        border: none;
        border-radius: 9px;
        padding: 0.7rem;
        font-weight: 600;
        font-size: 0.88rem;
        width: 100%;
        cursor: pointer;
        transition: background .15s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-dispatch-action:hover {
        background: #33363b;
    }
</style>
@endpush

@section('content')
<div class="fulfillment-hub-container">

    {{-- KPI Stats --}}
    <div class="kpi-grid">
        <div class="kpi-card">
            <div class="kpi-icon primary">
                <i class="ti ti-package"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['pending_count'] }}</h3>
                <p>Items to Ship</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon">
                <i class="ti ti-truck"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['transit_count'] }}</h3>
                <p>Active Shipments</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon success">
                <i class="ti ti-circle-check"></i>
            </div>
            <div class="kpi-data">
                <h3>{{ $stats['delivered_count'] }}</h3>
                <p>Completed</p>
            </div>
        </div>
        <div class="kpi-card">
            <div class="kpi-icon">
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
                            <i class="ti ti-package"></i> Ready to Dispatch
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

                                <div class="select-shipment-row">
                                    <input class="checkbox-premium ship-checkbox"
                                           type="checkbox"
                                           value="{{ $item->id }}"
                                           id="check-{{ $item->id }}">
                                    <label for="check-{{ $item->id }}">Select for shipment</label>
                                </div>
                            </div>
                        @empty
                            <div class="pipeline-empty">
                                <i class="ti ti-circle-check"></i>
                                <p>All caught up! No pending items.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- In Transit Column --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-truck"></i> In Transit
                        </span>
                        <span class="pipeline-count">{{ $inTransitShipments->count() }}</span>
                    </div>

                    <div class="dispatch-list">
                        @forelse($inTransitShipments as $shipment)
                            <div class="shipment-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="shipment-tracking">{{ $shipment->tracking_number }}</span>
                                    <span class="status-pill info">{{ $shipment->status->value }}</span>
                                </div>

                                <div class="shipment-courier">
                                    <i class="ti ti-building-community"></i> {{ $shipment->courier->name }}
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
                            <div class="pipeline-empty">
                                <i class="ti ti-clock"></i>
                                <p>No active shipments.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Delivered Column --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-circle-check"></i> Delivered
                        </span>
                        <span class="pipeline-count">{{ $deliveredShipments->count() }}</span>
                    </div>

                    <div class="dispatch-list">
                        @forelse($deliveredShipments as $shipment)
                            <div class="shipment-card">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="shipment-tracking">{{ $shipment->tracking_number }}</span>
                                    <span class="status-pill success">{{ $shipment->status->value }}</span>
                                </div>

                                <div class="shipment-courier">
                                    <i class="ti ti-building-community"></i> {{ $shipment->courier->name }}
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
                            <div class="pipeline-empty">
                                <i class="ti ti-circle-check"></i>
                                <p>No delivered items yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-3">
            <div class="dispatch-control-center">
                <div class="control-title">
                    <span class="control-title-icon">
                        <i class="ti ti-send"></i>
                    </span>
                    Dispatch Items
                </div>

                <form action="{{ route('vendor.orders.dispatch') }}" method="POST" id="shipmentForm" class="no-loader">
                    @csrf

                    <div id="selectionSummary" class="selection-summary" style="display:none;">
                        <strong id="selectionCount">0</strong> item(s) selected for this shipment
                    </div>

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
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.ship-checkbox');
        const form = document.getElementById('shipmentForm');
        const summary = document.getElementById('selectionSummary');
        const summaryCount = document.getElementById('selectionCount');

        function refreshSummary() {
            const selected = Array.from(checkboxes).filter(i => i.checked);
            summaryCount.textContent = selected.length;
            summary.style.display = selected.length > 0 ? 'block' : 'none';
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const card = checkbox.closest('.order-card');
                card.classList.toggle('selected', checkbox.checked);
                refreshSummary();
            });
        });

        form.addEventListener('submit', function (e) {
            const selected = Array.from(checkboxes).filter(i => i.checked);

            if (selected.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Selection Required',
                    text: 'Please select at least one item to ship.',
                    confirmButtonColor: '#375aa8',
                });
                return;
            }

            form.querySelectorAll('input[name="order_item_ids[]"]').forEach(el => el.remove());

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