  <footer class="footer-geo">
      <div class="container footer-inner">
          <div>
              <span style="font-family: var(--font-display); font-weight: 800; color: var(--qu-primary);">
                  {{ \App\Models\GlobalSetting::get('website_name', 'ESCHOOL') }}
              </span><span style="font-family: var(--font-display); font-weight: 300;">
                  {{ \App\Models\GlobalSetting::get('website_name_suffix', 'CART') }}
              </span>
              <p class="mb-0 mt-1" style="font-size: 11px; color: #9CA3AF;">
                 
                      © 2026 eSchoolKart. All rights reserved. <br/>
                  eSchoolKart is a trade name of A2M TRADERS, GSTIN: 09BXGPG1377Q1ZU. 
                 <br/> Registered Office: NIYADER GANJ, DADRI, G.B.NAGAR, UTTAR PRADESH',
                
              </p>
          </div>
          <div class="footer-links-geo">
              <a href="{{ route('website.about') }}">About Us</a>
              <a href="{{ route('website.shop') }}">Catalogue</a>
              <a href="{{ route('website.contact') }}">Contact Us</a>
              @auth
                  <a href="{{ route('website.wishlist.index') }}">Wishlist</a>
              @endauth
              <a href="{{ route('website.terms') }}">Terms & Conditions</a>
              <a href="{{ route('website.privacy') }}">Privacy Policy</a>
              <a href="{{ route('website.returns') }}">Return Policy</a>

              {{-- <a href="#become-partner-section" onclick="switchOnboardingTab('school')">Become Partner</a>
          <a href="#become-partner-section" onclick="switchOnboardingTab('vendor')">Become Vendor</a> --}}
          </div>
      </div>
  </footer>
