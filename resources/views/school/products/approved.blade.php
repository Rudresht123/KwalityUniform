@extends('layouts.common')

@section('content')
    <style>
        /* ─────────────────────────────────────────────
       TOKENS
    ───────────────────────────────────────────── */
        :root {
            --blue: #2a78d6;
            --blue-lt: rgba(42, 120, 214, .08);
            --violet: #6259ca;
            --violet-lt: rgba(98, 89, 202, .08);
            --green: #1baf7a;
            --green-lt: rgba(27, 175, 122, .08);
            --red: #e34948;
            --red-lt: rgba(227, 73, 72, .08);
            --amber: #eda100;
            --amber-lt: rgba(237, 161, 0, .08);

            --page: #f4f6fb;
            --card: #ffffff;
            --border: #e8edf5;
            --border-sm: #f0f4fa;
            --t1: #1a2332;
            --t2: #4a5568;
            --t3: #94a3b8;

            --r-card: 14px;
            --r-pill: 99px;
            --r-sm: 8px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, .06), 0 1px 2px rgba(0, 0, 0, .04);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, .08), 0 1px 4px rgba(0, 0, 0, .04);
            --tr: .17s ease;
        }

        /* ─────────────────────────────────────────────
       PAGE SHELL
    ───────────────────────────────────────────── */
        .ap-page {
            background: var(--page);
            min-height: 100vh;
            padding: 2rem 1.5rem 3rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--t1);
        }

        /* ─────────────────────────────────────────────
       HEADER
    ───────────────────────────────────────────── */
        .ap-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 1.75rem;
            flex-wrap: wrap;
        }

        .ap-header-left {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .ap-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--violet);
            margin-bottom: 4px;
        }

        .ap-eyebrow i {
            font-size: 13px;
        }

        .ap-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--t1);
            line-height: 1.2;
            letter-spacing: -.5px;
        }

        .ap-subtitle {
            font-size: 13px;
            color: var(--t3);
            margin-top: 2px;
        }

        .ap-header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ─────────────────────────────────────────────
       BUTTONS
    ───────────────────────────────────────────── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 16px;
            border-radius: var(--r-sm);
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            transition: background var(--tr), border-color var(--tr), transform var(--tr), box-shadow var(--tr);
            white-space: nowrap;
            line-height: 1;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: var(--card);
            border-color: var(--border);
            color: var(--t2);
        }

        .btn-ghost:hover {
            border-color: var(--violet);
            color: var(--violet);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary {
            background: var(--violet);
            color: #fff;
            box-shadow: 0 2px 8px rgba(98, 89, 202, .25);
        }

        .btn-primary:hover {
            background: #514ab5;
            box-shadow: 0 4px 16px rgba(98, 89, 202, .35);
        }

        /* ─────────────────────────────────────────────
       STAT STRIP
    ───────────────────────────────────────────── */
        .stat-strip {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--r-card);
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: border-color var(--tr), transform var(--tr);
        }

        .stat-card:hover {
            border-color: var(--violet);
            transform: translateY(-2px);
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .stat-body {}

        .stat-val {
            font-size: 22px;
            font-weight: 700;
            line-height: 1;
            letter-spacing: -.5px;
        }

        .stat-lbl {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--t3);
            margin-top: 2px;
        }

        /* ─────────────────────────────────────────────
       TOOLBAR  (search + filter)
    ───────────────────────────────────────────── */
        .ap-toolbar {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--r-card);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .search-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
            min-width: 180px;
            background: var(--page);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: 8px 12px;
            transition: border-color var(--tr);
        }

        .search-wrap:focus-within {
            border-color: var(--violet);
        }

        .search-wrap i {
            color: var(--t3);
            font-size: 15px;
            flex-shrink: 0;
        }

        .search-wrap input {
            border: none;
            outline: none;
            background: transparent;
            font-size: 13px;
            color: var(--t1);
            width: 100%;
        }

        .search-wrap input::placeholder {
            color: var(--t3);
        }

        .filter-select {
            background: var(--page);
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            padding: 8px 12px;
            font-size: 12px;
            color: var(--t2);
            outline: none;
            cursor: pointer;
            transition: border-color var(--tr);
            font-family: inherit;
        }

        .filter-select:focus {
            border-color: var(--violet);
        }

        .toolbar-count {
            font-size: 12px;
            color: var(--t3);
            white-space: nowrap;
            margin-left: auto;
            font-weight: 500;
        }

        /* ─────────────────────────────────────────────
       TABLE CARD
    ───────────────────────────────────────────── */
        .table-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--r-card);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .table-scroll {
            overflow-x: auto;
        }

        .ap-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        .ap-table thead tr {
            background: #f8fafc;
            border-bottom: 1px solid var(--border);
        }

        .ap-table thead th {
            padding: 13px 18px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--t3);
            white-space: nowrap;
        }

        .ap-table tbody tr {
            border-bottom: 1px solid var(--border-sm);
            transition: background var(--tr);
        }

        .ap-table tbody tr:last-child {
            border-bottom: none;
        }

        .ap-table tbody tr:hover {
            background: #fafbff;
        }

        .ap-table td {
            padding: 14px 18px;
            vertical-align: middle;
        }

        /* Product cell */
        .prod-cell {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .prod-img-wrap {
            position: relative;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            flex-shrink: 0;
            overflow: hidden;
            border: 1px solid var(--border);
            background: #f8fafc;
        }

        .prod-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .prod-img-badge {
            position: absolute;
            bottom: -1px;
            right: -1px;
            width: 16px;
            height: 16px;
            background: var(--green);
            border-radius: 50%;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .prod-img-badge i {
            font-size: 8px;
            color: #fff;
        }

        .prod-info {}

        .prod-name {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--t1);
            line-height: 1.3;
        }

        .prod-id {
            font-size: 11px;
            color: var(--t3);
            margin-top: 2px;
            font-family: 'SF Mono', 'Fira Code', monospace;
        }

        /* Category pill */
        .cat-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            background: var(--violet-lt);
            color: var(--violet);
            border-radius: var(--r-pill);
            font-size: 11px;
            font-weight: 600;
        }

        .cat-pill i {
            font-size: 11px;
        }

        /* Vendor cell */
        .vendor-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .vendor-avatar {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            background: var(--blue-lt);
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
            font-family: inherit;
        }

        .vendor-name {
            font-size: 13px;
            color: var(--t2);
            font-weight: 500;
        }

        /* Status badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 9px;
            border-radius: var(--r-pill);
            font-size: 11px;
            font-weight: 700;
            background: var(--green-lt);
            color: var(--green);
        }

        .status-badge i {
            font-size: 10px;
        }

        /* Action cell */
        .action-cell {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--t3);
            cursor: pointer;
            transition: all var(--tr);
            text-decoration: none;
        }

        .btn-icon:hover {
            border-color: var(--blue);
            color: var(--blue);
            background: var(--blue-lt);
        }

        .btn-unapprove {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: var(--r-sm);
            font-size: 12px;
            font-weight: 600;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--t3);
            cursor: pointer;
            transition: all var(--tr);
        }

        .btn-unapprove:hover {
            background: var(--red-lt);
            border-color: var(--red);
            color: var(--red);
        }

        .btn-unapprove i {
            font-size: 13px;
        }

        /* ─────────────────────────────────────────────
       EMPTY STATE
    ───────────────────────────────────────────── */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5rem 2rem;
            text-align: center;
        }

        .empty-icon-wrap {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            background: var(--violet-lt);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: var(--violet);
            margin-bottom: 1.25rem;
        }

        .empty-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--t1);
            margin-bottom: 6px;
        }

        .empty-sub {
            font-size: 13px;
            color: var(--t3);
            max-width: 280px;
            line-height: 1.6;
        }

        .empty-cta {
            margin-top: 1.25rem;
        }

        /* ─────────────────────────────────────────────
       PAGINATION WRAPPER
    ───────────────────────────────────────────── */
        .ap-pagination {
            margin-top: 1.25rem;
            display: flex;
            justify-content: flex-end;
        }

        /* ─────────────────────────────────────────────
       CONFIRM MODAL
    ───────────────────────────────────────────── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .45);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity .2s ease;
        }

        .modal-backdrop.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 28px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 24px 64px rgba(0, 0, 0, .15);
            transform: translateY(12px) scale(.97);
            transition: transform .22s ease, opacity .22s ease;
            opacity: 0;
        }

        .modal-backdrop.open .modal-box {
            transform: translateY(0) scale(1);
            opacity: 1;
        }

        .modal-icon-wrap {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: var(--red-lt);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--red);
            margin-bottom: 14px;
        }

        .modal-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--t1);
            margin-bottom: 6px;
        }

        .modal-body {
            font-size: 13px;
            color: var(--t2);
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .modal-product-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: var(--r-sm);
            font-size: 12px;
            font-weight: 600;
            color: var(--t1);
            margin-bottom: 16px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
        }

        .modal-actions .btn {
            flex: 1;
            justify-content: center;
        }

        .btn-danger {
            background: var(--red);
            color: #fff;
            border-color: var(--red);
            box-shadow: 0 2px 8px rgba(227, 73, 72, .25);
        }

        .btn-danger:hover {
            background: #c93534;
            box-shadow: 0 4px 14px rgba(227, 73, 72, .35);
        }

        /* ─────────────────────────────────────────────
       TOAST
    ───────────────────────────────────────────── */
        .toast-wrap {
            position: fixed;
            bottom: 1.5rem;
            right: 1.5rem;
            z-index: 2000;
            display: flex;
            flex-direction: column;
            gap: 8px;
            pointer-events: none;
        }

        .toast {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: var(--shadow-md);
            font-size: 13px;
            font-weight: 500;
            color: var(--t1);
            transform: translateX(110%);
            transition: transform .3s cubic-bezier(.34, 1.56, .64, 1);
            min-width: 260px;
            pointer-events: all;
        }

        .toast.show {
            transform: translateX(0);
        }

        .toast i {
            font-size: 17px;
        }

        .toast-green {
            border-left: 3px solid var(--green);
        }

        .toast-red {
            border-left: 3px solid var(--red);
        }

        .toast-green i {
            color: var(--green);
        }

        .toast-red i {
            color: var(--red);
        }

        /* ─────────────────────────────────────────────
       RESPONSIVE
    ───────────────────────────────────────────── */
        @media (max-width: 680px) {
            .ap-title {
                font-size: 20px;
            }

            .stat-strip {
                grid-template-columns: 1fr 1fr;
            }

            .ap-table thead th:nth-child(3),
            .ap-table td:nth-child(3) {
                display: none;
            }

            .toolbar-count {
                display: none;
            }
        }
    </style>

    <div class="custom-card">


        {{-- ── TOOLBAR ── --}}
        <div class="ap-toolbar">
            <div class="row w-100">

                <div class="col-lg-3">
                    <div class="search-wrap">
                        <i class="ti ti-search"></i>
                        <input id="prodSearch" type="text" placeholder="Search products…" autocomplete="off">
                    </div>
                </div>
                <div class="col-lg-3">
                    @include('custom-component.subCategory', [
                        'id' => 'catFilter',
                        'name' => 'category',
                        'defaultClass' => 'filter-select',
                    ])
                </div>
                <div class="col-lg-3">
                    @include('custom-component.vendor', [
                        'id' => 'vendorFilter',
                        'name' => 'vendor',
                        'defaultClass' => 'filter-select',
                    ])
                </div>
                <div class="col-lg-3 text-end">
                    <span class="toolbar-count" id="rowCount">
                        {{ $products->total() }} product{{ $products->total() == 1 ? '' : 's' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ── TABLE ── --}}
        <div class="table-card">
            <div class="table-scroll">
                <table class="ap-table" id="prodTable">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Vendor</th>
                            <th>Status</th>
                            <th style="text-align:right">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="prodBody">
                        @include('school.products.partials.approved_rows', ['products' => $products])
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ── PAGINATION ── --}}
        <div class="ap-pagination" id="paginationWrap">
            {{ $products->links() }}
        </div>

    </div>

    {{-- ── CONFIRM MODAL ── --}}
    <div class="modal-backdrop" id="modalBackdrop" onclick="closeModal(event)">
        <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
            <div class="modal-icon-wrap">
                <i class="ti ti-circle-minus"></i>
            </div>
            <div class="modal-title" id="modalTitle">Remove from approved list?</div>
            <div class="modal-product-chip" id="modalProductChip">
                <i class="ti ti-package" style="font-size:12px;color:var(--t3)"></i>
                <span id="modalProductName">Product name</span>
            </div>
            <div class="modal-body">
                This product will no longer appear in your school's approved catalogue. Students and parents won't be able
                to order it. You can re-approve it from the marketplace at any time.
            </div>
            <div class="modal-actions">
                <button class="btn btn-ghost" onclick="closeModalDirect()">
                    Cancel
                </button>
                <button class="btn btn-danger" id="modalConfirmBtn" onclick="executeUnapprove()">
                    <i class="ti ti-circle-minus"></i>
                    Yes, remove
                </button>
            </div>
        </div>
    </div>

    {{-- ── TOAST ── --}}
    <div class="toast-wrap" id="toastWrap"></div>


    <script>
        /* ─────────────────────────────────────────────
       MODAL
    ───────────────────────────────────────────── */
        let _pendingId = null;
        let _pendingRow = null;

        function confirmUnapprove(id, name) {
            _pendingId = id;
            document.getElementById('modalProductName').textContent = name;
            document.getElementById('modalBackdrop').classList.add('open');
        }

        function closeModal(e) {
            if (e.target === document.getElementById('modalBackdrop')) closeModalDirect();
        }

        function closeModalDirect() {
            document.getElementById('modalBackdrop').classList.remove('open');
            _pendingId = null;
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeModalDirect();
        });

        /* ─────────────────────────────────────────────
           UNAPPROVE  fetch
        ───────────────────────────────────────────── */
        async function executeUnapprove() {
            if (!_pendingId) return;

            const btn = document.getElementById('modalConfirmBtn');
            btn.innerHTML = '<i class="ti ti-loader-2" style="animation:spin .7s linear infinite"></i> Removing…';
            btn.disabled = true;

            try {
                const resp = await fetch(`/school-products/${_pendingId}/unapprove`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                const data = await resp.json();

                closeModalDirect();
                btn.innerHTML = '<i class="ti ti-circle-minus"></i> Yes, remove';
                btn.disabled = false;

                if (data.success) {
                    /* animate row out */
                    const row = document.querySelector(`tr[data-id="${_pendingId}"]`);
                    if (row) {
                        row.style.transition = 'opacity .3s ease, transform .3s ease';
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(20px)';
                        setTimeout(() => {
                            row.remove();
                            updateRowCount();
                        }, 320);
                    }
                    showToast('Product removed from your approved list.', 'green');
                } else {
                    showToast(data.message || 'Could not remove product.', 'red');
                }
            } catch (err) {
                closeModalDirect();
                btn.innerHTML = '<i class="ti ti-circle-minus"></i> Yes, remove';
                btn.disabled = false;
                showToast('Something went wrong. Please try again.', 'red');
            }
        }

        /* ─────────────────────────────────────────────
           DYNAMIC FETCH
        ───────────────────────────────────────────── */
        async function fetchProducts(page = 1) {
            const search = document.getElementById('prodSearch').value;
            const catId = document.getElementById('catFilter').value;
            const vendorId = document.getElementById('vendorFilter').value;

            const params = new URLSearchParams();
            if (page) params.append('page', page);
            if (search) params.append('search', search);
            if (catId) params.append('category_id', catId);
            if (vendorId) params.append('vendor_id', vendorId);

            // Show loading state
            const body = document.getElementById('prodBody');
            body.style.opacity = '0.5';
            body.style.pointerEvents = 'none';

            try {
                const resp = await fetch(`{{ route('school.products.approved') }}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const data = await resp.json();

                if (data.success) {
                    document.getElementById('prodBody').innerHTML = data.html;
                    document.getElementById('paginationWrap').innerHTML = data.pagination;
                    document.getElementById('rowCount').textContent = data.count + ' product' + (data.count === 1 ? '' : 's');
                }
            } catch (err) {
                showToast('Failed to load products.', 'red');
            } finally {
                body.style.opacity = '1';
                body.style.pointerEvents = 'all';
            }
        }

        function updateRowCount() {
            const rows = document.querySelectorAll('#prodBody tr[data-id]');
            const count = rows.length;
            document.getElementById('rowCount').textContent = count + ' product' + (count === 1 ? '' : 's');
        }

        // Debounce search input
        function debounce(func, wait) {
            return function(...args) {
                return new Promise((resolve) => {
                    const timeout = setTimeout(() => func.apply(this, args), wait);
                    return { timeout };
                });
            };
        }

        const debouncedFetch = debounce(fetchProducts, 300);

        document.getElementById('prodSearch').addEventListener('input', () => {
            debouncedFetch(1);
        });

        document.getElementById('catFilter').addEventListener('change', () => fetchProducts(1));
        document.getElementById('vendorFilter').addEventListener('change', () => fetchProducts(1));

        // Intercept pagination links
        document.addEventListener('click', e => {
            const anchor = e.target.closest('.pagination a');
            if (anchor) {
                e.preventDefault();
                const url = new URL(anchor.href);
                const page = url.searchParams.get('page') || 1;
                fetchProducts(page);
            }
        });

        /* ─────────────────────────────────────────────
           TOAST
        ───────────────────────────────────────────── */
        function showToast(msg, type = 'green') {
            const icon = type === 'green' ? 'ti-circle-check' : 'ti-circle-x';
            const wrap = document.getElementById('toastWrap');
            const el = document.createElement('div');
            el.className = `toast toast-${type}`;
            el.innerHTML = `<i class="ti ${icon}"></i> ${msg}`;
            wrap.appendChild(el);
            requestAnimationFrame(() => {
                el.classList.add('show');
            });
            setTimeout(() => {
                el.classList.remove('show');
                setTimeout(() => el.remove(), 350);
            }, 3500);
        }
    </script>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
@endsection
