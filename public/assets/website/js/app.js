// eSchool Cart - Unified Data Store & State Controller for Multi-Page Website

// Premium preloader self-injection
(function() {
  const initLoader = () => {
    if (document.getElementById('premium-loader')) return;

    // Prevent scrolling while loader is active
    document.body.classList.add('loader-active');

    const loaderWrap = document.createElement('div');
    loaderWrap.id = 'premium-loader';
    loaderWrap.className = 'premium-loader-wrap';
    loaderWrap.innerHTML = `
      <div class="loader-crest-container">
        <div class="loader-crest-ring"></div>
        <div class="loader-crest-ring-inner"></div>
        <svg class="loader-crest-svg" width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          <path d="M12 8v8"/>
          <path d="M9 11h6"/>
        </svg>
      </div>
      <div class="loader-brand-title">eSchool<span>Cart</span></div>
      <div class="loader-sub-title">Premium Institutional Wear</div>
      <div class="loader-progress-container">
        <div class="loader-progress-bar"></div>
      </div>
    `;

    document.body.insertBefore(loaderWrap, document.body.firstChild);

    // Fade out loader after 1200ms of luxury transition
    setTimeout(() => {
      fadeOutLoader();
    }, 1200);

    function fadeOutLoader() {
      if (loaderWrap.classList.contains('loaded')) return;
      
      loaderWrap.classList.add('loaded');
      document.body.classList.remove('loader-active');
      document.body.classList.add('loader-transition-active');
      
      // Clean up classes after animations complete
      setTimeout(() => {
        document.body.classList.remove('loader-transition-active');
        loaderWrap.remove();
      }, 1000);
    }
  };

  // Run as early as possible
  if (document.body) {
    initLoader();
  } else {
    document.addEventListener('DOMContentLoaded', initLoader);
  }
})();

