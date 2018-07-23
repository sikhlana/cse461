@section('open-graph-tags')
    <meta itemprop="name" content="{{ $title }}">
    <meta itemprop="description" content="{{ $description ?? config('app.description') }}">
    <meta itemprop="image" content="{{ $image ?? asset('images/logo.og.png') }}">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:type" content="{{ $type ?? 'website' }}">
    <meta property="og:url" content="{{ $link ?? url()->full() }}">
    <meta property="og:image" content="{{ $image ?? asset('images/logo.og.png') }}">
    <meta property="og:description" content="{{ $description ?? config('app.description') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
@endsection