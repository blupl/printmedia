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
                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputName">NAME</label>
                            <p>{{ $reporter->name }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputRole1">Role</label>
                            <p>{{ $reporter->role }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputId">National ID / Passport Number</label>
                            <p>{{ $reporter->personal_id }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputGender">Gender</label>
                            <p>{{ $reporter->gender }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputDate">Date of Birth</label>
                            <p>{{ $reporter->date_of_birth }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Mobile Phone Number</label>
                            <p>{{ $reporter->mobile }}<p>
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-4">
                            <label for="exampleInputRole1">Work Station</label>
                            <p>{{ $reporter->work_station }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputRole1">Select card collection point</label>
                            <p>{{ $reporter->card_collection_point }}<p>
                        </div>
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">E-Mail ID</label>
                            <p>{{ $reporter->email }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleInputFile">Photo</label>
                            <br>
                            <img src="{{ url($reporter->photo) }}" style="width: 50px;"/>
                            <h5>File Upload</h5>
                            <a href="{{ url($reporter->photo) }}">DOWNLOAD</a>
                        </div>
                    </div>
                </div>

                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>ASSIGNMENT GRANTER </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputName">NAME</label>
                            <p>{{ $reporter->granter->name }}<p>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputName">Designation</label>
                            <p>{{ $reporter->granter->designation }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">E-Mail ID</label>
                            <p>{{ $reporter->granter->email }}<p>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Mobile Phone Number</label>
                            <p>{{ $reporter->granter->mobile_number }}<p>
                        </div>
                    </div>
                </div>

                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>ORGANIZATION DETAIL </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputName">Organization’s Name</label>
                            <p>{{ $reporter->organization->name }}<p>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputName">Organization’s Name</label>
                            <p>{{ $reporter->organization->editor_name }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleInputAddress">Office Address</label>
                            <p>{{ $reporter->organization->address1 }} {{ $reporter->organization->address2 }}<p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputNumber">Phone</label>
                            <p>{{ $reporter->organization->phone }}<p>
                        </div>
                        <div class="col-sm-6">
                            <label for="exampleInputEmail">Organization’s common E-Mail ID</label>
                            <p>{{ $reporter->organization->email }}<p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleInputFax">Fax</label>
                            <p>{{ $reporter->organization->fax }}<p>
                        </div>
                    </div>
                </div>
                {!! Form::open(['url'=>route('media.approval.zone', $reporter->id), 'method'=>'PUT']) !!}

                <div class="box-body" style="border: 1px solid #f4f4f4; margin: 10px auto;">
                    <div class="form-group">
                        {!! Form::hidden('member_id[]', $reporter->id) !!}
                        @for($x=1; $x <= 6; $x++)
                            <label style="margin-right: 25px;">
                                {{--<input  name="zone[{{ $reporter->id }}][{{ $x }}]" type="checkbox" value="{{ $x }}"> --}}
                                {!! Form::checkbox( 'zone[]', $x, false,['class'=>'minimal']) !!} Zone # {{ $x }}
                            </label>
                        @endfor
                    </div>
                </div>
                {!! Form::submit('Approve', ['class'=>'btn btn-block btn-warning btn-sm']) !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@stop
