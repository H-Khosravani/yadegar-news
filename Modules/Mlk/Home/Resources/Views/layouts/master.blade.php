<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    
    @include('Home::section.meta')
    <title>@yield('title') | {{config('app.name') /*.env APP_NAME*/ }}</title>
    @include('Home::section.css')

</head>

<body>
    {{-- Preloader --}}
    @include('Home::section.preloader')
    <div class="main-wrap">
        @include('Home::section.sidebar')

        <!-- Main Header -->
        @include('Home::section.header')

        <!-- Main Wrap Start -->
        @yield('content')
        <!-- Footer Start-->
        @include('Home::section.footer')

    </div> <!-- Main Wrap End-->
    <div class="dark-mark"></div>
    <!-- Vendor JS-->
    @include('Home::section.js')
    @include('sweetalert::alert')
</body>
</html>
