<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/chosen.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/slim.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/css/fullcalendar.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/css/admin/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="{{ asset('lib/ckeditor/ckeditor.js') }}"></script>
</head>
<body>
   <div id="app" v-cloak="">
        @yield('content')
    </div>
      

    

    <!-- Scripts -->
    <script src="/js/moment.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/slim.kickstart.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="/js/fullcalendar.min.js"></script>
    <script src="/js/employee.js"></script>
    @if(explode('/', Request::path())[0] && file_exists("js/" . explode('/', Request::path())[0] . ".js"))
        <script src="{{ asset('js/' . (explode('/', Request::path())[0]) . '.js?v=' . date('YmdH')) }}"></script>
	@endif
</body>
</html>
