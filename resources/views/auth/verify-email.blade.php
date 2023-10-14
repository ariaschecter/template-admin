<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    @include('admin.partials.title')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/css/rt-plugins.css') }}">
    <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
        integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
    <link rel="stylesheet" href="{{ asset('backend/css/app.css') }}">
    <!-- START : Theme Config js-->
    <script src="{{ asset('backend/js/settings.js') }}" sync></script>
    <!-- END : Theme Config js-->
</head>

<body class=" font-inter skin-default">
    <!-- [if IE]> <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p> <![endif] -->

    <div class="loginwrapper">
        <div class="lg-inner-column">
            @include('auth.partials.section-left')
            <div class="right-column  relative">
                <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                    <div class="auth-box h-full flex flex-col justify-center">
                        @include('auth.partials.mobile-logo')
                        <div class="text-center mb-4">
                            <h4 class="font-medium">Verify Email</h4>
                            <div class="text-slate-500 text-base">
                                Thanks for signing up! Before getting started, could you verify your email address by
                                clicking on the link we just emailed to you? If you didn\'t receive the email, we will
                                gladly send you another.
                            </div>
                        </div>
                        <!-- BEGIN: Login Form -->
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif
                        <div class="text-center 2xl:mb-10 mb-4 flex justify-center">
                        <form  class="mr-2" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="btn btn-dark block w-full text-center">Resend Verification Email</button>
                        </form>
                        <form class="mr-2" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-secondary block w-full text-center">Logout</button>
                        </form>
                        </div>
                    </div>
                    @include('auth.partials.footer')
                </div>
            </div>
        </div>
    </div>

    <!-- scripts -->
    <script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('backend/js/app.js') }}"></script>
</body>

</html>
