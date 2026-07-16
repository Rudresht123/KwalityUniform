@include('layouts.modals.editmodal', [
    'modalId' => 'productShow',
    'title' => 'Product Details',
    'modalClass' => 'qv-modal-premium',
    'subtitle' => 'Uniform specification & availability',
    'showFooter' => false,
    'buttonText' => 'Add To Basket',
])

<div class="row my-3">
    @forelse($products as $product)
        <div class="col-lg-3 col-md-4 mb-4">
            <div class="premium-product-card" data-product-id="{{ $product->product_id }}">
                <div class="premium-card-image-wrapper">
                    <div class="premium-badge">Official</div>
                    <button class="product-wishlist-geo" data-product-id="{{ $product->product_id }}"
                        onclick="State.toggleWishlist('{{ $product->product_id }}', this); event.stopPropagation();"
                        title="Add to Wishlist">
                        <svg class="wishlist-heart-svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                    </button>
                    <div class="premium-image-container" style="cursor: pointer;"
                        onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                        <img src="{{ $product->firstImage() }}" alt="{{ $product->product_name }}"
                            class="premium-product-img">
                        <div class="premium-image-overlay">
                            <span class="premium-view-text editUrl"
                                data-url="{{ route('website.product.json', $product->product_id) }}"
                                data-modalid="productShow">Quick View</span>
                        </div>
                    </div>
                </div>


                <div class="premium-card-body">
                    <div class="premium-school-tag">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" class="me-1">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                        {{ $product->schoolApprovals->first()?->school?->school_name ?? 'General Wear' }}
                    </div>

                    <h4 class="premium-product-title" style="cursor: pointer;"
                        onclick="window.location.href='{{ route('website.shop') }}?id={{ $product->id }}">
                        {{ $product->product_name }}
                    </h4>

                    <div class="premium-card-footer">
                        <div class="premium-price">
                            {{ number_format($product->variants->first()?->selling_price ?? $product->selling_price ?? 0, 2) }}
                        </div>
                        <div class="premium-add-btn-container">
                        </div>


                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div id="shop-empty-state" class="text-center py-5 card-geo">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#6B7280"
                    stroke-width="1.5" class="mb-3">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h4 class="fw-bold">No garments found</h4>
                <p class="text-muted small">Try relaxing your search terms or picking another school portal.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="col-12 mt-5">
    @if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $products->appends(request()->query())->links() }}
    @endif
</div>
