<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('title', 'KChefs')</title>
    <link rel="icon" href="{{ asset('./assets/design.png') }}" type="image/png">

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/dashboard/css/demo.css') }}">

</head>

<body>
    <div class="wrapper">