<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

@include('admin.partials.css')

<body class=" font-inter dashcode-app" id="body_class">
    <!-- [if IE]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif] -->
    <main class="app-wrapper">
        <!-- BEGIN: Sidebar -->
        @include('admin.partials.sidebar')
        <!-- End: Sidebar -->
        <!-- BEGIN: Settings -->

        <!-- BEGIN: Settings -->
        @include('admin.partials.settings')
        <!-- END: Settings -->

        <!-- End: Settings -->
        <div class="flex flex-col justify-between min-h-screen">
            <div>
                <!-- BEGIN: Header -->
                @include('admin.partials.header')
                <!-- END: Header -->
                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]"
                    id="content_wrapper">
                    <div class="page-content">
                        <div class="transition-all duration-150 container-fluid" id="page_layout">
                            <div id="content_layout">
                                @yield('main')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BEGIN: Footer For Desktop and tab -->
            @include('admin.partials.footer')
            <!-- END: Footer For Desktop and tab -->
            @include('admin.partials.footer_mobile')
        </div>
    </main>
    <!-- scripts -->
    @stack('js')
    @include('admin.partials.javascript')
</body>

</html>
