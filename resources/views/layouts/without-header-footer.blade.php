<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kwality Uniform - Software</title>

    {{-- links for the css --}}

    
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler-icons.min.css') }}">
   
</head>

<body>

    {{-- content section start here --}}
    @yield('content')
    {{-- content section end here --}}

    {{-- links for the js --}}
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/sticky.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

    const togglePassword =
        document.getElementById('togglePassword');

    const passwordInput =
        document.getElementById('password');

    togglePassword.addEventListener('click', function () {

        const icon =
            this.querySelector('i');

        if (passwordInput.type === 'password') {

            passwordInput.type = 'text';

            icon.classList.remove('ti-eye');
            icon.classList.add('ti-eye-off');

        } else {

            passwordInput.type = 'password';

            icon.classList.remove('ti-eye-off');
            icon.classList.add('ti-eye');
        }

    });

});
    </script>
</body>

</html>
