@extends('html.barebone')
@title('Login')
@body('login page')

@section('contents')
    <section id="main">
        <div class="wrapper">
            <form class="ui ajax small form" action="{{ route('login') }}" method="post" data-redirect="true">
                <div class="field">
                    <label for="ctrl_email">Email Address</label>
                    <input type="email" id="ctrl_email" name="email" placeholder="john@bracu.ac.bd">
                </div>

                <div class="field">
                    <label for="ctrl_password">Password</label>
                    <input type="password" id="ctrl_password" name="password">
                </div>

                <button class="ui blue fluid button">Sign in</button>

                {!! csrf_field() !!}
            </form>
        </div>
    </section>

    @include('html.partials.footer')
@endsection