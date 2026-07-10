@extends('website.components.common')

@section('content')
<div class="geo-page-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
    <div class="container">
        <h1 class="display-6 fw-extrabold text-dark mb-2">My Orders</h1>
        <ul class="geo-breadcrumb mb-0">
            <li><a href="{{ route('website.shop') }}">Shop</a></li>
            <li>&bull;</li>
            <li class="active-item">My Orders</li>
        </ul>
    </div>
</div>

<main class="container py-5">

    <div class="orders-toolbar mb-4">
        <form id="orders-filter-form" method="GET" action="{{ route('website.orders.index') }}" class="row g-2 align-items-center">
            <div class="col-md-6">
                <div class="orders-search-wrap">
                    <i class="ti ti-search"></i>
                    <input type="text" name="search" id="search-input" class="form-control" placeholder="Search by Order ID..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <select name="status" id="status-filter" class="form-select">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'confirmed', 'processing', 'packed', 'shipped', 'delivered', 'cancelled', 'returned', 'refunded'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-orders-primary flex-grow-1">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('website.orders.index') }}" id="clear-filters" class="btn btn-outline-secondary" title="Clear filters">
                        <i class="ti ti-x"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div id="orders-table-container">
        @include('website.orders.partials.table')
    </div>

    <div class="orders-toast" id="ordersToast"></div>
</main>

<style>
:root {
    --eschool-blue: #1E3A8A;
    --eschool-blue-light: #EEF2FF;
}

/* Toolbar */
.orders-toolbar {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 16px;
}
.orders-search-wrap { position: relative; }
.orders-search-wrap i {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 15px;
}
.orders-search-wrap input { padding-left: 38px; }

.btn-orders-primary {
    background: var(--eschool-blue);
    border-color: var(--eschool-blue);
    color: #fff;
    font-weight: 600;
}
.btn-orders-primary:hover { background: #16306F; border-color: #16306F; color: #fff; }

.form-control:focus, .form-select:focus {
    border-color: var(--eschool-blue);
    box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.12);
}

.orders-count { font-size: 13px; }

