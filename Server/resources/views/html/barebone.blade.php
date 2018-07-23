<!doctype html>
<html id="bracu" lang="{{ app()->getLocale() }}">
<head>
    @include('html.partials.head')
</head>
<body class="@yieldBody()">
    <div id="app">
        @yield('contents')
    </div>

    @include('html.partials.javascript')
</body>
</html>