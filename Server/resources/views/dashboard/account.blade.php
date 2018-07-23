@extends('html.dashboard')
@title('Account Details')

@section('contents')
    <form class="ui small ajax form" action="{{ route('dashboard.account') }}" method="put" data-redirect="on">
        <div class="field">
            <label for="ctrl_name">Name</label>
            <input id="ctrl_name" name="name" value="{{ $app->visitor->name }}">
        </div>

        <div class="field">
            <label for="ctrl_email">Email Address</label>
            <input type="email" id="ctrl_email" name="email" value="{{ $app->visitor->email }}">
        </div>

        <div class="field">
            <label for="ctrl_password">Password</label>
            <input type="password" id="ctrl_password" name="password">
            <small class="hint">Keep this empty if you don't want to change the password.</small>
        </div>

        <div class="field">
            <label for="ctrl_password_confirmation">Confirm Password</label>
            <input type="password" id="ctrl_password_confirmation" name="password_confirmation">
        </div>

        <button class="ui icon labeled green button">
            <i class="save icon"></i>
            Save
        </button>

        {!! csrf_field() !!}
    </form>
@endsection