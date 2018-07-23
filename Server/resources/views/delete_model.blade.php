@extends('html.admin')
@title('Confirm Deletion')

@section('contents')
    <form class="ui ajax form" action="{{ request()->url() }}" method="delete" data-redirect="on" style="text-align: center;">
        <h4>Are you sure you want to delete this {{ $name }}?</h4>

        <button class="ui red button">Delete</button>
        <input type="hidden" name="_confirm" value="{{ request()->session()->get('requestConfirmationToken') }}">
        {!! csrf_field() !!}
    </form>
@endsection

@section('modal-size', 'mini')