<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yieldIf('page-title', '', ' — '){{ config('app.name') }}</title>

<link rel="stylesheet" href="{{ mix("css/font.css") }}">
<link rel="stylesheet" href="{{ mix("css/vendor.css") }}">
<link rel="stylesheet" href="{{ mix("css/app.css") }}">

<meta name="description" content="@yieldDescription()">

@yield('open-graph-tags')