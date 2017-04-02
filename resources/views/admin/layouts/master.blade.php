<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <title>BDS - @yield('title')</title>

    @section('css')
    <!-- Bootstrap Core CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/templates/admin/sbadmin2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    @show

    <!-- Custom CSS -->
    <link href="/templates/admin/sbadmin2/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/templates/admin/sbadmin2/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('admin.layouts.partials.navbar')

            @include('admin.layouts.partials.sidebar')
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    @section('javascript')
    <!-- jQuery -->
    <script src="/templates/admin/sbadmin2/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/templates/admin/sbadmin2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/templates/admin/sbadmin2/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    @show

    <!-- Custom Theme JavaScript -->
    <script src="/templates/admin/sbadmin2/dist/js/sb-admin-2.js"></script>

    @yield('inline_scripts')

    @include('admin.layouts.partials.flash')

</body>

</html>
