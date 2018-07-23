<!doctype html>
<html id="bracu" lang="{{ app()->getLocale() }}">
<head>
    @include('html.partials.head')
</head>
<body id="@yieldBody()">
    <div id="app">
        @include('html.partials.header')

        <section id="main">
            <div class="ui main fluid container">
                @hasSection('extraHeader')
                    <div class="row">
                        <div class="sixteen wide column">
                            @yield('extraHeader')
                        </div>
                    </div>
                @endif

                <div class="ui grid">
                    @hasH1()
                        <div class="row">
                            <div class="seven wide column">
                                <h2 class="ui header">
                                    <span class="content">@yieldH1()</span>
                                </h2>
                            </div>

                            <div class="nine wide right aligned column">
                                @yield('topCtrl')
                            </div>
                        </div>
                    @else
                        @hasSection('topCtrl')
                            <div class="row">
                                <div class="sixteen wide right aligned column">
                                    @yield('topCtrl')
                                </div>
                            </div>
                        @endif
                    @endif

                    <div class="row">
                        <div class="sixteen wide column">
                            @yield('contents')
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('html.partials.footer')
    </div>

    @include('html.partials.javascript')
</body>
</html>