/* Table */
.orders-table thead th { font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; }
.orders-table tbody td { font-size: 14px; color: #334155; }
.orders-table tbody tr:hover { background: var(--eschool-blue-light); }

/* Order ID copy */
.orders-id-wrap { display: inline-flex; align-items: center; gap: 7px; }
.orders-id-copy {
    border: none;
    background: transparent;
    color: #cbd5e1;
    font-size: 13px;
    padding: 2px;
    line-height: 1;
    transition: color 0.15s ease;
}
.orders-id-copy:hover { color: var(--eschool-blue); }
.orders-id-copy.is-copied { color: #15803D; }

/* Status pills */
.order-status {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 11px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: 0.2px;
}
.order-status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }

.order-status-success { background: #DCFCE7; color: #15803D; }
.order-status-success .order-status-dot { background: #15803D; }

.order-status-info { background: #DBEAFE; color: #1D4ED8; }
.order-status-info .order-status-dot { background: #1D4ED8; }

.order-status-amber { background: #FEF3C7; color: #B45309; }
.order-status-amber .order-status-dot { background: #B45309; }

.order-status-danger { background: #FEE2E2; color: #B91C1C; }
.order-status-danger .order-status-dot { background: #B91C1C; }

.order-status-neutral { background: #E2E8F0; color: #475569; }
.order-status-neutral .order-status-dot { background: #475569; }

/* Invoice button loading state */
.orders-invoice-btn { min-width: 92px; }
.orders-invoice-btn.is-loading { pointer-events: none; opacity: 0.7; }
.orders-invoice-btn .spinner-border-sm { width: 0.8rem; height: 0.8rem; margin-right: 4px; }

/* Empty state */
.orders-empty { text-align: center; padding: 56px 20px; max-width: 420px; margin: 0 auto; }
.orders-empty-icon {
    width: 60px;
    height: 60px;
    margin: 0 auto 16px;
    border-radius: 50%;
    background: #F1F5F9;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}
.orders-empty h5 { color: #1e293b; font-weight: 700; margin-bottom: 8px; }
.orders-empty p { color: #94a3b8; font-size: 13.5px; line-height: 1.55; margin-bottom: 20px; }

/* Pagination */
.orders-pagination .pagination { margin-bottom: 0; }
.orders-pagination .page-link { color: var(--eschool-blue); }
.orders-pagination .page-item.active .page-link {
    background: var(--eschool-blue);
    border-color: var(--eschool-blue);
}

/* Toast for download errors */
.orders-toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 1080;
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.orders-toast .toast-item {
    background: #1e3a8a;
    color: #fff;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    box-shadow: 0 10px 24px -8px rgba(15, 23, 42, 0.35);
    display: flex;
    align-items: center;
    gap: 8px;
    animation: toastIn 0.2s ease;
}
.orders-toast .toast-item.is-error { background: #B91C1C; }
.orders-toast .toast-item.is-success { background: #15803D; }
@keyframes toastIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }

/* Responsive: stack table into cards below 768px */
@media (max-width: 767.98px) {
    .orders-table thead { display: none; }
    .orders-table, .orders-table tbody, .orders-table tr, .orders-table td { display: block; width: 100%; }
    .orders-table tr {
        border: 1px solid #edf2f7;
        border-radius: 10px;
        margin: 12px;
        padding: 10px 4px;
    }
    .orders-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 12px !important;
        border: none !important;
        text-align: right;
    }
    .orders-table td::before {
        content: attr(data-label);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        text-align: left;
    }
    .orders-table td[data-label="Actions"] { flex-direction: column; align-items: stretch; }
    .orders-table td[data-label="Actions"]::before { margin-bottom: 8px; }
}
</style>

<script>
$(document).ready(function() {

    function showOrdersToast(message, type) {
        const $toast = $('<div class="toast-item is-' + type + '"><i class="ti ti-' + (type === 'error' ? 'alert-circle' : 'check') + '"></i> ' + message + '</div>');
        $('#ordersToast').append($toast);
        setTimeout(function() {
            $toast.fadeOut(200, function() { $(this).remove(); });
        }, 3500);
    }

    function fetchOrders(page = 1) {
        const $container = $('#orders-table-container');
        const search = $('#search-input').val();
        const status = $('#status-filter').val();
        
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        url.searchParams.set('search', search);
        url.searchParams.set('status', status);

        window.history.pushState({}, '', url);

        $.ajax({
            url: url.pathname + '?' + url.searchParams.toString(),
            method: 'GET',
            success: function(html) {
                $container.html(html);
                bindOrderActions();
            },
            error: function() {
                showOrdersToast('Failed to load orders. Please try again.', 'error');
            }
        });
    }

    function bindOrderActions() {
        $('.orders-id-copy').off('click').on('click', function() {
            const $btn = $(this);
            const value = $btn.data('copy');

            navigator.clipboard.writeText(value).then(function() {
                $btn.addClass('is-copied').find('i').removeClass('ti-copy').addClass('ti-check');
                setTimeout(function() {
                    $btn.removeClass('is-copied').find('i').removeClass('ti-copy').addClass('ti-copy');
                }, 1500);
            });
        });

        $('.orders-invoice-btn').off('click').on('click', function() {
            const $btn = $(this);
            const url = $btn.data('url');
            const orderNumber = $btn.data('order');
            const originalHtml = $btn.html();

            if ($btn.hasClass('is-loading')) return;

            $btn.addClass('is-loading');
            $btn.html('<span class="spinner-border spinner-border-sm"></span> <span class="orders-invoice-label">Preparing...</span>');

            $.ajax({
                url: url,
                method: 'GET',
                xhrFields: { responseType: 'blob' },
                success: function(blob, status, xhr) {
                    let filename = 'Invoice-' + orderNumber + '.pdf';
                    const disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition) {
                        const match = disposition.match(/filename\*?=(?:UTF-8'')?"?([^";]+)"?/i);
                        if (match && match[1]) filename = decodeURIComponent(match[1]);
                    }

                    const blobUrl = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = blobUrl;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(blobUrl);

                    showOrdersToast('Invoice downloaded', 'success');
                },
                error: function() {
                    showOrdersToast('Could not download invoice. Please try again.', 'error');
                },
                complete: function() {
                    $btn.removeClass('is-loading').html(originalHtml);
                }
            });
        });
    }

    $('#status-filter').on('change', function() {
        fetchOrders();
    });

    $('#search-input').on('keyup', function() {
        clearTimeout(this.debounceTimer);
        this.debounceTimer = setTimeout(function() {
            fetchOrders();
        }, 400);
    });

    $(document).on('click', '.orders-pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        const pageMatch = url.match(/page=(\d+)/);
        if (pageMatch) {
            fetchOrders(pageMatch[1]);
        }
    });

    $('#orders-filter-form').on('submit', function(e) {
        e.preventDefault();
        fetchOrders();
    });

    $('#clear-filters').on('click', function(e) {
        e.preventDefault();
        $('#search-input').val('');
        $('#status-filter').val('');
        fetchOrders();
    });

    bindOrderActions();
});
</script>
@endsection