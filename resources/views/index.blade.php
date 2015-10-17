@extends('orchestra/foundation::layouts.page')

@section('navbar')
    @include('blupl/printmedia::widgets.header')
@endsection

@section('content')
    {!! $table !!}
@stop
