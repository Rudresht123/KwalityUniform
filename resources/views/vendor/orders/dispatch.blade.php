@php
    $breadcrumb = 'Vendor Order Management';
    $title = 'Order Fulfillment Hub';
@endphp

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --hub-bg: #F8FAFC;
        --hub-card: #FFFFFF;
        --hub-primary: #2563EB;
        --hub-primary-soft: rgba(37, 99, 235, 0.1);
        --hub-success: #10B981;
        --hub-success-soft: rgba(16, 185, 129, 0.1);
        --hub-danger: #EF4444;
        --hub-danger-soft: rgba(239, 68, 68, 0.1);
        --hub-text-main: #1E293B;
        --hub-text-mute: #64748B;
        --hub-border: #E2E8F0;
        --hub-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --hub-radius: 16px;
    }

    .fulfillment-hub {
        background-color: var(--hub-bg);
        font-family: 'Inter', sans-serif;
        color: var(--hub-text-main);
        padding: 24px;
        min-height: 100vh;
    }

    .hub-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 24px;
        margin-bottom: 8px;
    }

    .hub-subtitle {
        color: var(--hub-text-mute);
        font-size: 14px;
        margin-bottom: 32px;
    }

    /* Pipeline Section */
    .pipeline-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .pipeline-col {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .pipeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 8px;
        margin-bottom: 8px;
    }

    .pipeline-label {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .pipeline-count {
        background: var(--hub-primary-soft);
        color: var(--hub-primary);
        font-size: 12px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 10px;
    }

    /* Order Card */
    .order-card {
        background: var(--hub-card);
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 16px;
        box-shadow: var(--hub-shadow);
        transition: all 0.2s ease;
        cursor: pointer;
        position: relative;
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: var(--hub-primary);
    }

    .order-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .order-id {
        font-weight: 700;
        font-size: 14px;
        color: var(--hub-text-main);
    }

    .order-date {
        font-size: 12px;
        color: var(--hub-text-mute);
    }

    .item-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid var(--hub-border);
        font-size: 13px;
    }

    .item-row:last-child { border-bottom: none; }

    .item-name { font-weight: 500; color: var(--hub-text-main); }
    .item-qty { font-weight: 700; color: var(--hub-primary); }

    /* Dispatch Panel */
    .dispatch-panel {
        background: var(--hub-card);
        border: 1px solid var(--hub-border);
        border-radius: var(--hub-radius);
        padding: 24px;
        box-shadow: var(--hub-shadow);
        position: sticky;
        top: 24px;
    }

    .panel-title {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--hub-text-mute);
        margin-bottom: 6px;
    }

    .form-select-premium {
        border-radius: 10px;
        border: 1px solid var(--hub-border);
        padding: 10px;
        font-size: 14px;
        margin-bottom: 16px;
        width: 100%;
        transition: border-color 0.2s;
    }

    .form-select-premium:focus {
        outline: none;
        border-color: var(--hub-primary);
        box-shadow: 0 0 0 3px var(--hub-primary-soft);
    }

    .btn-ship {
        background: var(--hub-primary);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        width: 100%;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .btn-ship:hover { opacity: 0.9; }

    .checkbox-custom {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

<div class="fulfillment-hub">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="hub-title">Order Fulfillment Hub</h1>
            <p class="hub-subtitle">Manage your confirmed orders and dispatch shipments to schools.</p>
        </div>
        <div class="d-flex gap-3">
            <button class="btn btn-outline-secondary rounded-pill px-4" onclick="window.print()">
                <i class="ti ti-printer me-2"></i> Print Manifest
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill px-4">
                <i class="ti ti-layout-dashboard me-2"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
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
                                        <input class="form-check-input checkbox-custom ship-checkbox" 
                                               type="checkbox" 
                                               value="{{ $item->id }}" 
                                               id="check-{{ $item->id }}">
                                        <label class="form-check-label small" for="check-{{ $item->id }}">Select for shipment</label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-5 border rounded-4 bg-white">
                                <i class="ti ti-check-circle fs-1 text-success"></i>
                                <p class="text-mute mt-2">All caught up! No pending items.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Shipped / In Transit Column (Simulated/Future) --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-truck text-info"></i> In Transit
                        </span>
                        <span class="pipeline-count">0</span>
                    </div>
                    <div class="dispatch-list">
                        <div class="text-center p-5 border rounded-4 bg-white">
                            <i class="ti ti-clock fs-1 text-mute"></i>
                            <p class="text-mute mt-2">No active shipments.</p>
                        </div>
                    </div>
                </div>

                {{-- Delivered Column (Simulated/Future) --}}
                <div class="pipeline-col">
                    <div class="pipeline-header">
                        <span class="pipeline-label">
                            <i class="ti ti-circle-check text-success"></i> Delivered
                        </span>
                        <span class="pipeline-count">0</span>
                    </div>
                    <div class="dispatch-list">
                        <div class="text-center p-5 border rounded-4 bg-white">
                            <i class="ti ti-circle-check fs-1 text-mute"></i>
                            <p class="text-mute mt-2">No delivered items yet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="dispatch-panel">
                <div class="panel-title">
                    <i class="ti ti-send text-primary"></i> Dispatch Items
                </div>
                <form action="{{ route('vendor.orders.dispatch') }}" method="POST" id="shipmentForm">
                    @csrf
                    <input type="hidden" name="order_item_ids[]" id="selected_items">
                    
                    <div class="form-group mb-3">
                        <label class="form-label">Select Courier</label>
                        <select name="courier_id" class="form-select-premium" required>
                            <option value="">-- Select Courier --</option>
                            @foreach(\App\Models\Courier::all() as $courier)
                                <option value="{{ $courier->id }}">{{ $courier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Tracking Number</label>
                        <input type="text" name="tracking_number" class="form-select-premium" 
                               placeholder="Enter courier tracking ID" required>
                    </div>

                    <button type="submit" class="btn-ship">
                        <i class="ti ti-upload me-2"></i> Create Shipment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.ship-checkbox');
        const hiddenInput = document.getElementById('selected_items');
        const form = document.getElementById('shipmentForm');

        function updateSelectedItems() {
            const selected = Array.from(checkboxes)
                .filter(i => i.checked)
                .map(i => i.value);
            
            // Since we are sending an array in Laravel, we need multiple hidden inputs 
            // or a comma-separated string that we handle in the controller.
            // To keep it compatible with the current Controller, we'll use a different approach:
            // We'll dynamically create hidden inputs for each selected ID.
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                const card = checkbox.closest('.order-card');
                if (checkbox.checked) {
                    card.style.borderColor = 'var(--hub-primary)';
                    card.style.backgroundColor = 'var(--hub-primary-soft)';
                } else {
                    card.style.borderColor = 'var(--hub-border)';
                    card.style.backgroundColor = 'var(--hub-card)';
                }
            });
        });

        form.addEventListener('submit', function(e) {
            // Clear previous inputs
            const existingInputs = form.querySelectorAll('input[name="order_item_ids[]"]');
            existingInputs.forEach(el => el.remove());

            // Add selected items
            const selected = Array.from(checkboxes).filter(i => i.checked);
            if (selected.length === 0) {
                e.preventDefault();
                alert('Please select at least one item to ship.');
                return;
            }

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
