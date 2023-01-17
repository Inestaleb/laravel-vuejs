<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>QuickRDV</title>



<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
    
  <link rel="stylesheet" href="{{asset('vendors/iconly/bold.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="{{asset('css/main.css')}}" rel="stylesheet" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{asset('vendors/bootstrap-icons/bootstrap-icons.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('admin/css/now-ui-dashboard.css?v=1.5.0')}}" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="{{asset('admin/demo/demo.css')}}" rel="stylesheet" />
	
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		
   
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!--==============================================================================================-->

<link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="{{asset('plugins/fancybox/jquery.fancybox.min.css')}}">



<link rel="stylesheet" href="{{asset('plugins/icon-kit/dist/css/iconkit.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/ionicons/dist/css/ionicons.min.css')}}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('images/icons/icon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">

<!--==============================================================
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
       <!-- this class is for error IN FORM  -->
		<style>
          small {          
	              color: red;
               	display: none;
                }
          .mx_form_inv .mx_empty_filed ~ small {  
	               display: block;
                }
          .mx_form_inv .mx_recaptcha_failed small {  
	              display: block;
              }

          .passwords{
              display:none
            }
</style>
<link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">
<link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('template/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
  
  <!-- Template Main CSS File -->
  <link href="{{asset('template/css/style.css')}}" rel="stylesheet">
    </head>
  
    <body>
    <!-- id="app"  take from  el: '#app', in app.js -->
    <div id="app">

        <index></index>
     </div>


       <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></>


<!-- RECAPTCH -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<!-- Minify -->

<script src="{{asset('js/a076d05399.js')}}" ></script>
<script src="{{asset('template/vendor/purecounter/purecounter.js')}}"></script>
  <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('template/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('template/vendor/php-email-form/validate.js')}}"></script>
        <script src="{{asset('plugins/theia-sticky-sidebar/ResizeSensor.js')}}" ></script>
        <script src="{{asset('plugins/theia-sticky-sidebar/theia-sticky-sidebar.js')}}" ></script>
				<script src="{{asset('js/jquery.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('js/popper.min.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Sticky Sidebar JS -->
     
		
		<!-- Custom JS -->
		<script src="{{asset('js/script.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('template/js/main.js')}}"></script>
  <script type="text/javascript">
 

  
 </script>
</body>

</html>
