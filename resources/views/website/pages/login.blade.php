@extends('website.components.common')


@section('content')
    <!-- Tab Controller Script -->
    <script>
        function switchAuthTab(tabName) {
            const loginBtn = document.getElementById('btn-login-tab');
            const registerBtn = document.getElementById('btn-register-tab');
            const loginPane = document.getElementById('pane-login');
            const registerPane = document.getElementById('pane-register');

            if (!loginBtn || !registerBtn || !loginPane || !registerPane) return;

            if (tabName === 'register') {
                loginBtn.classList.remove('active');
                registerBtn.classList.add('active');
                loginPane.classList.remove('active');
                registerPane.classList.add('active');

                // Sync url hash
                if (history.pushState) {
                    history.pushState(null, null, '#register');
                } else {
                    window.location.hash = 'register';
                }
            } else {
                registerBtn.classList.remove('active');
                loginBtn.classList.add('active');
                registerPane.classList.remove('active');
                loginPane.classList.add('active');

                // Sync url hash
                if (history.pushState) {
                    history.pushState(null, null, '#login');
                } else {
                    window.location.hash = 'login';
                }
            }
        }

        // Check initial hash on load
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash;
            if (hash === '#register') {
                switchAuthTab('register');
            } else {
                switchAuthTab('login');
            }
        });
    </script>
@endsection
