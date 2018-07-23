@extends('html.barebone')
@body('error page')
@section('contents')
    <div class="ui container">
        <div class="ui equal width heading grid">
            <div class="center aligned column">
                <h2 class="ui icon header">
                    <i class="exclamation triangle icon"></i>
                    <span class="content">
                        @yieldH1()
                    </span>
                </h2>
            </div>
        </div>

        <div class="ui grid">
            <div class="sixteen wide column">
                <p class="message">@yield('message')</p>
            </div>
        </div>
    </div>
@endsection