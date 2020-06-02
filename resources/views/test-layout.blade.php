<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="{{asset('test/css/bootstrap.min.css')}}">
    @stack('stylesheets')
</head>
<body>
<div class="container-fluid">
    {{--  nap header view  --}}
    @include('test/partials/header_view')

    {{-- nap nav view   --}}
    @include('test/partials/nav_view')

    <main class="h-100 w-100" style="min-height: 680px;">
        {{--    nap noi dung cac layout con vao day    --}}
        @yield('content')
    </main>

    {{-- nap footer view   --}}
    @include('test/partials/footer_view')
</div>
<script type="text/javascript" src="{{asset('test/js/jquery-3.5.1.min.js')}}"></script>
@stack('scripts')
</body>
</html>

