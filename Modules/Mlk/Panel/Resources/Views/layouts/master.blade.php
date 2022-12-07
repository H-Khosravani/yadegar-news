<!DOCTYPE html>
<html lang="en">
    <head>

        @include('Panel::section.meta')

        <title>@yield('title') | {{ config('app.name') }}</title>
        
        @include('Panel::section.css')

    </head>

    <body>
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Topbar Start -->
            @include('Panel::section.navbar')
            <!-- end Topbar -->
            @include('Panel::section.sidebar')
            <!-- Left Sidebar End -->
            <div class="content-page">
                <div class="content">
                    @yield('content')
                </div> <!-- content -->
                <!-- Footer Start -->
                @include('Panel::section.footer')
                <!-- end Footer -->
            </div>
        </div>
        <div class="rightbar-overlay"></div>
        @include('Panel::section.js')
        @include('sweetalert::alert')
    </body>
</html>