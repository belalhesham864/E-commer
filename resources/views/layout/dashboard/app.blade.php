<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('layout.dashboard._head')
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
@include('layout.dashboard._navbar')
  <!-- ////////////////////////////////////////////////////////////////////////////-->
 @include('layout.dashboard._sidebaar')
 {{-- Main Content --}}


 @yield('body')
 
@include('layout.dashboard._footer')
 @include('layout.dashboard._scripts')
</body>
</html>