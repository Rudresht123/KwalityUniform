<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us | eSchool Cart</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom Style Sheets -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/responsive.css" rel="stylesheet" />
  </head>
  <body data-page="about">
    <!-- Announcement Bar -->
    <div class="qu-announcement">
      🎒 Back to School Sale: Save 15% on All Complete School Uniform Bundles!
    </div>

    <!-- Sticky Header -->
    <header class="qu-navbar sticky-top shadow-sm">
      <div class="container d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center"><img src="assets/images/logo.svg" alt="eSchoolKart Logo" style="height: 42px; width: auto;" referrerPolicy="no-referrer"></a>
        
        <nav class="nav-links">
          <a href="index.html" class="nav-item-link">Home / Schools</a>
          <a href="shop.html" class="nav-item-link">Catalogue</a>
          <a href="about.html" class="nav-item-link active">About Us</a>
          <a href="contact.html" class="nav-item-link">Contact</a>
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
          <a href="cart.html" class="action-icon-btn" title="Cart">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path>
              <path d="M3 6h18"></path>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="action-badge" id="cart-badge" style="display: none;">0</span>
          </a>

          <!-- Account State (Injected by JS) -->
          <div id="header-user-display"></div>
        </div>
      </div>
    </header>

    <!-- Page Header (Full Width Banner with Background Image) -->
    <div class="geo-page-header" style="background-image: url('https://images.unsplash.com/photo-1588072432836-e10032774350?auto=format&fit=crop&q=80&w=1200');">
      <div class="container">
        <h1 class="display-6 fw-extrabold text-white mb-2">About Us</h1>
        <ul class="geo-breadcrumb mb-0">
          <li><a href="index.html">Home</a></li>
          <li>&bull;</li>
          <li class="active-item">About Us</li>
        </ul>
      </div>
    </div>

    <!-- Main Content -->
    <main class="container py-5">
      
      <!-- Page Heading Section -->
      <div class="row align-items-center mb-5 g-5">
        <div class="col-lg-6">
          <span class="badge-geo mb-3">Our Core Story</span>
          <h1 class="display-5 fw-extrabold mb-4" style="color: var(--qu-primary);">
            Preserving Academic Traditions, Designing Modern Comfort.
          </h1>
          <p class="lead text-secondary mb-4">
            Founded with a vision to streamline dress-code compliance, eSchool Cart designs and manufactures authorized uniforms that respect school identity while supporting high durability.
          </p>
          <p class="text-secondary mb-0">
            We partner with regional school districts, parent-teacher associations, and headmasters to deliver tailored school garments with precise color codes, custom cresting, and comfortable fits that stand up to active student life.
          </p>
        </div>
        <div class="col-lg-6">
          <!-- Visual Panel with 20px corners matching geometric balance -->
          <div class="card-geo p-0 overflow-hidden shadow-lg border-0" style="height: 380px;">
            <img src="https://images.unsplash.com/photo-1596495578065-6e0763fa1141?auto=format&fit=crop&q=80&w=1200" alt="Students in Classroom" style="width:100%; height:100%; object-fit: cover;">
          </div>
        </div>
      </div>

      <!-- Core Values -->
      <div class="py-5 border-top border-bottom mb-5">
        <h3 class="text-center fw-bold mb-5 font-display" style="color: var(--qu-primary);">The Pillars of eSchool Cart</h3>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card-geo text-center p-4">
              <h5 class="fw-bold mb-3">100% Compliance</h5>
              <p class="text-muted small mb-0">Every product in our store undergoes strict compliance review. We certify that our blazers, pleats, patterns, and badges align perfectly with official administrative requirements.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-geo text-center p-4">
              <h5 class="fw-bold mb-3">Eco-Friendly Craft</h5>
              <p class="text-muted small mb-0">We actively source premium recycled polyester yarns and organic cotton, treated with certified skin-safe fabrics to produce comfortable, sustainable wear.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card-geo text-center p-4">
              <h5 class="fw-bold mb-3">Sizing Guarantee</h5>
              <p class="text-muted small mb-0">Students grow fast. Our custom sizing guides and easy, flexible, low-cost multi-pack bundles make it simple for parents to handle rapid fitting changes.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- District Sourcing Map Section -->
      <div class="row align-items-center g-5 mb-5">
        <div class="col-lg-6 order-lg-2">
          <span class="badge-geo mb-3">Global Quality Sourcing</span>
          <h3 class="fw-bold mb-3" style="color: var(--qu-primary);">State-of-the-Art Production</h3>
          <p class="text-secondary">
            Our supply network utilizes top-tier textile mills that specialize in long-staple cotton and double-weave polyesters. Every batch of school plaid is dye-locked to prevent fading over heavy wash cycles.
          </p>
          <div class="d-flex align-items-center gap-4 mt-4">
            <div>
              <h4 class="fw-bold mb-0 text-dark">4+</h4>
              <span class="text-muted small">School Districts</span>
            </div>
            <div class="border-start ps-4">
              <h4 class="fw-bold mb-0 text-dark">5,000+</h4>
              <span class="text-muted small">Happy Parents</span>
            </div>
            <div class="border-start ps-4">
              <h4 class="fw-bold mb-0 text-dark">12+</h4>
              <span class="text-muted small">Approved Items</span>
            </div>
          </div>
        </div>
        <div class="col-lg-6 order-lg-1">
          <div class="card-geo p-0 overflow-hidden shadow-lg border-0" style="height: 350px;">
            <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=1200" alt="Sewing production" style="width:100%; height:100%; object-fit: cover;">
          </div>
        </div>
      </div>

    </main>

    <!-- Footer -->
    <footer class="footer-geo">
      <div class="container footer-inner">
        <div>
          <span style="font-family: var(--font-display); font-weight: 800; color: var(--qu-primary);">ESCHOOL</span><span style="font-family: var(--font-display); font-weight: 300;">CART</span>
          <p class="mb-0 mt-1" style="font-size: 11px; color: #9CA3AF;">&copy; 2026 eSchool Cart Inc. All institutional designs are property of official regional school boards.</p>
        </div>
        <div class="footer-links-geo">
          <a href="about.html">About Us</a>
          <a href="shop.html">Catalogue</a>
          <a href="contact.html">Contact Us</a>
          <a href="wishlist.html">Wishlist</a>
        </div>
      </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Application Logic -->
    <script src="assets/js/app.js"></script>
  </body>
</html>
