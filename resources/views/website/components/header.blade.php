    <!-- 2. Sticky Header -->
    <header class="qu-navbar sticky-top shadow-sm">
      <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center"><img src="{{ asset('assets/website/images/logoas.svg') }}" alt="eSchoolKart Logo" style="height: 42px; width: auto;" referrerPolicy="no-referrer"></a>
        
        <nav class="nav-links">
          <a href="{{ url('/') }}" class="nav-item-link {{ request()->is('/') ? 'active' : '' }}">Home / Schools</a>
          <a href="{{ route('website.shop') }}" class="nav-item-link {{ request()->routeIs('website.shop') ? 'active' : '' }}">Catalogue</a>
          <a href="{{ route('website.about') }}" class="nav-item-link {{ request()->routeIs('website.about') ? 'active' : '' }}">About Us</a>
          <a href="{{ route('website.contact') }}" class="nav-item-link {{ request()->routeIs('website.contact') ? 'active' : '' }}">Contact</a>
        </nav>
        
        <div class="header-actions">
          <div class="search-mini-wrap">
            <input type="text" id="header-search-input" class="search-mini-input" placeholder="Search school or item...">
            <svg class="search-mini-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="14" height="14">
              <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
          
          <!-- Wishlist Link -->
          <a href="wishlist.html" class="action-icon-btn" title="Wishlist">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            <span class="action-badge" id="wishlist-badge" style="display: none;">0</span>
          </a>

          <!-- Cart Link -->
          <a href="{{ route('website.cart.index') }}" class="action-icon-btn" title="Cart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
              <path d="M3 6h18"></path>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="action-badge" id="cart-badge" style="display: none;">0</span>
          </a>



          <!-- Account State -->
          <div id="header-user-display"></div>
        </div>
      </div>
    </header>