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
            <td><a href="{{ handles('blupl/printmedia::approval/print-media') }}"> {{ $reporters->where('media_category', '=', 'print-media')->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Non-Rights Holding Media (TV & Radio)</td>
            <td><a href="{{ handles('blupl/printmedia::approval/nr-holding-media')  }}"> {{ $reporters->where('media_category', '=', 'nr-holding-media')->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Web Media</td>
            <td><a href="{{ handles('blupl/printmedia::approval/web-media') }}"> {{ $reporters->where('media_category', '=', 'web-media')->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        <tr>
            <td>Freelance</td>
            <td><a href="{{ handles('blupl/printmedia::approval/freelancer') }}"> {{ $reporters->where('media_category', '=', 'freelancer')->count() }}</a></td>
            <td>{{ $reporters->where('status','=', 0)->count() }}</td>
            <td>{{ $reporters->where('status','=', 1)->count() }}</td>
        </tr>
        </tbody>
    </table>
@stop
