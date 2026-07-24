    <!-- 2. Sticky Header -->
    <header class="qu-navbar sticky-top shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Desktop Logo -->
            <a href="{{ url('/') }}" class="logo-website d-none d-md-flex align-items-center">
                <img src="{{ asset('assets/website/images/logo.svg') }}" alt="QualityUniform Logo"
                    style="height:42px; width:auto;">
            </a>

            <!-- Mobile Logo -->
            <a href="{{ url('/') }}" class="logo-website d-flex d-md-none align-items-center">
                <img src="{{ asset('assets/icons/fav.png') }}" alt="QualityUniform Logo"
                    style="height:38px; width:auto;">
            </a>

            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-item-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="{{ route('website.shop') }}"
                    class="nav-item-link {{ request()->routeIs('website.shop') ? 'active' : '' }}">Catalogue</a>
                @auth
                    <a href="{{ route('website.orders.index') }}"
                        class="nav-item-link {{ request()->routeIs('website.orders.index') ? 'active' : '' }}">My Orders</a>
                @endauth
                <a href="{{ route('website.about') }}"
                    class="nav-item-link {{ request()->routeIs('website.about') ? 'active' : '' }}">About Us</a>
                <a href="{{ route('website.contact') }}"
                    class="nav-item-link {{ request()->routeIs('website.contact') ? 'active' : '' }}">Contact</a>
                
                <div class="nav-dropdown">
                    <a href="#" class="nav-item-link dropdown-toggle">
                        Legal <i class="ti ti-chevron-down ms-1" style="font-size: 10px;"></i>
                    </a>
                    <div class="dropdown-menu-premium">
                        <a href="{{ route('website.terms') }}" class="{{ request()->routeIs('website.terms') ? 'active' : '' }}">Terms & Conditions</a>
                        <a href="{{ route('website.privacy') }}" class="{{ request()->routeIs('website.privacy') ? 'active' : '' }}">Privacy Policy</a>
                        <a href="{{ route('website.returns') }}" class="{{ request()->routeIs('website.returns') ? 'active' : '' }}">Return Policy</a>
                    </div>
                </div>
            </nav>

            <div class="header-actions">
                <div class="search-mini-wrap">
                    <input type="text" id="header-search-input" class="search-mini-input"
                        placeholder="Search school or item...">
                    <svg class="search-mini-icon" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" width="14" height="14">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <!-- Wishlist Link -->
                @auth
                    <a href="{{ route('website.wishlist.index') }}" class="action-icon-btn" title="Wishlist">
                    @else
                        <a href="#" class="action-icon-btn" title="Wishlist" data-bs-toggle="modal"
                            data-bs-target="#loginModal">
                        @endauth
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path>
                        </svg>
                        <span class="action-badge" id="wishlist-badge" style="display: none;">0</span>
                    </a>

                    <!-- Cart Link -->
                    <a href="{{ route('website.cart.index') }}" class="action-icon-btn" title="Cart"
                        id="cart-icon-link">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
                            <path d="M3 6h18"></path>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="action-badge cart-count-badge" id="cart-badge">0</span>
                    </a>

                    <!-- Account State -->
                    <div id="header-user-display">
                        @auth
                            <a href="#" class="action-icon-btn" title="My Account" id="user-account-link"
                                data-bs-toggle="modal" data-bs-target="#userModal">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </a>
                        @else
                            <a href="#" class="action-icon-btn" title="Login" data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </a>
                        @endauth
                    </div>
            </div>
    </header>
