
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Laravel | Vue JS</title>
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin-lte/docs/assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-lte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .router-link-exact-active {
            background-color: #007bff !important;
            color: white;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini login-page">

<div id="main">
    <public></public>
</div>



<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('admin-lte/docs/assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
