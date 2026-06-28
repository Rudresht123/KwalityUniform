@extends('layouts.common')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;1,9..144,400&display=swap" rel="stylesheet">
<style>
    :root {
        --navy: #0F1729;
        --navy-mid: #1E2D4A;
        --indigo: #4F46E5;
        --indigo-light: #818CF8;
        --slate-bg: #F0F4FF;
        --emerald: #10B981;
        --amber: #F59E0B;
        --text-primary: #111827;
        --text-secondary: #6B7280;
        --border: #E5E7EB;
    }

    body { background: var(--slate-bg); font-family: 'DM Sans', sans-serif; }

    /* ── PAGE HEADER ───────────────────────────────────────── */
    .page-header {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-mid) 60%, #1A3460 100%);
        padding: 3rem 0 4.5rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%234F46E5' fill-opacity='0.06'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-header-inner { position: relative; z-index: 1; max-width: 1280px; margin: 0 auto; padding: 0 2rem; }
    .page-eyebrow {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: rgba(79,70,229,0.3); border: 1px solid rgba(129,140,248,0.4);
        color: var(--indigo-light); font-size: 0.75rem; font-weight: 600;
        letter-spacing: 0.1em; text-transform: uppercase;
        padding: 0.35rem 0.85rem; border-radius: 999px; margin-bottom: 1rem;
    }
    .page-title {
        font-family: 'Fraunces', serif;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700; color: #fff;
        line-height: 1.15; margin-bottom: 0.5rem;
    }
    .page-subtitle { color: #94A3B8; font-size: 1rem; font-weight: 400; max-width: 480px; }

    /* ── LAYOUT ───────────────────────────────────────────── */
    .layout-wrap { max-width: 1280px; margin: 0 auto; padding: 0 2rem; }
    .layout-grid {
        display: grid; grid-template-columns: 260px 1fr;
        gap: 2rem; align-items: start;
        margin-top: -2rem; /* pull up over header curve */
    }
    @media (max-width: 768px) {
        .layout-grid { grid-template-columns: 1fr; margin-top: 1.5rem; }
    }

    /* ── FILTER SIDEBAR ──────────────────────────────────── */
    .filter-sidebar {
        background: #fff;
        border-radius: 1.25rem;
        border: 1px solid var(--border);
        padding: 1.5rem;
        position: sticky; top: 5.5rem;
        box-shadow: 0 4px 24px rgba(15,23,41,0.08);
    }
    .filter-title {
        font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em;
        text-transform: uppercase; color: var(--text-secondary);
        margin-bottom: 1.25rem; display: flex; align-items: center; gap: 0.5rem;
    }
    .filter-title svg { color: var(--indigo); }
    .filter-group { margin-bottom: 1.25rem; }
    .filter-label { font-size: 0.75rem; font-weight: 600; color: var(--text-primary); margin-bottom: 0.5rem; display: block; }
    .filter-select {
        width: 100%; padding: 0.6rem 0.85rem;
        background: var(--slate-bg); border: 1px solid var(--border);
        border-radius: 0.625rem; font-family: 'DM Sans', sans-serif;
        font-size: 0.875rem; color: var(--text-primary);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 0.75rem center;
        cursor: pointer; transition: border-color .2s, box-shadow .2s;
    }
    .filter-select:focus { outline: none; border-color: var(--indigo); box-shadow: 0 0 0 3px rgba(79,70,229,.12); }
    .filter-divider { height: 1px; background: var(--border); margin: 1.25rem 0; }
    .clear-filters {
        display: block; text-align: center; font-size: 0.8rem;
        font-weight: 600; color: var(--indigo); text-decoration: none;
        padding: 0.5rem; border-radius: 0.5rem; transition: background .2s;
    }
    .clear-filters:hover { background: rgba(79,70,229,.06); }

    /* ── PRODUCT GRID ────────────────────────────────────── */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 1.5rem;
    }

    /* ── PRODUCT CARD ────────────────────────────────────── */
    .product-card {
        background: #fff; border-radius: 1.25rem;
        border: 1px solid var(--border); overflow: hidden;
        cursor: pointer; position: relative;
        transition: transform .3s cubic-bezier(.34,1.56,.64,1), box-shadow .3s ease;
        box-shadow: 0 2px 8px rgba(15,23,41,0.05);
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(15,23,41,0.14);
    }
    .product-card:hover .card-arrow { transform: translateX(4px); }
    .product-card:hover .card-image img { transform: scale(1.07); }

    /* Approval ribbon */
    .approved-ribbon {
        position: absolute; top: 1rem; left: -0.25rem;
        background: var(--emerald); color: #fff;
        font-size: 0.65rem; font-weight: 700; letter-spacing: 0.05em;
        text-transform: uppercase; padding: 0.3rem 0.75rem 0.3rem 0.9rem;
        border-radius: 0 999px 999px 0;
        box-shadow: 0 2px 8px rgba(16,185,129,.4);
        display: flex; align-items: center; gap: 0.35rem; z-index: 2;
    }
    .approved-ribbon::before {
        content: ''; position: absolute; bottom: -0.25rem; left: 0;
        border-top: 0.25rem solid #059669;
        border-left: 0.25rem solid transparent;
    }

    .card-image {
        height: 220px; overflow: hidden; position: relative; background: #F3F4F6;
    }
    .card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s ease; }

    .card-category-badge {
        position: absolute; top: 0.75rem; right: 0.75rem;
        background: rgba(255,255,255,0.92); backdrop-filter: blur(6px);
        color: var(--indigo); font-size: 0.65rem; font-weight: 700;
        letter-spacing: 0.06em; text-transform: uppercase;
        padding: 0.3rem 0.65rem; border-radius: 999px;
        border: 1px solid rgba(79,70,229,.15);
    }

    .card-body { padding: 1rem 1.25rem 1.25rem; }
    .card-name {
        font-size: 0.975rem; font-weight: 600; color: var(--text-primary);
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        margin-bottom: 0.3rem;
    }
    .card-desc { font-size: 0.8rem; color: var(--text-secondary); line-height: 1.45; margin-bottom: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .card-footer { display: flex; justify-content: space-between; align-items: center; }
    .card-vendor { font-size: 0.72rem; color: #9CA3AF; font-weight: 500; }
    .card-arrow {
        font-size: 0.78rem; font-weight: 700; color: var(--indigo);
        display: flex; align-items: center; gap: 0.2rem;
        transition: transform .2s ease;
    }

    /* ── PAGINATION ──────────────────────────────────────── */
    .pagination-wrap { margin-top: 3rem; display: flex; justify-content: center; }

    /* ── MODAL OVERLAY ───────────────────────────────────── */
    .modal-overlay {
        position: fixed; inset: 0; z-index: 1000;
        background: rgba(9,14,30,0.7); backdrop-filter: blur(8px);
        display: none; align-items: center; justify-content: center; padding: 1.5rem;
    }
    .modal-overlay.open { display: flex; }

    .modal-box {
        background: #fff; border-radius: 1.75rem;
        max-width: 960px; width: 100%; max-height: 92vh;
        overflow: hidden; display: flex; flex-direction: column;
        box-shadow: 0 40px 100px rgba(9,14,30,0.35);
        animation: modalIn .35s cubic-bezier(.34,1.4,.64,1);
    }
    @keyframes modalIn { from { opacity: 0; transform: scale(0.93) translateY(20px); } to { opacity: 1; transform: none; } }

    .modal-close {
        position: absolute; top: 1.25rem; right: 1.25rem; z-index: 10;
        width: 2.5rem; height: 2.5rem; border-radius: 50%;
        background: rgba(0,0,0,0.06); border: none; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: var(--text-primary); transition: background .2s;
    }
    .modal-close:hover { background: rgba(0,0,0,0.12); }

    .modal-inner {
        display: grid; grid-template-columns: 1fr 1fr;
        flex: 1; overflow: hidden;
    }
    @media (max-width: 640px) { .modal-inner { grid-template-columns: 1fr; overflow-y: auto; } }

    /* image panel */
    .modal-image-panel {
        background: #F8F9FB; position: relative;
        display: flex; flex-direction: column; overflow: hidden;
    }
    .modal-main-wrap {
        flex: 1; position: relative; overflow: hidden;
        display: flex; align-items: center; justify-content: center; min-height: 0;
    }
    .modal-main-img { max-width: 100%; max-height: 100%; object-fit: contain; padding: 1.5rem; }

    .slider-btn {
        position: absolute; top: 50%; transform: translateY(-50%);
        width: 2.25rem; height: 2.25rem; border-radius: 50%;
        background: #fff; border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: box-shadow .2s, background .2s;
        color: var(--text-primary);
    }
    .slider-btn:hover { background: var(--navy); color: #fff; box-shadow: 0 4px 12px rgba(15,23,41,.2); }
    .slider-btn.left { left: 0.75rem; }
    .slider-btn.right { right: 0.75rem; }

    .modal-thumbs { display: flex; gap: 0.5rem; padding: 0.75rem 1rem; overflow-x: auto; flex-shrink: 0; }
    .modal-thumbs::-webkit-scrollbar { height: 3px; }
    .modal-thumbs::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }
    .modal-thumb {
        width: 3.25rem; height: 3.25rem; border-radius: 0.5rem; object-fit: cover;
        cursor: pointer; border: 2px solid transparent; flex-shrink: 0;
        transition: border-color .2s, transform .2s;
    }
    .modal-thumb:hover { transform: scale(1.05); }
    .modal-thumb.active { border-color: var(--indigo); }

    /* details panel */
    .modal-details-panel {
        padding: 2rem 2rem 2rem; overflow-y: auto; display: flex; flex-direction: column;
        position: relative;
    }
    .modal-eyebrow { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--indigo); margin-bottom: 0.35rem; }
    .modal-product-name {
        font-family: 'Fraunces', serif;
        font-size: 1.85rem; font-weight: 700; line-height: 1.2;
        color: var(--text-primary); margin-bottom: 0.35rem;
    }
    .modal-vendor-name { font-size: 0.85rem; color: var(--text-secondary); font-style: italic; margin-bottom: 1.5rem; }
    .modal-divider { height: 1px; background: var(--border); margin: 1.25rem 0; }
    .modal-section-label { font-size: 0.7rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin-bottom: 0.5rem; }
    .modal-description { font-size: 0.9rem; color: #374151; line-height: 1.65; }

    .modal-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 1.25rem; }
    .modal-meta-item {
        background: var(--slate-bg); border-radius: 0.75rem;
        padding: 0.75rem 1rem; border: 1px solid var(--border);
    }
    .modal-meta-key { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin-bottom: 0.2rem; }
    .modal-meta-val { font-size: 0.9rem; font-weight: 600; color: var(--text-primary); text-transform: capitalize; }

    .modal-cta-wrap { margin-top: auto; padding-top: 1.5rem; }

    .btn-approve {
        width: 100%; padding: 0.9rem 1.5rem;
        background: linear-gradient(135deg, var(--indigo) 0%, #6D28D9 100%);
        color: #fff; border: none; border-radius: 0.875rem;
        font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 700;
        cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem;
        box-shadow: 0 8px 20px rgba(79,70,229,.35);
        transition: transform .2s, box-shadow .2s, opacity .2s;
    }
    .btn-approve:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(79,70,229,.45); }
    .btn-approve:active { transform: none; }
    .btn-approve.approved {
        background: linear-gradient(135deg, var(--emerald) 0%, #059669 100%);
        box-shadow: 0 8px 20px rgba(16,185,129,.3);
        cursor: default;
    }
    .btn-approve.approved:hover { transform: none; box-shadow: 0 8px 20px rgba(16,185,129,.3); }
    .btn-approve:disabled { opacity: 0.65; cursor: not-allowed; }

    /* ── LOADING SKELETON ────────────────────────────────── */
    .modal-loading {
        display: flex; align-items: center; justify-content: center;
        height: 100%; color: var(--text-secondary); gap: 0.75rem; font-size: 0.9rem;
    }
    .spinner {
        width: 1.25rem; height: 1.25rem; border: 2px solid var(--border);
        border-top-color: var(--indigo); border-radius: 50%;
        animation: spin .7s linear infinite;
    }
    @keyframes spin { to { transform: rotate(360deg); } }
</style>
@endpush

@section('content')
@php
    dd("Hello");
@endphp
<!-- Page Header -->
<div class="page-header">
    <div class="page-header-inner">
        <div class="page-eyebrow">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            Product Catalogue
        </div>
        <h1 class="page-title">{{ $pageData['title'] }}</h1>
        <p class="page-subtitle">Discover and approve high-quality products from verified vendors for your school.</p>
    </div>
</div>

<!-- Main Layout -->
<div class="layout-wrap" style="padding-bottom: 5rem;">
    <div class="layout-grid">

        <!-- Filters Sidebar -->
        <aside>
            <form action="{{ route('school.products.index') }}" method="GET" class="filter-sidebar">
                <div class="filter-title">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
                    Filters
                </div>

                <div class="filter-group">
                    <label class="filter-label">Category</label>
                    <select name="category_id" onchange="this.form.submit()" class="filter-select">
                        <option value="">All Categories</option>
                        @foreach(category([]) as $category)
                            <option value="{{ $category->category_id }}" {{ request('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Gender</label>
                    <select name="gender_type" onchange="this.form.submit()" class="filter-select">
                        <option value="">All Genders</option>
                        <option value="boys" {{ request('gender_type') == 'boys' ? 'selected' : '' }}>Boys</option>
                        <option value="girls" {{ request('gender_type') == 'girls' ? 'selected' : '' }}>Girls</option>
                        <option value="unisex" {{ request('gender_type') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Vendor</label>
                    <select name="vendor_id" onchange="this.form.submit()" class="filter-select">
                        <option value="">All Vendors</option>
                        @foreach(vendors([]) as $vendor)
                            <option value="{{ $vendor->vendor_id }}" {{ request('vendor_id') == $vendor->vendor_id ? 'selected' : '' }}>
                                {{ $vendor->business_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-divider"></div>

                <a href="{{ route('school.products.index') }}" class="clear-filters">
                    Clear all filters
                </a>
            </form>
        </aside>

        <!-- Product Grid -->
        <main>
            <div class="products-grid">
                @forelse($products as $product)
                    <div class="product-card" onclick="openProductDetails('{{ $product->product_id }}')">
                        @if($product->is_school_approved)
                            <div class="approved-ribbon">
                                <svg width="10" height="10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                Approved
                            </div>
                        @endif

                        <div class="card-image">
                            <img src="{{ $product->firstImage() }}" alt="{{ $product->product_name }}" loading="lazy">
                            <span class="card-category-badge">{{ $product->category->category_name ?? 'General' }}</span>
                        </div>

                        <div class="card-body">
                            <div class="card-name">{{ $product->product_name }}</div>
                            <p class="card-desc">{{ $product->description }}</p>
                            <div class="card-footer">
                                <span class="card-vendor">{{ $product->vendor->business_name ?? 'N/A' }}</span>
                                <span class="card-arrow">
                                    View
                                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 4rem 0; color: var(--text-secondary);">
                        <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24" style="margin: 0 auto 1rem; color: #D1D5DB;"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10"/></svg>
                        <p style="font-weight: 600; font-size: 1rem; color: var(--text-primary); margin-bottom: 0.25rem;">No products found</p>
                        <p style="font-size: 0.875rem;">Try adjusting your filters to see more results.</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrap">
                {{ $products->links() }}
            </div>
        </main>
    </div>
</div>


<!-- ── PRODUCT DETAIL MODAL ────────────────────────────── -->
<div id="product-modal" class="modal-overlay" onclick="onOverlayClick(event)">
    <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="modal-product-name">

        <button class="modal-close" onclick="closeProductDetails()" aria-label="Close">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Loading state -->
        <div id="modal-loading" class="modal-loading" style="min-height: 500px;">
            <div class="spinner"></div>
            <span>Loading product details…</span>
        </div>

        <!-- Content (hidden until loaded) -->
        <div id="modal-content" class="modal-inner" style="display: none;">

            <!-- Image Panel -->
            <div class="modal-image-panel">
                <div class="modal-main-wrap">
                    <img id="modal-main-image" src="" alt="Product image" class="modal-main-img">

                    <button class="slider-btn left" id="prev-btn" onclick="prevImage()" aria-label="Previous image">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button class="slider-btn right" id="next-btn" onclick="nextImage()" aria-label="Next image">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                <div id="modal-thumbnails" class="modal-thumbs"></div>
            </div>

            <!-- Details Panel -->
            <div class="modal-details-panel">
                <div>
                    <div id="modal-category" class="modal-eyebrow"></div>
                    <h2 id="modal-name" class="modal-product-name"></h2>
                    <p id="modal-vendor" class="modal-vendor-name"></p>

                    <div class="modal-section-label">Description</div>
                    <p id="modal-description" class="modal-description"></p>

                    <div class="modal-meta-grid">
                        <div class="modal-meta-item">
                            <div class="modal-meta-key">Gender</div>
                            <div id="modal-gender" class="modal-meta-val"></div>
                        </div>
                        <div class="modal-meta-item">
                            <div class="modal-meta-key">Fabric</div>
                            <div id="modal-fabric" class="modal-meta-val"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-cta-wrap">
                    <button id="approve-btn" class="btn-approve" onclick="approveProduct()">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        <span id="approve-btn-text">Approve for my School</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let currentImages = [];
    let currentImageIndex = 0;
    let currentProductId = null;

    async function openProductDetails(productId) {
        currentProductId = productId;
        const modal = document.getElementById('product-modal');
        const loadingEl = document.getElementById('modal-loading');
        const contentEl = document.getElementById('modal-content');

        // Show modal in loading state
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';
        loadingEl.style.display = 'flex';
        contentEl.style.display = 'none';

        try {
            const response = await fetch(`/school-products/${productId}`);
            const data = await response.json();

            if (!data.success) throw new Error('Failed to load');

            const p = data.product;
            currentImages = data.images || [];
            currentImageIndex = 0;

            // Populate text
            document.getElementById('modal-name').textContent = p.product_name;
            document.getElementById('modal-category').textContent = p.category?.category_name || 'General';
            document.getElementById('modal-vendor').textContent = 'By ' + (p.vendor?.business_name || 'Unknown Vendor');
            document.getElementById('modal-description').textContent = p.description || 'No description available.';
            document.getElementById('modal-gender').textContent = p.gender_type || '—';
            document.getElementById('modal-fabric').textContent = p.fabric_composition || 'Not specified';

            // Approval button
            const approveBtn = document.getElementById('approve-btn');
            const approveBtnText = document.getElementById('approve-btn-text');
            if (data.is_school_approved) {
                approveBtn.classList.add('approved');
                approveBtnText.textContent = '✓ Approved for School';
                approveBtn.onclick = null;
            } else {
                approveBtn.classList.remove('approved');
                approveBtnText.textContent = 'Approve for my School';
                approveBtn.onclick = approveProduct;
            }

            // Thumbnails
            const thumbContainer = document.getElementById('modal-thumbnails');
            thumbContainer.innerHTML = '';
            currentImages.forEach((imgSrc, idx) => {
                const thumb = document.createElement('img');
                thumb.src = imgSrc;
                thumb.className = 'modal-thumb' + (idx === 0 ? ' active' : '');
                thumb.alt = `Product image ${idx + 1}`;
                thumb.onclick = () => setIndex(idx);
                thumbContainer.appendChild(thumb);
            });

            // Slider nav visibility
            const hasMultiple = currentImages.length > 1;
            document.getElementById('prev-btn').style.display = hasMultiple ? 'flex' : 'none';
            document.getElementById('next-btn').style.display = hasMultiple ? 'flex' : 'none';

            updateSlider();

            // Reveal
            loadingEl.style.display = 'none';
            contentEl.style.display = 'grid';

        } catch (error) {
            loadingEl.innerHTML = '<p style="color: #EF4444; font-size: 0.9rem;">Failed to load product details. Please try again.</p>';
            console.error(error);
        }
    }

    async function approveProduct() {
        if (!currentProductId) return;
        const btn = document.getElementById('approve-btn');
        const btnText = document.getElementById('approve-btn-text');

        btn.disabled = true;
        btnText.textContent = 'Processing…';

        try {
            const response = await fetch(`/school-products/${currentProductId}/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();

            if (data.success) {
                btn.classList.add('approved');
                btnText.textContent = '✓ Approved for School';
                btn.onclick = null;
            } else {
                alert(data.message || 'Error approving product. Please try again.');
                btnText.textContent = 'Approve for my School';
            }
        } catch {
            alert('Something went wrong. Please try again.');
            btnText.textContent = 'Approve for my School';
        } finally {
            btn.disabled = false;
        }
    }

    function setIndex(index) {
        currentImageIndex = index;
        updateSlider();
        document.querySelectorAll('.modal-thumb').forEach((t, i) => {
            t.classList.toggle('active', i === index);
        });
    }

    function updateSlider() {
        document.getElementById('modal-main-image').src = currentImages[currentImageIndex] || '';
    }

    function prevImage() {
        if (currentImageIndex > 0) setIndex(currentImageIndex - 1);
    }

    function nextImage() {
        if (currentImageIndex < currentImages.length - 1) setIndex(currentImageIndex + 1);
    }

    function closeProductDetails() {
        document.getElementById('product-modal').classList.remove('open');
        document.body.style.overflow = '';
    }

    function onOverlayClick(e) {
        if (e.target === document.getElementById('product-modal')) closeProductDetails();
    }

    // Keyboard navigation
    document.addEventListener('keydown', e => {
        const modal = document.getElementById('product-modal');
        if (!modal.classList.contains('open')) return;
        if (e.key === 'Escape') closeProductDetails();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
</script>
@endpush