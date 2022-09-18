<!doctype html>
<html lang="en">
<head>
@include('layouts.include')
<title>@yield('title')</title>
</head>
<body>
	@include('layouts.header')
	<div class="container-fluid">@yield('content')</div>
	@include('layouts.footer')
</body>
</html>