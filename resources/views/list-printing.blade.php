@extends('blupl/printmedia::select-media')

@section('navbar')
    @include('blupl/printmedia::widgets.header')
@endsection

@section('content')
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Date / Time</th>
            <th>Batch Approva</th>
            <th>Name</th>
            <th>Organization</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reporters as $reporter)
        <tr>
            <td>{{ $reporter->id }}</td>
            <td>{{ $reporter->created_at }}</td>
            <td><input type="checkbox"></td>
            <td>{{ $reporter->name }}</td>
            <td>{{ $reporter->organization->name }}</td>
            <td>{{ $reporter->role }}</td>
            <td>{{ ($reporter->status = true ? 'Approved' : 'Pending') }}</td>
            <td><a href="{{ handles('blupl/printmedia::printing/'.$reporter->id) }}">Print</a> </td>
        </tr>
        @endforeach

        </tbody>
    </table>
@stop
