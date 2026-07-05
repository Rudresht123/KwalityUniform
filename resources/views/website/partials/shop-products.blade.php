@forelse($products as $product)
    <div class="col-lg-4 col-md-6">
        <div class="premium-product-card">
            <div class="premium-card-image-wrapper">
                <div class="premium-badge">Official</div>
                <div class="premium-image-container" style="cursor: pointer;" onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                    <img src="{{ $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg') }}" alt="{{ $product->product_name }}" class="premium-product-img">
                    <div class="premium-image-overlay">
                        <span class="premium-view-text">Quick View</span>
                    </div>
                </div>
            </div>
            
            <div class="premium-card-body">
                <div class="premium-school-tag">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                    </svg>
                    {{ $product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}
                </div>
                
                <h4 class="premium-product-title" style="cursor: pointer;" onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                    {{ $product->product_name }}
                </h4>
                
                <div class="premium-card-footer">
                    <div class="premium-price">${{ number_format($product->price, 2) }}</div>
                    <button class="premium-add-btn" onclick="State.addToCart({{ json_encode([
                        'id' => $product->id,
                        'name' => $product->product_name,
                        'price' => $product->price,
                        'image' => $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg'),
                        'sizes' => $product->variants->pluck('size')->unique()->toArray(),
                        'colors' => $product->variants->pluck('color')->unique()->map(fn($c) => ['name' => $c, 'value' => '#CCC'])->toArray()
                    ]) }}, 1, 'M', 'Default Color')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        Add to Basket
                    </button>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <div id="shop-empty-state" class="text-center py-5 card-geo">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6B7280" stroke-width="1.5" class="mb-3">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <h4 class="fw-bold">No garments found</h4>
            <p class="text-muted small">Try relaxing your search terms or picking another school portal.</p>
        </div>
    </div>
@endforelse

<div class="col-12 mt-5">
    {{ $products->appends(request()->query())->links() }}
</div>

<style>
    .premium-product-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .premium-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: var(--qu-primary);
    }

    .premium-card-image-wrapper {
        position: relative;
        padding: 12px;
        background: #f8fafc;
    }

    .premium-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        background: var(--qu-primary);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 50px;
        z-index: 2;
        letter-spacing: 0.5px;
    }

    .premium-image-container {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        aspect-ratio: 1/1;
        background: #fff;
    }

    .premium-product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.33, 1, 0.68, 1);
    }

    .premium-product-card:hover .premium-product-img {
        transform: scale(1.08);
    }

    .premium-image-overlay {
        position: absolute;
        inset: 0;
        background: rgba(30, 58, 138, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(2px);
    }

    .premium-product-card:hover .premium-image-overlay {
        opacity: 1;
    }

    .premium-view-text {
        background: #fff;
        color: var(--qu-primary);
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .premium-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .premium-school-tag {
        display: flex;
        align-items: center;
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .premium-product-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        transition: color 0.2s ease;
        line-height: 1.4;
    }

    .premium-product-card:hover .premium-product-title {
        color: var(--qu-primary);
    }

    .premium-card-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .premium-price {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
    }

    .premium-add-btn {
        background: var(--qu-primary);
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(30, 58, 138, 0.2);
    }

    .premium-add-btn:hover {
        background: #162d70;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(30, 58, 138, 0.3);
    }
</style>

