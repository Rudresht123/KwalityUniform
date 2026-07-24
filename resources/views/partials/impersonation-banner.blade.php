@if(session()->has('admin_user_id'))
    <style>
        body {
            padding-top: 64px !important;
        }

        .impersonation-banner {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            background: linear-gradient(90deg, #f59e0b, #d97706);
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, .15);
        }

        .impersonation-banner .banner-content {
            max-width: 1400px;
            margin: auto;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .impersonation-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .impersonation-info i {
            font-size: 22px;
        }

        .stop-impersonation-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #fff;
            color: #d97706;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: .25s;
        }

        .stop-impersonation-btn:hover {
            background: #f8f9fa;
            color: #b45309;
            transform: translateY(-1px);
        }
    </style>

    <div class="impersonation-banner">
        <div class="banner-content">
            <div class="impersonation-info">
                <i class="ti ti-user-shield"></i>

                <div>
                    <strong>Impersonation Mode</strong><br>
                    <small>
                        You are currently signed in as
                        <strong>{{ Auth::user()->name }}</strong>
                    </small>
                </div>
            </div>

            <a href="{{ route('impersonate.stop') }}" class="stop-impersonation-btn">
                <i class="ti ti-arrow-back-up"></i>
                Exit Impersonation
            </a>
        </div>
    </div>
@endif