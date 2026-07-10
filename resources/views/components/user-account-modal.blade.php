<!-- User Account Modal -->
@if(Auth()->user())
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content account-modal-content">
            <div class="modal-header border-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pt-0">
                <div class="user-profile-header mb-4">
                    <div class="user-avatar-circle">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                    <p class="text-muted small">{{ Auth::user()->email }}</p>
                </div>
                
                <div class="account-nav-list">
                    <a href="{{ route('website.orders.index') }}" class="account-nav-item">
                        <i class="ti-package"></i>
                        <span>My Orders</span>
                            <i class="ti ti-chevron-right ms-auto"></i>
                    </a>
                    <a href="{{ route('website.wishlist.index') }}" class="account-nav-item">
                        <i class="ti-heart"></i>
                        <span>My Wishlist</span>
                        <i class="ti ti-chevron-right ms-auto"></i>
                    </a>
                    <a href="{{ route('website.recently-viewed') }}" class="account-nav-item">
                        <i class="ti ti-history"></i>
                        <span>Recently Viewed</span>
                            <i class="ti ti-chevron-right ms-auto"></i>
                    </a>
                    <hr class="my-3">
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="account-nav-item btn-logout w-100 text-start border-0 bg-transparent">
                            <i class="ti ti-logout"></i>
                            <span>Logout</span>
                            <i class="ti ti-chevron-right ms-auto"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<style>
.account-modal-content {
    border-radius: 20px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.user-profile-header {
    padding: 20px 0;
}
.user-avatar-circle {
    width: 64px;
    height: 64px;
    background: #1E3A8A;
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 800;
    margin: 0 auto 12px;
}
.account-nav-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
.account-nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 12px;
    color: #4B5563;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}
.account-nav-item:hover {
    background: #F3F4F6;
    color: #1E3A8A;
    border-color: #E5E7EB;
}
.account-nav-item i:first-child {
    font-size: 18px;
    width: 24px;
    text-align: center;
}
.btn-logout {
    cursor: pointer;
    color: #DC2626;
}
.btn-logout:hover {
    background: #FEF2F2;
    color: #B91C1C;
}
</style>