// Global Products & Partner Schools Database
const DB = {
  schools: [
    { 
      id: 'st-marys', 
      name: "Delhi Public School (DPS)", 
      location: "Dwarka, New Delhi", 
      founded: "1949", 
      enrollment: "2,500 Students", 
      themeColor: "#065F46", 
      crestColor: "#F3F4F6", 
      bgImage: "https://images.unsplash.com/photo-1588072432836-e10032774350?auto=format&fit=crop&q=80&w=800", 
      description: "A premier educational institution in Delhi NCR, mandating forest-green winter pullovers, official salwar kameez sets, and pleated tunics." 
    },
    { 
      id: 'oakwood', 
      name: "St. Xavier's High School", 
      location: "Park Street, Kolkata", 
      founded: "1860", 
      enrollment: "3,100 Students", 
      themeColor: "#1E3A8A", 
      crestColor: "#F3F4F6", 
      bgImage: "https://images.unsplash.com/photo-1567057419565-4349c49d8a04?auto=format&fit=crop&q=80&w=800", 
      description: "A prestigious Jesuit institution, requiring clean sky-blue half-sleeve shirts, classic navy pleated school trousers, and striped academic neckties." 
    },
    { 
      id: 'crestview', 
      name: "DAV Public School", 
      location: "Lajpat Nagar, New Delhi", 
      founded: "1886", 
      enrollment: "2,200 Students", 
      themeColor: "#7F1D1D", 
      crestColor: "#F3F4F6", 
      bgImage: "https://images.unsplash.com/photo-1546410531-bb4caa6b424d?auto=format&fit=crop&q=80&w=800", 
      description: "Academically renowned for traditional values and modern learning. Mandated uniforms include deep burgundy pullovers and tailored charcoal trousers." 
    },
    { 
      id: 'pinecrest', 
      name: "Army Public School (APS)", 
      location: "Cantonment Board, Pune", 
      founded: "1983", 
      enrollment: "1,950 Students", 
      themeColor: "#4B5563", 
      crestColor: "#F3F4F6", 
      bgImage: "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&q=80&w=800", 
      description: "Providing holistic education to children of defense personnel. Students wear steel-grey trousers, red house t-shirts, and custom black belts." 
    }
  ],
  
  products: [
    {
      id: "blazer-st-mary",
      name: "Girls Traditional School Salwar Kameez Suit",
      price: 32.00,
      oldPrice: null,
      school: "st-marys",
      schoolName: "Delhi Public School (DPS)",
      category: "blazers",
      rating: 4.8,
      reviewsCount: 145,
      image: "https://images.unsplash.com/photo-1610030469668-93535c17b6b3?auto=format&fit=crop&q=80&w=600",
      description: "Traditional senior girls official academic salwar suit. Features a premium soft cotton collared kurti, matching pleated salwar trousers, and a lightweight breathable cotton dupatta. Highly comfortable for all-season classroom environments.",
      sizes: ["S", "M", "L", "XL", "XXL"],
      colors: [{ name: "Forest Green", value: "#065F46" }]
    },
    {
      id: "blazer-oakwood",
      name: "Girls Classic Box-Pleated School Tunic",
      price: 26.00,
      oldPrice: 35.00,
      school: "oakwood",
      schoolName: "St. Xavier's High School",
      category: "blazers",
      rating: 4.9,
      reviewsCount: 92,
      image: "https://images.unsplash.com/photo-1583391733956-3750e0ff4e8b?auto=format&fit=crop&q=80&w=600",
      description: "Official academic school tunic (pinafore) in elegant dark navy. Tailored with active poly-viscose blend fabric, adjustable button waist tabs, and reinforced stitching to withstand daily activities.",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Navy Blue", value: "#1E3A8A" }]
    },
    {
      id: "blazer-crestview",
      name: "Boys Tailored School Trouser & Shirt Set",
      price: 34.00,
      oldPrice: null,
      school: "crestview",
      schoolName: "DAV Public School",
      category: "blazers",
      rating: 4.7,
      reviewsCount: 88,
      image: "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&q=80&w=600",
      description: "Complete formal school kit featuring premium white short-sleeve collar shirt paired with official dark charcoal grey pleated uniform trousers. Extremely durable, stain-repellent, and comfortable.",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Charcoal Grey", value: "#374151" }]
    },
    {
      id: "shirt-oxford-long",
      name: "Standard Half-Sleeve School Collar Shirt",
      price: 14.00,
      oldPrice: null,
      school: "generic",
      schoolName: "Essential Wear",
      category: "shirts",
      rating: 4.6,
      reviewsCount: 215,
      image: "https://images.unsplash.com/photo-1603252109303-2751441dd157?auto=format&fit=crop&q=80&w=600",
      description: "Classic half-sleeve academic uniform shirt. Breathable, non-iron lightweight poly-cotton weave featuring a reinforced chest pocket perfect for school crest badges or embroidery.",
      sizes: ["XS", "S", "M", "L", "XL", "XXL"],
      colors: [{ name: "Sky Blue", value: "#EFF6FF" }, { name: "White", value: "#FFFFFF" }]
    },
    {
      id: "polo-pique",
      name: "Everyday P.E. House Sports Polo",
      price: 15.00,
      oldPrice: 18.00,
      school: "generic",
      schoolName: "Essential Wear",
      category: "polo",
      rating: 4.5,
      reviewsCount: 134,
      image: "https://images.unsplash.com/photo-1581655353564-df123a1eb820?auto=format&fit=crop&q=80&w=600",
      description: "Premium ring-spun pique mesh uniform polo shirt for weekly P.E. classes. Soft, moisture-wicking and comfortable with dual-color athletic collars to represent school houses (Red, Blue, Green, Yellow).",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Navy Blue", value: "#1E3A8A" }, { name: "Bright Red", value: "#DC2626" }, { name: "Gold Yellow", value: "#F59E0B" }, { name: "Emerald Green", value: "#10B981" }]
    },
    {
      id: "skirt-tartan-st-mary",
      name: "Delhi Public School Pleated Skirt",
      price: 24.00,
      oldPrice: null,
      school: "st-marys",
      schoolName: "Delhi Public School (DPS)",
      category: "skirts",
      rating: 4.7,
      reviewsCount: 45,
      image: "https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&q=80&w=600",
      description: "Comfortable and durable box-pleated school skirt in official forest green. Made with lightweight stain-resistant polyester fabric featuring adjustable elastic waist tabs for a comfortable fit.",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Forest Green", value: "#065F46" }]
    },
    {
      id: "skirt-tartan-pinecrest",
      name: "Army Public School Steel Grey Trousers",
      price: 25.00,
      oldPrice: null,
      school: "pinecrest",
      schoolName: "Army Public School (APS)",
      category: "trousers",
      rating: 4.8,
      reviewsCount: 56,
      image: "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&q=80&w=600",
      description: "Official school trousers in disciplined steel-grey color. Tailored with heavy-duty side pockets, robust belt loops, and triple-stitched seams designed to withstand intensive active play.",
      sizes: ["S", "M", "L"],
      colors: [{ name: "Steel Grey", value: "#4B5563" }]
    },
    {
      id: "pants-chino",
      name: "Smart Regular-Fit School Pleated Shorts",
      price: 18.00,
      oldPrice: null,
      school: "generic",
      schoolName: "Essential Wear",
      category: "trousers",
      rating: 4.4,
      reviewsCount: 78,
      image: "https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?auto=format&fit=crop&q=80&w=600",
      description: "Comfortable knee-length pleated school uniform shorts. Made with breathable 100% cotton drill fabric, an adjustable elastic waistband, and side-slanted utility pockets.",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Khaki", value: "#D97706" }, { name: "Charcoal Grey", value: "#374151" }, { name: "Navy Blue", value: "#1E3A8A" }]
    },
    {
      id: "vneck-sweater",
      name: "Premium Ribbed V-Neck School Sweater",
      price: 28.00,
      oldPrice: 35.00,
      school: "generic",
      schoolName: "Essential Wear",
      category: "sweaters",
      rating: 4.7,
      reviewsCount: 112,
      image: "https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=600",
      description: "Ultra-comfortable ribbed V-neck school uniform sweater. Designed to resist pilling or color fading after numerous washes, making it ideal for layering over formal school collared shirts.",
      sizes: ["XS", "S", "M", "L", "XL"],
      colors: [{ name: "Navy Blue", value: "#1E3A8A" }, { name: "Crimson Red", value: "#991B1B" }]
    },
    {
      id: "sportswear-pe-set",
      name: "DryFit School House Gym Uniform Set",
      price: 22.00,
      oldPrice: 30.00,
      school: "generic",
      schoolName: "Official Gym Bundle",
      category: "sportswear",
      isBundle: true,
      rating: 4.6,
      reviewsCount: 104,
      image: "https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=600",
      description: "Premium House Sports athletic kit including a highly breathable moisture-wicking dry-fit House t-shirt and premium comfortable elastic shorts with standard inner drawcord.",
      sizes: ["S", "M", "L", "XL"],
      colors: [{ name: "Navy Blue House", value: "#1E3A8A" }, { name: "Bright Red House", value: "#DC2626" }]
    },
    {
      id: "ergo-backpack",
      name: "Orthopedic Ergonomic School Backpack",
      price: 32.00,
      oldPrice: null,
      school: "generic",
      schoolName: "Essential Gear",
      category: "bags",
      rating: 4.9,
      reviewsCount: 185,
      image: "https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&q=80&w=600",
      description: "Spinal-support approved ergonomic school bag. Designed with heavily padded air-mesh shoulder straps, extra chest support clips, and multiple functional layers with protective rain covers.",
      sizes: ["One Size"],
      colors: [{ name: "Tech Black", value: "#111827" }, { name: "Deep Navy", value: "#1E3A8A" }]
    },
    {
      id: "striped-tie",
      name: "Official Board-Approved School Tie",
      price: 8.00,
      oldPrice: null,
      school: "generic",
      schoolName: "Accessories",
      category: "ties",
      rating: 4.5,
      reviewsCount: 94,
      image: "https://images.unsplash.com/photo-1589756823855-edd13437c56e?auto=format&fit=crop&q=80&w=600",
      description: "Elegant school necktie featuring official board stripe colors. Handcrafted with high-density premium polyester thread, available in pre-tied zip and standard options.",
      sizes: ["Standard", "Clip-On", "Junior"],
      colors: [{ name: "Stripe Gold/Navy", value: "#B45309" }]
    }
  ]
};

