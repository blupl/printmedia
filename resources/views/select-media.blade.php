@extends('orchestra/foundation::layouts.page')

@section('content')


                {!! Form::open(['route'=>'media.reporter.create', 'id'=>'select-form']) !!}
                <div class="col-md-12">

                    <div class="form-group col-md-6" style="margin: 50px auto; float: none;">
                        <h1 style="text-align: center;">MEDIA ACCREDITATION</h1>
                        {{--<label for="select-category">Select list:</label>--}}
                        <select class="form-control select2" id="select-category" style="width: 100%;">
                            <option>Select Your Category</option>
                            <option value="print-media">Print Media</option>
                            <option value="nr-holding-media">Non-Rights Holding Media(TV & Radio)</option>
                            <option value="web-media">Web Media</option>
                            <option value="freelancer">Freelance</option>
                        </select>
                    </div>
                </div>
                {!! Form::close() !!}

<script>
    $(document).ready(function () {
        $('#select-category').on('change', function() {
            var slug = $('#select-category').val();
            var action = $('#select-form').attr('action');
            window.location = action+'/?category='+slug;
        });
    });
</script>
@stop

@push('orchestra.footer')
    @include('blupl/printmedia::common._inputScript')
@stop