  <footer class="footer-geo">
      <div class="container footer-inner">
        <div>
          <span style="font-family: var(--font-display); font-weight: 800; color: var(--qu-primary);">
              {{ \App\Models\GlobalSetting::get('website_name', 'ESCHOOL') }}
          </span><span style="font-family: var(--font-display); font-weight: 300;">
              {{ \App\Models\GlobalSetting::get('website_name_suffix', 'CART') }}
          </span>
          <p class="mb-0 mt-1" style="font-size: 11px; color: #9CA3AF;">
              {{ \App\Models\GlobalSetting::get('footer_copyright', '&copy; 2026 eSchool Cart Inc. All institutional designs are property of official regional school boards.') }}
          </p>
        </div>
        <div class="footer-links-geo">
          <a href="about.html">About Us</a>
          <a href="shop.html">Catalogue</a>
          <a href="contact.html">Contact Us</a>
          <a href="wishlist.html">Wishlist</a>
          <a href="#become-partner-section" onclick="switchOnboardingTab('school')">Become Partner</a>
          <a href="#become-partner-section" onclick="switchOnboardingTab('vendor')">Become Vendor</a>
        </div>
      </div>
    </footer>