// Client Storage State Controller
const State = {
  getCart() {
    return JSON.parse(localStorage.getItem('qu_cart') || '[]');
  },
  saveCart(cart) {
    localStorage.setItem('qu_cart', JSON.stringify(cart));
    this.updateHeaderCounts();
  },
  addToCart(product, quantity = 1, size = 'M', color = 'Navy') {
    const cart = this.getCart();
    const existing = cart.find(item => item.id === product.id && item.size === size && item.color === color);
    if (existing) {
      existing.quantity += quantity;
    } else {
      cart.push({
        id: product.id,
        name: product.name,
        price: product.price,
        image: product.image,
        schoolName: product.schoolName,
        size: size,
        color: color,
        quantity: quantity
      });
    }
    this.saveCart(cart);
    this.showToast(`Added "${product.name}" (${size}) to your basket!`);
  },
  removeFromCart(productId, size, color) {
    let cart = this.getCart();
    cart = cart.filter(item => !(item.id === productId && item.size === size && item.color === color));
    this.saveCart(cart);
    // Refresh page if on cart
    if (document.body.dataset.page === 'cart') {
      this.initCart();
    }
  },
  updateCartQuantity(productId, size, color, quantity) {
    const cart = this.getCart();
    const item = cart.find(item => item.id === productId && item.size === size && item.color === color);
    if (item) {
      item.quantity = Math.max(1, quantity);
      this.saveCart(cart);
      if (document.body.dataset.page === 'cart') {
        this.initCart();
      }
    }
  },
  clearCart() {
    this.saveCart([]);
  },
  
  // Wishlist Logic
  getWishlist() {
    return JSON.parse(localStorage.getItem('qu_wishlist') || '[]');
  },
  saveWishlist(wish) {
    localStorage.setItem('qu_wishlist', JSON.stringify(wish));
    this.updateHeaderCounts();
  },
  toggleWishlist(productId) {
    const wish = this.getWishlist();
    const index = wish.indexOf(productId);
    let added = false;
    if (index > -1) {
      wish.splice(index, 1);
    } else {
      wish.push(productId);
      added = true;
    }
    this.saveWishlist(wish);
    this.showToast(added ? "Added to your wishlist!" : "Removed from your wishlist!");
    
    // Refresh page if on wishlist page
    if (document.body.dataset.page === 'wishlist') {
      this.initWishlist();
    }
    return added;
  },

  // Auth Operations
  getCurrentUser() {
    return JSON.parse(localStorage.getItem('qu_user') || 'null');
  },
  saveCurrentUser(user) {
    localStorage.setItem('qu_user', JSON.stringify(user));
    this.updateHeaderCounts();
  },
  login(email, password) {
    const name = email.split('@')[0];
    const user = { name: name.charAt(0).toUpperCase() + name.slice(1), email: email };
    this.saveCurrentUser(user);
    this.showToast(`Welcome back, ${user.name}!`);
    setTimeout(() => {
      window.location.href = 'index.html';
    }, 1000);
    return true;
  },
  logout() {
    this.saveCurrentUser(null);
    this.showToast("Signed out successfully.");
    setTimeout(() => {
      window.location.reload();
    }, 1000);
  },
  register(name, email) {
    const user = { name: name, email: email };
    this.saveCurrentUser(user);
    this.showToast(`Account created! Welcome, ${name}`);
    setTimeout(() => {
      window.location.href = 'index.html';
    }, 1000);
    return true;
  },

  // Toast Generator
  showToast(message) {
    let container = document.getElementById('toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'toast-container';
      container.style.position = 'fixed';
      container.style.bottom = '24px';
      container.style.right = '24px';
      container.style.zIndex = '99999';
      container.style.display = 'flex';
      container.style.flexDirection = 'column';
      container.style.gap = '10px';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.style.background = 'var(--qu-primary)';
    toast.style.color = '#FFF';
    toast.style.padding = '12px 24px';
    toast.style.borderRadius = 'var(--qu-radius-sm)';
    toast.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
    toast.style.fontSize = '14px';
    toast.style.fontWeight = '600';
    toast.style.display = 'flex';
    toast.style.alignItems = 'center';
    toast.style.gap = '10px';
    toast.style.maxWidth = '360px';
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(20px)';
    toast.style.transition = 'all 0.3s cubic-bezier(0.16, 1, 0.3, 1)';

    toast.innerHTML = `
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
      <span>${message}</span>
    `;

    container.appendChild(toast);

    // Fade in
    setTimeout(() => {
      toast.style.opacity = '1';
      toast.style.transform = 'translateY(0)';
    }, 50);

    // Fade out and remove
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(20px)';
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  },

  // Update navbar state
  updateHeaderCounts() {
    const cartCountEl = document.getElementById('cart-badge');
    const wishlistCountEl = document.getElementById('wishlist-badge');
    const userDisplayEl = document.getElementById('header-user-display');

    if (cartCountEl) {
      const count = this.getCart().reduce((sum, item) => sum + item.quantity, 0);
      cartCountEl.innerText = count;
      cartCountEl.style.display = count > 0 ? 'flex' : 'none';
    }
    if (wishlistCountEl) {
      const count = this.getWishlist().length;
      wishlistCountEl.innerText = count;
      wishlistCountEl.style.display = count > 0 ? 'flex' : 'none';
    }
    if (userDisplayEl) {
      const user = this.getCurrentUser();
      if (user) {
        userDisplayEl.innerHTML = `
          <div style="display: flex; align-items: center; gap: 10px;">
            <span style="font-size: 13px; font-weight: 600; color: var(--qu-text-dark);">Hi, ${user.name}</span>
            <button id="logout-btn" style="background: none; border: none; color: #DC2626; font-size: 12px; padding: 0; cursor: pointer; font-weight: 600;">(Logout)</button>
          </div>
        `;
        document.getElementById('logout-btn')?.addEventListener('click', (e) => {
          e.preventDefault();
          this.logout();
        });
      } else {
        userDisplayEl.innerHTML = `
          <a href="login.html" class="action-icon-btn" title="Login / Register">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
          </a>
        `;
      }
    }
  },

  // Highlight Current Navigation Item
  highlightNav() {
    const path = window.location.pathname;
    const page = path.split("/").pop() || "index.html";
    
    document.querySelectorAll(".nav-item-link").forEach(link => {
      const href = link.getAttribute("href");
      if (href === page) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  },

  // Init Common Services across pages
  initCommon() {
    this.updateHeaderCounts();
    this.highlightNav();

    // Bind mini-search inside header
    const searchInput = document.getElementById('header-search-input');
    if (searchInput) {
      searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          const query = searchInput.value.trim();
          if (query) {
            window.location.href = `shop.html?search=${encodeURIComponent(query)}`;
          }
        }
      });
    }

    // Setup dynamic mobile drawer navigation
    this.initMobileMenu();
  },

  // Helper to dynamically set up Mobile Navigation Drawer
  initMobileMenu() {
    // 1. Check if hamburger toggle already exists in .header-actions, if not, append it
    const headerActions = document.querySelector('.header-actions');
    if (headerActions && !document.getElementById('mobile-menu-toggle-btn')) {
      const toggleBtn = document.createElement('button');
      toggleBtn.className = 'mobile-menu-toggle';
      toggleBtn.id = 'mobile-menu-toggle-btn';
      toggleBtn.setAttribute('aria-label', 'Toggle navigation menu');
      toggleBtn.innerHTML = `
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
      `;
      headerActions.appendChild(toggleBtn);
    }

    // 2. Check if drawer container already exists, if not, append to body
    let drawer = document.getElementById('mobile-menu-drawer');
    if (!drawer) {
      drawer = document.createElement('div');
      drawer.id = 'mobile-menu-drawer';
      drawer.className = 'mobile-drawer';
      drawer.innerHTML = `
        <div class="mobile-drawer-overlay" id="mobile-drawer-overlay"></div>
        <div class="mobile-drawer-content">
          <div class="mobile-drawer-header">
            <a href="index.html" class="logo">ESCHOOL<span>CART</span></a>
            <button class="mobile-drawer-close" id="mobile-drawer-close-btn" aria-label="Close menu">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
          <div class="mobile-drawer-body">
            <nav class="mobile-drawer-nav">
              <a href="index.html" class="mobile-nav-item">Home / Schools</a>
              <a href="shop.html" class="mobile-nav-item">Catalogue</a>
              <a href="about.html" class="mobile-nav-item">About Us</a>
              <a href="contact.html" class="mobile-nav-item">Contact Us</a>
              <a href="wishlist.html" class="mobile-nav-item">Saved Items</a>
              <a href="cart.html" class="mobile-nav-item">Shopping Basket</a>
            </nav>
            <div class="mobile-drawer-footer">
              <p class="small text-muted mb-0">&copy; 2026 eSchool Cart.</p>
              <p class="small text-muted" style="font-size: 11px;">Official District Partner</p>
            </div>
          </div>
        </div>
      `;
      document.body.appendChild(drawer);
    }

    // 3. Bind open/close interaction events
    const toggleBtnEl = document.getElementById('mobile-menu-toggle-btn');
    const closeBtnEl = document.getElementById('mobile-drawer-close-btn');
    const overlayEl = document.getElementById('mobile-drawer-overlay');

    const openDrawer = () => {
      drawer.classList.add('open');
      document.body.style.overflow = 'hidden';
    };

    const closeDrawer = () => {
      drawer.classList.remove('open');
      document.body.style.overflow = '';
    };

    if (toggleBtnEl) toggleBtnEl.addEventListener('click', openDrawer);
    if (closeBtnEl) closeBtnEl.addEventListener('click', closeDrawer);
    if (overlayEl) overlayEl.addEventListener('click', closeDrawer);

    // 4. Highlight the active link inside the drawer
    const path = window.location.pathname;
    const page = path.split("/").pop() || "index.html";
    drawer.querySelectorAll(".mobile-nav-item").forEach(link => {
      const href = link.getAttribute("href");
      if (href === page) {
        link.classList.add("active");
      } else {
        link.classList.remove("active");
      }
    });
  },

  // 1. HOME PAGE INITIALIZATION
  initHome() {
    // Render School Directory
    const schoolGrid = document.getElementById('school-directory-grid');
    if (schoolGrid) {
      schoolGrid.innerHTML = DB.schools.map(s => `
        <div class="col-lg-3 col-md-6">
          <div class="school-card-geo card-geo text-center" style="cursor: pointer;" onclick="window.location.href='shop.html?school=${s.id}'">
            <div style="background-color: ${s.themeColor}10; width: 64px; height: 64px; border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; border: 1px dashed ${s.themeColor};">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="${s.themeColor}" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>
            </div>
            <h4 class="h5 fw-bold mb-1">${s.name}</h4>
            <p class="text-muted small mb-3"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1" style="vertical-align: middle;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>${s.location}</p>
            <p class="text-secondary small mb-4" style="font-size: 13px; height: 60px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">${s.description}</p>
            <span class="badge-geo" style="background-color: ${s.themeColor}15; color: ${s.themeColor};">Enter Authorized Portal &rarr;</span>
          </div>
        </div>
      `).join('');
    }

    // Home school finder handler
    const finderInput = document.getElementById('home-finder-input');
    const finderBtn = document.getElementById('home-finder-btn');
    if (finderInput && finderBtn) {
      const searchAction = async () => {
        const query = finderInput.value.trim();
        if (query) {
          try {
            const response = await fetch(`/api/schools/search?q=${encodeURIComponent(query)}`);
            const schools = await response.json();

            if (schools.length > 0) {
              // Redirect to the first match
              window.location.href = `/shop?school=${schools[0].school_id}`;
            } else {
              // Redirect to general search
              window.location.href = `/shop?search=${encodeURIComponent(query)}`;
            }
          } catch (error) {
            console.error('School search error:', error);
            window.location.href = `/shop?search=${encodeURIComponent(query)}`;
          }
        } else {
          window.location.href = `/shop`;
        }
      };

      finderBtn.addEventListener('click', searchAction);
      finderInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') searchAction();
      });
    }

    // Render Featured Products
    const featuredGrid = document.getElementById('featured-products-grid');
    if (featuredGrid) {
      const featured = DB.products.slice(0, 4);
      featuredGrid.innerHTML = featured.map(p => {
        const isWish = this.getWishlist().includes(p.id);
        return `
          <div class="col-lg-3 col-md-6">
            <div class="product-card-geo">
              <button class="product-wishlist-geo ${isWish ? 'active' : ''}" onclick="State.toggleWishlist('${p.id}'); event.stopPropagation();">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="${isWish ? '#DC2626' : 'none'}" stroke="${isWish ? '#DC2626' : 'currentColor'}" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              </button>
              <div class="product-thumb-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">
                <img src="${p.image}" alt="${p.name}">
              </div>
              <div class="product-school-geo">${p.schoolName}</div>
              <h4 class="product-name-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">${p.name}</h4>
              <div class="product-price-geo">$${p.price.toFixed(2)}</div>
              <button class="btn btn-primary btn-sm mt-3 w-100" onclick="State.addToCart(${JSON.stringify(p).replace(/"/g, '&quot;')}, 1, '${p.sizes[0]}', '${p.colors[0].name}')">Add to Basket</button>
            </div>
          </div>
        `;
      }).join('');
    }

  },

  // 2. SHOP CATALOGUE INITIALIZATION
  initShop() {
    const urlParams = new URLSearchParams(window.location.search);
    const searchKeyword = urlParams.get('search') || '';
    const selectedSchool = urlParams.get('school') || 'all';
    const selectedCategory = urlParams.get('category') || 'all';
    const bundleOnly = urlParams.get('bundle') === 'true';

    // Populate Filters inputs
    const searchInput = document.getElementById('shop-search-input');
    const schoolSelect = document.getElementById('shop-school-select');
    const categorySelect = document.getElementById('shop-category-select');
    const bundleSwitch = document.getElementById('shop-bundle-switch');
    const sortSelect = document.getElementById('shop-sort-select');

    if (searchInput) searchInput.value = searchKeyword;
    if (schoolSelect) schoolSelect.value = selectedSchool;
    if (categorySelect) categorySelect.value = selectedCategory;
    if (bundleSwitch) bundleSwitch.checked = bundleOnly;

    // Filter and Render
    const renderFilteredProducts = () => {
      const q = searchInput ? searchInput.value.trim().toLowerCase() : '';
      const s = schoolSelect ? schoolSelect.value : 'all';
      const c = categorySelect ? categorySelect.value : 'all';
      const b = bundleSwitch ? bundleSwitch.checked : false;
      const sort = sortSelect ? sortSelect.value : 'relevance';

      let filtered = DB.products.filter(p => {
        const matchesQuery = p.name.toLowerCase().includes(q) || p.description.toLowerCase().includes(q);
        const matchesSchool = s === 'all' || p.school === s;
        const matchesCategory = c === 'all' || p.category === c;
        const matchesBundle = !b || p.isBundle === true;

        return matchesQuery && matchesSchool && matchesCategory && matchesBundle;
      });

      // Sort
      if (sort === 'price-low') {
        filtered.sort((a, b) => a.price - b.price);
      } else if (sort === 'price-high') {
        filtered.sort((a, b) => b.price - a.price);
      } else if (sort === 'rating') {
        filtered.sort((a, b) => b.rating - a.rating);
      }

      const grid = document.getElementById('shop-products-grid');
      const countEl = document.getElementById('shop-results-count');
      const emptyEl = document.getElementById('shop-empty-state');

      if (countEl) countEl.innerText = filtered.length;

      if (grid) {
        if (filtered.length === 0) {
          grid.innerHTML = '';
          if (emptyEl) emptyEl.style.display = 'block';
        } else {
          if (emptyEl) emptyEl.style.display = 'none';
          grid.innerHTML = filtered.map(p => {
            const isWish = this.getWishlist().includes(p.id);
            return `
              <div class="col-md-4 col-sm-6">
                <div class="product-card-geo">
                  <button class="product-wishlist-geo ${isWish ? 'active' : ''}" onclick="State.toggleWishlist('${p.id}'); event.stopPropagation();">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="${isWish ? '#DC2626' : 'none'}" stroke="${isWish ? '#DC2626' : 'currentColor'}" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                  </button>
                  <div class="product-thumb-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">
                    <img src="${p.image}" alt="${p.name}">
                  </div>
                  <div class="product-school-geo">${p.schoolName}</div>
                  <h4 class="product-name-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">${p.name}</h4>
                  <div class="product-price-geo">$${p.price.toFixed(2)}</div>
                  <button class="btn btn-primary btn-sm mt-3 w-100" onclick="State.addToCart(${JSON.stringify(p).replace(/"/g, '&quot;')}, 1, '${p.sizes[0]}', '${p.colors[0].name}')">Add to Basket</button>
                </div>
              </div>
            `;
          }).join('');
        }
      }
    };

    // Attach filter listeners
    searchInput?.addEventListener('input', renderFilteredProducts);
    schoolSelect?.addEventListener('change', renderFilteredProducts);
    categorySelect?.addEventListener('change', renderFilteredProducts);
    bundleSwitch?.addEventListener('change', renderFilteredProducts);
    sortSelect?.addEventListener('change', renderFilteredProducts);

    // Initial run
    renderFilteredProducts();
  },

  // 3. PRODUCT DETAILS PAGE
  initProductDetails() {
    const urlParams = new URLSearchParams(window.location.search);
    const pId = urlParams.get('id') || 'blazer-st-mary';
    const product = DB.products.find(p => p.id === pId) || DB.products[0];

    // Selected variables
    let selectedSize = product.sizes[0];
    let selectedColor = product.colors[0].name;

    // Render Product main details
    const mainImg = document.getElementById('details-image');
    const schoolNameEl = document.getElementById('details-school');
    const nameEl = document.getElementById('details-name');
    const priceEl = document.getElementById('details-price');
    const descEl = document.getElementById('details-description');
    const ratingEl = document.getElementById('details-rating');
    const reviewsEl = document.getElementById('details-reviews');

    if (mainImg) mainImg.src = product.image;
    if (schoolNameEl) {
      schoolNameEl.innerText = product.schoolName;
      if (product.school !== 'generic') {
        const schoolObj = DB.schools.find(s => s.id === product.school);
        if (schoolObj) {
          schoolNameEl.style.color = schoolObj.themeColor;
        }
      }
    }
    if (nameEl) nameEl.innerText = product.name;
    if (priceEl) priceEl.innerText = `$${product.price.toFixed(2)}`;
    if (descEl) descEl.innerText = product.description;
    if (ratingEl) ratingEl.innerText = product.rating.toFixed(1);
    if (reviewsEl) reviewsEl.innerText = `(${product.reviewsCount} customer reviews)`;

    // Render sizes badges
    const sizesContainer = document.getElementById('details-sizes-container');
    if (sizesContainer) {
      sizesContainer.innerHTML = product.sizes.map(size => `
        <span class="size-badge ${size === selectedSize ? 'active' : ''}" data-size="${size}">${size}</span>
      `).join('');

      sizesContainer.querySelectorAll('.size-badge').forEach(b => {
        b.addEventListener('click', () => {
          sizesContainer.querySelector('.size-badge.active')?.classList.remove('active');
          b.classList.add('active');
          selectedSize = b.dataset.size;
        });
      });
    }

    // Render colors swatches
    const colorsContainer = document.getElementById('details-colors-container');
    if (colorsContainer) {
      colorsContainer.innerHTML = product.colors.map(col => `
        <span class="color-swatch ${col.name === selectedColor ? 'active' : ''}" style="background-color: ${col.value};" data-color="${col.name}" title="${col.name}"></span>
      `).join('');

      colorsContainer.querySelectorAll('.color-swatch').forEach(s => {
        s.addEventListener('click', () => {
          colorsContainer.querySelector('.color-swatch.active')?.classList.remove('active');
          s.classList.add('active');
          selectedColor = s.dataset.color;
        });
      });
    }

    // Handle Quantity increments
    const qtyInput = document.getElementById('details-qty-input');
    const qtyMinus = document.getElementById('details-qty-minus');
    const qtyPlus = document.getElementById('details-qty-plus');

    if (qtyInput && qtyMinus && qtyPlus) {
      qtyMinus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value) || 1;
        qtyInput.value = Math.max(1, val - 1);
      });
      qtyPlus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value) || 1;
        qtyInput.value = val + 1;
      });
    }

    // Handle Add to Basket click
    const addBtn = document.getElementById('details-add-btn');
    if (addBtn) {
      addBtn.addEventListener('click', () => {
        const qty = parseInt(qtyInput ? qtyInput.value : '1') || 1;
        this.addToCart(product, qty, selectedSize, selectedColor);
      });
    }

    // Handle Add to Wishlist click
    const wishBtn = document.getElementById('details-wishlist-btn');
    if (wishBtn) {
      const updateWishBtnStyle = () => {
        const isWish = this.getWishlist().includes(product.id);
        wishBtn.innerHTML = `
          <svg width="18" height="18" viewBox="0 0 24 24" fill="${isWish ? '#DC2626' : 'none'}" stroke="${isWish ? '#DC2626' : 'currentColor'}" stroke-width="2" class="me-2" style="vertical-align: middle;"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
          <span>${isWish ? 'Saved in Wishlist' : 'Add to Wishlist'}</span>
        `;
      };
      updateWishBtnStyle();
      wishBtn.addEventListener('click', () => {
        this.toggleWishlist(product.id);
        updateWishBtnStyle();
      });
    }

    // Related Products (products from same school, or same category)
    const relatedGrid = document.getElementById('details-related-grid');
    if (relatedGrid) {
      const related = DB.products.filter(p => p.id !== product.id && (p.school === product.school || p.category === product.category)).slice(0, 4);
      relatedGrid.innerHTML = related.map(p => {
        const isWish = this.getWishlist().includes(p.id);
        return `
          <div class="col-lg-3 col-md-6">
            <div class="product-card-geo">
              <button class="product-wishlist-geo ${isWish ? 'active' : ''}" onclick="State.toggleWishlist('${p.id}'); event.stopPropagation();">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="${isWish ? '#DC2626' : 'none'}" stroke="${isWish ? '#DC2626' : 'currentColor'}" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              </button>
              <div class="product-thumb-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">
                <img src="${p.image}" alt="${p.name}">
              </div>
              <div class="product-school-geo">${p.schoolName}</div>
              <h4 class="product-name-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">${p.name}</h4>
              <div class="product-price-geo">$${p.price.toFixed(2)}</div>
              <button class="btn btn-primary btn-sm mt-3 w-100" onclick="State.addToCart(${JSON.stringify(p).replace(/"/g, '&quot;')}, 1, '${p.sizes[0]}', '${p.colors[0].name}')">Add to Basket</button>
            </div>
          </div>
        `;
      }).join('');
    }
  },

  // 4. CART PAGE INITIALIZATION
  initCart() {
    const cart = this.getCart();
    const tableBody = document.getElementById('cart-table-body');
    const mobileList = document.getElementById('cart-mobile-list');
    const emptyState = document.getElementById('cart-empty-state');
    const fullState = document.getElementById('cart-full-state');

    if (cart.length === 0) {
      if (emptyState) emptyState.style.display = 'block';
      if (fullState) fullState.style.display = 'none';
    } else {
      if (emptyState) emptyState.style.display = 'none';
      if (fullState) fullState.style.display = 'flex';

      // 1. Render Desktop Table Body
      if (tableBody) {
        tableBody.innerHTML = cart.map((item) => {
          const itemTotal = item.price * item.quantity;
          return `
            <tr>
              <td>
                <div class="d-flex align-items-center gap-3">
                  <img src="${item.image}" alt="${item.name}" style="width: 54px; height: 54px; border-radius: var(--qu-radius-sm); object-fit: cover; background: #F3F4F6; border: 1px solid var(--qu-border-color);">
                  <div>
                    <h5 class="mb-0.5 text-dark" style="font-size: 14px; font-weight: 700;">${item.name}</h5>
                    <div class="text-secondary" style="font-size: 11px;">
                      <span class="badge bg-secondary-subtle text-dark me-2 border" style="font-size: 9px; font-weight: 600;">${item.schoolName}</span>
                      <span>Size: <strong class="text-dark">${item.size}</strong></span> | 
                      <span>Color: <strong class="text-dark">${item.color}</strong></span>
                    </div>
                  </div>
                </div>
              </td>
              <td class="text-dark" style="font-size: 14px; font-weight: 500;">$${item.price.toFixed(2)}</td>
              <td>
                <div class="d-flex align-items-center" style="max-width: 110px;">
                  <button class="btn btn-outline-secondary btn-sm p-1 px-2.5 fw-bold" onclick="State.updateCartQuantity('${item.id}', '${item.size}', '${item.color}', ${item.quantity - 1})">-</button>
                  <input type="text" class="form-control form-control-sm text-center mx-1.5 p-1 text-dark" value="${item.quantity}" readonly style="width: 36px; font-weight: 700; font-size: 13px; background: transparent; border: none;">
                  <button class="btn btn-outline-secondary btn-sm p-1 px-2.5 fw-bold" onclick="State.updateCartQuantity('${item.id}', '${item.size}', '${item.color}', ${item.quantity + 1})">+</button>
                </div>
              </td>
              <td class="fw-bold text-dark" style="font-size: 14px;">$${itemTotal.toFixed(2)}</td>
              <td>
                <button class="btn btn-link text-danger p-1" onclick="State.removeFromCart('${item.id}', '${item.size}', '${item.color}')" title="Remove item">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
              </td>
            </tr>
          `;
        }).join('');
      }

      // 2. Render Mobile Cards List
      if (mobileList) {
        mobileList.innerHTML = cart.map((item) => {
          const itemTotal = item.price * item.quantity;
          return `
            <div class="card-geo p-3 d-flex flex-column gap-3" style="border-left: 4px solid var(--qu-primary);">
              <div class="d-flex gap-3 align-items-start">
                <img src="${item.image}" alt="${item.name}" style="width: 64px; height: 64px; border-radius: var(--qu-radius-sm); object-fit: cover; background: #F3F4F6; flex-shrink: 0; border: 1px solid var(--qu-border-color);">
                <div class="flex-grow-1">
                  <span class="badge bg-secondary-subtle text-dark border mb-1" style="font-size: 9px; font-weight: 600;">${item.schoolName}</span>
                  <h5 class="mb-1 text-dark" style="font-size: 13px; font-weight: 700; line-height: 1.3;">${item.name}</h5>
                  <div class="d-flex flex-wrap gap-2 text-secondary" style="font-size: 11px;">
                    <span>Size: <strong class="text-dark">${item.size}</strong></span>
                    <span>|</span>
                    <span>Color: <strong class="text-dark">${item.color}</strong></span>
                  </div>
                </div>
                <button class="btn btn-link text-danger p-0 ms-auto" onclick="State.removeFromCart('${item.id}', '${item.size}', '${item.color}')" title="Remove item">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                </button>
              </div>
              <div class="d-flex justify-content-between align-items-center pt-2.5 border-top" style="border-top-style: dashed !important; border-top-color: var(--qu-border-color) !important;">
                <div class="d-flex align-items-center">
                  <span class="text-secondary small me-2" style="font-size: 11px;">Qty:</span>
                  <div class="d-flex align-items-center border rounded bg-white p-0.5">
                    <button class="btn btn-link text-dark p-0 px-2.5 text-decoration-none fw-bold" style="font-size: 14px;" onclick="State.updateCartQuantity('${item.id}', '${item.size}', '${item.color}', ${item.quantity - 1})">-</button>
                    <span class="px-1.5 fw-bold text-dark" style="font-size: 12px; min-width: 20px; text-align: center;">${item.quantity}</span>
                    <button class="btn btn-link text-dark p-0 px-2.5 text-decoration-none fw-bold" style="font-size: 14px;" onclick="State.updateCartQuantity('${item.id}', '${item.size}', '${item.color}', ${item.quantity + 1})">+</button>
                  </div>
                </div>
                <div class="text-end">
                  <span class="text-secondary small d-block" style="font-size: 10px;">$${item.price.toFixed(2)} each</span>
                  <span class="fw-bold text-dark" style="font-size: 13px;">$${itemTotal.toFixed(2)}</span>
                </div>
              </div>
            </div>
          `;
        }).join('');
      }

      // Initialize State if not already initialized
      if (!this.cartState) {
        this.cartState = {
          delivery: 'school',
          addonWrap: false,
          addonLabels: false,
          promoCode: null,
          discountPercentage: 0
        };
      }

      // Get interactive elements
      const delivSchoolRadio = document.getElementById('deliv-school');
      const delivHomeRadio = document.getElementById('deliv-home');
      const addonWrapCheck = document.getElementById('addon-wrap');
      const addonLabelsCheck = document.getElementById('addon-labels');
      const promoInput = document.getElementById('promo-input');
      const promoBtn = document.getElementById('promo-apply-btn');

      // Bind Radio triggers
      if (delivSchoolRadio && delivHomeRadio) {
        // Set initial checked state
        delivSchoolRadio.checked = this.cartState.delivery === 'school';
        delivHomeRadio.checked = this.cartState.delivery === 'home';

        const updateDeliveryVisuals = () => {
          const schoolContainer = document.getElementById('deliv-school-container');
          const homeContainer = document.getElementById('deliv-home-container');
          if (this.cartState.delivery === 'school') {
            if (schoolContainer) {
              schoolContainer.style.border = '2px solid var(--qu-primary)';
              schoolContainer.style.backgroundColor = 'rgba(30, 58, 138, 0.03)';
            }
            if (homeContainer) {
              homeContainer.style.border = '1px solid var(--qu-border-color)';
              homeContainer.style.backgroundColor = 'transparent';
            }
          } else {
            if (schoolContainer) {
              schoolContainer.style.border = '1px solid var(--qu-border-color)';
              schoolContainer.style.backgroundColor = 'transparent';
            }
            if (homeContainer) {
              homeContainer.style.border = '2px solid var(--qu-primary)';
              homeContainer.style.backgroundColor = 'rgba(30, 58, 138, 0.03)';
            }
          }
        };

        const handleRadioChange = (val) => {
          this.cartState.delivery = val;
          updateDeliveryVisuals();
          this.recalculateTotals();
        };

        delivSchoolRadio.addEventListener('change', () => handleRadioChange('school'));
        delivHomeRadio.addEventListener('change', () => handleRadioChange('home'));
        
        // Make entire containers clickable
        document.getElementById('deliv-school-container')?.addEventListener('click', (e) => {
          if (e.target !== delivSchoolRadio) {
            delivSchoolRadio.checked = true;
            handleRadioChange('school');
          }
        });
        document.getElementById('deliv-home-container')?.addEventListener('click', (e) => {
          if (e.target !== delivHomeRadio) {
            delivHomeRadio.checked = true;
            handleRadioChange('home');
          }
        });

        updateDeliveryVisuals();
      }

      // Bind Checkboxes triggers
      if (addonWrapCheck && addonLabelsCheck) {
        addonWrapCheck.checked = this.cartState.addonWrap;
        addonLabelsCheck.checked = this.cartState.addonLabels;

        addonWrapCheck.addEventListener('change', () => {
          this.cartState.addonWrap = addonWrapCheck.checked;
          this.recalculateTotals();
        });

        addonLabelsCheck.addEventListener('change', () => {
          this.cartState.addonLabels = addonLabelsCheck.checked;
          this.recalculateTotals();
        });
      }

      // Bind Promo Code
      if (promoInput && promoBtn) {
        if (this.cartState.promoCode) {
          promoInput.value = this.cartState.promoCode;
          this.showPromoMessage(true, `Coupon "${this.cartState.promoCode}" applied! (15% Off)`);
        }

        const handlePromoApply = () => {
          const code = promoInput.value.trim().toUpperCase();
          if (!code) {
            this.showPromoMessage(false, "Please enter a coupon code.");
            return;
          }

          if (code === "STUDENT15" || code === "BACKTOSCHOOL") {
            this.cartState.promoCode = code;
            this.cartState.discountPercentage = 0.15;
            this.showPromoMessage(true, `Coupon "${code}" successfully applied! 15% discount has been deducted.`);
            this.showToast(`Coupon "${code}" applied: 15% discount!`);
            this.recalculateTotals();
          } else {
            this.showPromoMessage(false, `Invalid coupon code "${code}". Try "STUDENT15".`);
          }
        };

        promoBtn.addEventListener('click', handlePromoApply);
        promoInput.addEventListener('keypress', (e) => {
          if (e.key === 'Enter') {
            e.preventDefault();
            handlePromoApply();
          }
        });
      }

      // Initial recalculate
      this.recalculateTotals();
    }
  },

  showPromoMessage(success, msg) {
    const el = document.getElementById('promo-message');
    if (el) {
      el.style.display = 'block';
      el.innerText = msg;
      if (success) {
        el.className = 'small mt-2 p-2 rounded fw-medium text-center text-success bg-success-subtle border border-success-subtle';
      } else {
        el.className = 'small mt-2 p-2 rounded fw-medium text-center text-danger bg-danger-subtle border border-danger-subtle';
      }
    }
  },

  recalculateTotals() {
    const cart = this.getCart();
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const subtotalEl = document.getElementById('cart-subtotal');
    if (subtotalEl) subtotalEl.innerText = `$${subtotal.toFixed(2)}`;

    // Update Free Delivery Progress Bar (Threshold: $100)
    const deliveryMeterCard = document.getElementById('delivery-meter-card');
    if (deliveryMeterCard) {
      const neededThreshold = 100.00;
      const percent = Math.min(100, (subtotal / neededThreshold) * 100);
      
      const progressBar = document.getElementById('delivery-progress-bar');
      const percentText = document.getElementById('delivery-percent-text');
      const statusMessage = document.getElementById('delivery-status-message');

      if (progressBar) progressBar.style.width = `${percent}%`;
      if (percentText) percentText.innerText = `${percent.toFixed(0)}%`;

      if (subtotal >= neededThreshold) {
        if (statusMessage) {
          statusMessage.innerHTML = `🎉 <strong>Congratulations!</strong> You have unlocked <strong>FREE Standard Courier Home Delivery</strong>!`;
        }
        const homeBadge = document.getElementById('home-delivery-fee-badge');
        if (homeBadge) {
          homeBadge.innerText = 'FREE';
          homeBadge.className = 'text-success fw-bold small';
        }
      } else {
        const remaining = neededThreshold - subtotal;
        if (statusMessage) {
          statusMessage.innerHTML = `Add <strong class="text-primary">$${remaining.toFixed(2)}</strong> more for <strong>FREE Home Delivery</strong>!`;
        }
        const homeBadge = document.getElementById('home-delivery-fee-badge');
        if (homeBadge) {
          homeBadge.innerText = '$8.00';
          homeBadge.className = 'text-dark fw-bold small';
        }
      }
    }

    // Compute active variables
    const deliveryMode = this.cartState ? this.cartState.delivery : 'school';
    const isHomeFree = subtotal >= 100.00;
    const deliveryFee = deliveryMode === 'school' ? 0 : (isHomeFree ? 0 : 8.00);

    const isWrapChecked = this.cartState ? this.cartState.addonWrap : false;
    const isLabelsChecked = this.cartState ? this.cartState.addonLabels : false;
    const addonsFee = (isWrapChecked ? 5.00 : 0) + (isLabelsChecked ? 3.50 : 0);

    const discountPercentage = this.cartState ? this.cartState.discountPercentage : 0;
    const discountAmount = subtotal * discountPercentage;

    const estimatedTotal = Math.max(0, subtotal + deliveryFee + addonsFee - discountAmount);

    // Update UI Calculation fields
    const deliveryEl = document.getElementById('cart-delivery');
    if (deliveryEl) {
      if (deliveryFee === 0) {
        deliveryEl.innerText = 'FREE';
        deliveryEl.className = 'fw-bold text-success';
      } else {
        deliveryEl.innerText = `$${deliveryFee.toFixed(2)}`;
        deliveryEl.className = 'fw-bold text-dark';
      }
    }

    const addonsRow = document.getElementById('addons-breakdown-row');
    const addonsEl = document.getElementById('cart-addons');
    if (addonsRow && addonsEl) {
      if (addonsFee > 0) {
        addonsRow.classList.remove('d-none');
        addonsEl.innerText = `+$${addonsFee.toFixed(2)}`;
      } else {
        addonsRow.classList.add('d-none');
      }
    }

    const discountRow = document.getElementById('discount-breakdown-row');
    const discountEl = document.getElementById('cart-discount');
    if (discountRow && discountEl) {
      if (discountAmount > 0) {
        discountRow.classList.remove('d-none');
        discountEl.innerText = `-$${discountAmount.toFixed(2)}`;
      } else {
        discountRow.classList.add('d-none');
      }
    }

    const totalEl = document.getElementById('cart-total');
    if (totalEl) {
      totalEl.innerText = `$${estimatedTotal.toFixed(2)}`;
    }
  },

  // 5. CHECKOUT PAGE INITIALIZATION
  initCheckout() {
    const cart = this.getCart();
    
    // If cart is empty, redirect to cart.html
    if (cart.length === 0) {
      window.location.href = 'cart.html';
      return;
    }

    const checkoutSummary = document.getElementById('checkout-items-summary');
    const checkoutTotal = document.getElementById('checkout-final-total');

    if (checkoutSummary) {
      checkoutSummary.innerHTML = cart.map(item => `
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <h6 class="mb-0" style="font-weight: 700; font-size: 14px;">${item.name} <span class="text-muted">x${item.quantity}</span></h6>
            <span class="text-muted small">Size: ${item.size} | Color: ${item.color}</span>
          </div>
          <span class="fw-semibold text-dark">$${(item.price * item.quantity).toFixed(2)}</span>
        </div>
      `).join('');
    }

    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    if (checkoutTotal) checkoutTotal.innerText = `$${subtotal.toFixed(2)}`;

    // Handle Form checkout submission
    const form = document.getElementById('checkout-form');
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // Form details
        const email = document.getElementById('chk-email')?.value || '';
        const name = document.getElementById('chk-name')?.value || '';
        
        // Simulate order success
        const orderId = 'QU-' + Math.floor(100000 + Math.random() * 900000);
        
        // Clear Cart
        this.clearCart();
        
        // Redirect to Order Success
        window.location.href = `order-success.html?orderId=${orderId}&name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&total=${subtotal.toFixed(2)}`;
      });
    }
  },

  // 6. WISHLIST PAGE INITIALIZATION
  initWishlist() {
    const wishlistIds = this.getWishlist();
    const grid = document.getElementById('wishlist-grid');
    const emptyState = document.getElementById('wishlist-empty-state');

    // Filter DB products belonging to wishlist
    const wishlistItems = DB.products.filter(p => wishlistIds.includes(p.id));

    if (wishlistItems.length === 0) {
      if (grid) grid.innerHTML = '';
      if (emptyState) emptyState.style.display = 'block';
    } else {
      if (emptyState) emptyState.style.display = 'none';
      if (grid) {
        grid.innerHTML = wishlistItems.map(p => `
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="product-card-geo">
              <button class="product-wishlist-geo active" onclick="State.toggleWishlist('${p.id}'); event.stopPropagation();">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="#DC2626" stroke="#DC2626" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
              </button>
              <div class="product-thumb-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">
                <img src="${p.image}" alt="${p.name}">
              </div>
              <div class="product-school-geo">${p.schoolName}</div>
              <h4 class="product-name-geo" style="cursor: pointer;" onclick="window.location.href='product-details.html?id=${p.id}'">${p.name}</h4>
              <div class="product-price-geo">$${p.price.toFixed(2)}</div>
              <button class="btn btn-primary btn-sm mt-3 w-100" onclick="State.addToCart(${JSON.stringify(p).replace(/"/g, '&quot;')}, 1, '${p.sizes[0]}', '${p.colors[0].name}')">Add to Basket</button>
            </div>
          </div>
        `).join('');
      }
    }
  },

  // 7. ORDER SUCCESS PAGE
  initOrderSuccess() {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('orderId') || 'QU-982341';
    const name = urlParams.get('name') || 'Customer';
    const email = urlParams.get('email') || 'your-email@example.com';
    const total = urlParams.get('total') || '0.00';

    const orderIdEl = document.getElementById('success-order-id');
    const customerNameEl = document.getElementById('success-customer-name');
    const emailEl = document.getElementById('success-email');
    const totalEl = document.getElementById('success-total');

    if (orderIdEl) orderIdEl.innerText = orderId;
    if (customerNameEl) customerNameEl.innerText = name;
    if (emailEl) emailEl.innerText = email;
    if (totalEl) totalEl.innerText = `$${total}`;
  },

  // 8. AUTH PAGE SIMULATIONS
  initAuthPage() {
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
      loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('login-email')?.value || '';
        const pass = document.getElementById('login-password')?.value || '';
        if (email && pass) {
          this.login(email, pass);
        }
      });
    }

    const registerForm = document.getElementById('register-form');
    if (registerForm) {
      registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('reg-name')?.value || '';
        const email = document.getElementById('reg-email')?.value || '';
        const pass = document.getElementById('reg-password')?.value || '';
        if (name && email && pass) {
          this.register(name, email);
        }
      });
    }

    const forgotForm = document.getElementById('forgot-form');
    if (forgotForm) {
      forgotForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const email = document.getElementById('forgot-email')?.value || '';
        if (email) {
          this.showToast(`Password recovery instructions sent to ${email}`);
          forgotForm.reset();
        }
      });
    }
  },

  // 9. CONTACT FORM
  initContact() {
    const form = document.getElementById('contact-form-message');
    if (form) {
      form.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = document.getElementById('contact-name')?.value || '';
        this.showToast(`Thank you, ${name}! Your inquiry has been sent successfully.`);
        form.reset();
      });
    }
  }
};

// Auto run common elements and page loaders
document.addEventListener('DOMContentLoaded', () => {
  State.initCommon();
  
  const page = document.body.dataset.page;
  if (page === 'home') {
    State.initHome();
  } else if (page === 'shop') {
    State.initShop();
  } else if (page === 'product-details') {
    State.initProductDetails();
  } else if (page === 'cart') {
    State.initCart();
  } else if (page === 'checkout') {
    State.initCheckout();
  } else if (page === 'wishlist') {
    State.initWishlist();
  } else if (page === 'auth') {
    State.initAuthPage();
  } else if (page === 'contact') {
    State.initContact();
  }
});

// Expose state globally so inline click handlers in cards can trigger actions
window.State = State;



