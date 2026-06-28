@forelse($products as $product)
    <div class="col-lg-4 col-md-6">
        <div class="product-card-geo">
            <div class="product-thumb-geo" style="cursor: pointer;" onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                <img src="{{ $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg') }}" alt="{{ $product->product_name }}">
            </div>
            <div class="product-school-geo">{{ $product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}</div>
            <h4 class="product-name-geo" style="cursor: pointer;" onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">{{ $product->product_name }}</h4>
            <div class="product-price-geo">${{ number_format($product->price, 2) }}</div>
            <button class="btn btn-primary btn-sm mt-3 w-100" onclick="State.addToCart({{ json_encode([
                'id' => $product->id,
                'name' => $product->product_name,
                'price' => $product->price,
                'image' => $product->image_url ? asset($product->image_url) : asset('assets/images/no_image.jpg'),
                'sizes' => $product->variants->pluck('size')->unique()->toArray(),
                'colors' => $product->variants->pluck('color')->unique()->map(fn($c) => ['name' => $c, 'value' => '#CCC'])->toArray()
            ]) }}, 1, 'M', 'Default Color')">Add to Basket</button>
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
