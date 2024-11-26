<!DOCTYPE html>

<html lang="en">
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Bootstrap App Landing Template">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
  <meta name="author" content="Themefisher">
  <meta name="generator" content="Themefisher Small Apps Template v1.0">
  
  <!-- theme meta -->
  <meta name="theme-name" content="small-apps" />

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />
  
  <!-- PLUGINS CSS STYLE -->
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/fancybox/jquery.fancybox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/users/plugins/aos/aos.css') }}">

  <!-- CUSTOM CSS -->
  <link href="{{ asset('assets/users/css/style.css') }}" rel="stylesheet">

  {{-- DATE TIME PICKER --}}
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="{{ asset('assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" type="text/css" media="all" />
  

</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">
    @include('users.header')
    @include('users.hero')
    @yield('content')
    @include('users.footer')
</body>
<!-- JAVASCRIPTS -->
<script src="{{ asset('assets/users/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/users/plugins/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/users/plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('assets/users/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('assets/users/plugins/syotimer/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('assets/users/plugins/aos/aos.js') }}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script>
<script src="{{ asset('assets/users/plugins/google-map/gmap.js') }}"></script>

<script src="{{ asset('assets/users/js/script.js') }}"></script>

{{-- DATE TIME PICKER --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap-datetimepicker/js/demo.js') }}"></script>
</html>
