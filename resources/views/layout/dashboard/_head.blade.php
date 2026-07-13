<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
  <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
  <meta name="author" content="PIXINVENT">
  <title>{{__('auth.dashboard')}} | @yield('title')</title>
  <link rel="apple-touch-icon" href="{{ asset('asset/dashboard') }}/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('asset/dashboard') }}/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/vendors/css/weather-icons/climacons.min.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/fonts/meteocons/style.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/vendors/css/charts/morris.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/fonts/simple-line-icons/style.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/vendors/css/charts/chartist-plugin-tooltip.css">
  
  @if (Config::get('app.locale')== 'ar')
   <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/vendors.css">

  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/app.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/custom-rtl.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/pages/timeline.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css-rtl/pages/dashboard-ecommerce.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style-rtl.css">
      @else
 <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/vendors.css">

  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/app.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/custom.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/pages/timeline.css">
  <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard') }}/css/pages/dashboard-ecommerce.css">
  
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
  @endif
<style>
.fl-wrapper {
    top: 80px !important;
    z-index: 99999 !important;
}
</style>
  <!-- END Custom CSS-->

  {{-- File Input --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('vendor/file-input/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/file-input/themes/explorer-fa5/theme.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



  {{-- Datatables Css --}}

    {{-- css DataTable --}}

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.8/css/dataTables.dataTables.min.css">
  {{-- css Button --}}

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.dataTables.min.css">
  {{-- css responsive --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.8/css/responsive.dataTables.min.css">
  {{-- css colReorder --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/2.1.2/css/colReorder.dataTables.min.css">

  {{-- css rowReorder --}}
  {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.5.1/css/rowReorder.dataTables.min.css"> --}}

  {{-- css select --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/3.1.3/css/select.dataTables.min.css">
  {{-- css Scroller --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.dataTables.min.css">

  {{-- css FixedHeader --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/5.0.5/css/fixedColumns.bootstrap5.min.css">
  {{-- End Datatables Css --}}


@stack('css')
</head>