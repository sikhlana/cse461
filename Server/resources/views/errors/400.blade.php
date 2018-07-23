@extends('html.errors')
@title('Whoops!')
@section('message', $exception->getMessage())