<aside class="app-sidebar sticky" id="sidebar"> 
    <div class="main-sidebar-header"> 
        <a href="{{ route('dashboard') }}" class="header-logo"> 
            <img src="{{ asset('assets/images/logo.svg') }}" class="logo-fixed" alt="logo"> 
        </a> 
    </div>

    <style>
        .header-logo {
            display: flex !important;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            padding: 15px 10px;
            width: 100%;
        }

        .logo-fixed {
            display: block !important;
            max-height: 40px;
            width: auto;
            max-width: 80%;
            object-fit: contain;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
            visibility: visible !important;
            opacity: 1 !important;
            /* White background effect */
            background-color: #ffffff;
          /* //  padding: 5px 12px; */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header-logo:hover .logo-fixed {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 8px rgba(0,0,0,0.2)) brightness(1.1);
        }

        @media (max-width: 991.98px) {
            .main-sidebar-header {
                padding: 10px;
            }
            .logo-fixed {
                max-height: 30px !important;
                padding: 4px 10px;
            }
        }
    </style>
    <!-- End::main-sidebar-header --> <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: -14.4px 0px -80px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer">
                    
                </div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
                        style="height: 100%; overflow: hidden scroll;">
                        <div class="simplebar-content" style="padding: 14.4px 0px 80px;"> <!-- Start::nav -->
                            <nav class="main-menu-container nav nav-pills flex-column sub-open active">
                                <div class="slide-left active d-none" id="slide-left"> <svg
                                        xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z">
                                        </path>
                                    </svg> </div>
                                <ul class="main-menu active" style="margin-left: 0px; margin-right: 0px;">
                                    @if(auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin'))
                                        @include('layouts.navigation.admin')
                                    @elseif(auth()->user()->hasRole('vendor'))
                                        @include('layouts.navigation.vendor')
                                    @elseif(auth()->user()->hasRole('school'))
                                        @include('layouts.navigation.school')
                                    @endif
                                </ul>
                                <div class="slide-right d-none" id="slide-right"><svg
                                        xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path
                                            d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z">
                                        </path>
                                    </svg></div>
                            </nav> <!-- End::nav -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 969px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar"
                style="width: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
            <div class="simplebar-scrollbar"
                style="height: 239px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
        </div>
    </div> <!-- End::main-sidebar -->
</aside>
