@extends('blupl/printmedia::select-media')

@section('navbar')
    @include('blupl/printmedia::widgets.header')
@endsection

@section('content')

    <div class="col-md-3"></div>
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <a href="#">
                    <i class="fa fa-print"></i>
                    <p class="box-title">Print</p>
                </a>
                <a class="col-md-offset-1" href="{{ handles('blupl/printmedia::printing/pdf/'.$reporter->id) }}">
                    <i class="fa fa-save"></i>
                    <p class="box-title">Save As PDF</p>
                </a>
            </div>

            <div class="box-body">
                <div class="col-md-4 col-md-offset-4">
                    <div class="row">
                        <div style="float: left;">
                            <p class="text-center">
                                <img src="{{ url($reporter->photo) }}" style="width: 95px;"/>
                            </p>
                            <p class="text-center" style="margin: 0;">{{ $reporter->name }}</p>
                            <p class="text-center" style="margin: 0;">{{ $reporter->role }}</p>
                            <p class="text-center" style="margin: 0;">{{ $reporter->organization->name }}</p>
                        </div>
                        <div style="float: left;">
                            <ul class="text-center" style="list-style-type: none; font-size: 20px; font-weight: 800;">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>6</li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@stop
