<!DOCTYPE html>
<html lang="en">
<head>
</head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="@yield('meta_description')">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>@yield('title')</title>

	<link rel="icon" type="image/png" href="/favicon.png">
	<link rel="stylesheet" href="/css/app.css">
	@yield('links')
<body>
	<header class="layout-header">@include('partials.header')</header>
	<section class="layout-content">@yield('content')</section>
	<footer class="layout-footer">@include('partials.footer')</footer>

	<script src="/js/app.js"></script>
	@yield('scripts')
</body>
</html>