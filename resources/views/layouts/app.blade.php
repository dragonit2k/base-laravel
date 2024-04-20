<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Include Styles -->
    @include('layouts/styles')
</head>
<body>
<div class="container">
    @yield('content')
</div>

<!-- Include Scripts for customizer, helper, analytics, config -->
@include('layouts/scripts')
@stack('js')

</body>
</html>

