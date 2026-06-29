@forelse($products as $product)
    <tr data-id="{{ $product->product_id }}" data-name="{{ $product->product_name }}"
        data-cat="{{ $product->category->category_name ?? '' }}"
        data-vendor="{{ $product->vendor->business_name ?? '' }}">

        {{-- Product --}}
        <td>
            <div class="prod-cell">
                <div class="prod-img-wrap">
                    <img src="{{ $product->firstImage() }}" alt="{{ $product->product_name }}"
                        loading="lazy">
                    <div class="prod-img-badge">
                        <i class="ti ti-check"></i>
                    </div>
                </div>
                <div class="prod-info">
                    <div class="prod-name">{{ $product->product_name }}</div>
                    <div class="prod-id">#{{ $product->product_id }}</div>
                </div>
            </div>
        </td>

        {{-- Category --}}
        <td>
            <span class="cat-pill">
                <i class="ti ti-tag"></i>
                {{ $product->category->category_name ?? 'General' }}
            </span>
        </td>

        {{-- Vendor --}}
        <td>
            <div class="vendor-cell">
                <div class="vendor-avatar">
                    {{ strtoupper(substr($product->vendor->business_name ?? 'N', 0, 1)) }}
                </div>
                <span class="vendor-name">{{ $product->vendor->business_name ?? '—' }}</span>
            </div>
        </td>

        {{-- Status --}}
        <td>
            <span class="status-badge">
                <i class="ti ti-circle-check"></i>
                Approved
            </span>
        </td>

        {{-- Actions --}}
        <td>
            <div class="action-cell">
                <a href="#" class="btn-icon" title="View product" onclick="viewProduct('{{ $product->product_id }}')">
                    <i class="ti-eye"></i>
                </a>
                <button class="btn-unapprove"
                    onclick="confirmUnapprove('{{ $product->product_id }}', '{{ addslashes($product->product_name) }}')"
                    title="Remove from approved list">
                    <i class="ti ti-circle-minus"></i>
                    Remove
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5">
            <div class="empty-state">
                <div class="empty-icon-wrap">
                    <i class="ti ti-package-off"></i>
                </div>
                <div class="empty-title">No approved products found</div>
                <div class="empty-sub">
                    No products match your current filters.
                </div>
            </div>
        </td>
    </tr>
@endforelse