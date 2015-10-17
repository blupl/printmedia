@extends('blupl/printmedia::select-media')

@section('navbar')
    @include('blupl/printmedia::widgets.header')
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>Number Of Enthies</th>
            <th>Pending</th>
            <th>Approval</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Print Media</td>
            <td><a href="{{ url('media/approval?category=reporter') }}"> {{ $reporters->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Non-Rights Holding Media (TV & Radio)</td>
            <td><a href="{{ url('media/approval?category=reporter') }}"> {{ $reporters->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Web Media</td>
            <td><a href="{{ url('media/approval?category=reporter') }}"> {{ $reporters->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Freelance</td>
            <td><a href="{{ url('media/approval?category=reporter') }}"> {{ $reporters->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        </tbody>
    </table>
@stop