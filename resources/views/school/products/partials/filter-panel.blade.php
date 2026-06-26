<div class="filter-card">
    <form id="filterForm">
        <!-- Search -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Search Product</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0"><i class="ti ti-search text-muted"></i></span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Search products...">
            </div>
        </div>

        <!-- Category Filter -->
        <div class="accordion accordion-flush mb-4" id="categoryAccordion">
            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold small text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory">
                        Categories
                    </button>
                </h2>
                <div id="collapseCategory" class="accordion-collapse collapse" data-bs-parent="#categoryAccordion">
                    <div class="accordion-body p-0">
                        <div class="list-group list-group-flush">
                            <label class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2">
                                <input class="form-check-input" type="checkbox" value="blazers"> Blazers
                            </label>
                            <label class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2">
                                <input class="form-check-input" type="checkbox" value="shirts"> Shirts
                            </label>
                            <label class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2">
                                <input class="form-check-input" type="checkbox" value="trousers"> Trousers
                            </label>
                            <label class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-2">
                                <input class="form-check-input" type="checkbox" value="skirts"> Skirts
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Brand Filter -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Brands</label>
            <div class="d-flex flex-column gap-2">
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="elite"> Elite Uniforms
                </label>
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="premium"> Premium Wear
                </label>
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="comfort"> Comfort Fit
                </label>
            </div>
        </div>

        <!-- Gender Filter -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Gender</label>
            <div class="d-flex flex-wrap gap-2">
                <input type="radio" class="btn-check" name="gender" id="genderMen" autocomplete="off">
                <label class="btn btn-outline-secondary btn-sm rounded-pill" for="genderMen">Men</label>

                <input type="radio" class="btn-check" name="gender" id="genderWomen" autocomplete="off">
                <label class="btn btn-outline-secondary btn-sm rounded-pill" for="genderWomen">Women</label>

                <input type="radio" class="btn-check" name="gender" id="genderUnisex" autocomplete="off">
                <label class="btn btn-outline-secondary btn-sm rounded-pill" for="genderUnisex">Unisex</label>
            </div>
        </div>

        <!-- Size Filter -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Size</label>
            <div class="d-flex flex-wrap gap-2">
                @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                <input type="checkbox" class="btn-check" id="size-{{ $size }}" autocomplete="off">
                <label class="btn btn-outline-secondary btn-sm rounded-3" for="size-{{ $size }}">{{ $size }}</label>
                @endforeach
            </div>
        </div>

        <!-- Color Filter -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Colors</label>
            <div class="d-flex flex-wrap gap-1">
                <span class="color-circle active" style="background-color: #000080;" title="Navy Blue"></span>
                <span class="color-circle" style="background-color: #4B0082;" title="Indigo"></span>
                <span class="color-circle" style="background-color: #000000;" title="Black"></span>
                <span class="color-circle" style="background-color: #FFFFFF; border: 1px solid #ddd;" title="White"></span>
                <span class="color-circle" style="background-color: #808080;" title="Grey"></span>
                <span class="color-circle" style="background-color: #B22222;" title="Maroon"></span>
            </div>
        </div>

        <!-- Price Range -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Price Range</label>
            <div class="d-flex align-items-center gap-2">
                <input type="range" class="form-range" min="0" max="500" step="10" id="priceRange">
                <span class="fw-medium small">$<span id="priceValue">250</span></span>
            </div>
        </div>

        <!-- Rating Filter -->
        <div class="mb-4">
            <label class="form-label fw-bold small text-uppercase">Rating</label>
            <div class="d-flex flex-column gap-1">
                @for($i = 5; $i >= 1; $i--)
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="{{ $i }}">
                    <div class="text-warning">
                        @for($j = 0; $j < $i; $j++) <i class="ti ti-star-filled"></i> @endfor
                        @for($j = $i; $j < 5; $j++) <i class="ti ti-star"></i> @endfor
                    </div>
                    <span>& Up</span>
                </label>
                @endfor
            </div>
        </div>

        <!-- Availability & Discount -->
        <div class="mb-4">
            <div class="d-flex align-items-center gap-3">
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="in-stock"> In Stock
                </label>
                <label class="d-flex align-items-center gap-2 small">
                    <input class="form-check-input" type="checkbox" value="discounted"> Discounted
                </label>
            </div>
        </div>

        <!-- Actions -->
        <div class="d-grid gap-2 mt-4">
            <button type="reset" class="btn btn-light btn-premium border">Clear All Filters</button>
            <button type="submit" class="btn btn-primary-premium btn-premium">Apply Filters</button>
        </div>
    </form>
</div>
