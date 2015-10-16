@extends('getThemePath::layouts.page')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                {!! Form::open(['route'=>'media.reporter.create', 'id'=>'select-form']) !!}
                <div class="form-group">
                    <label for="select-category">Select list:</label>
                    <select class="form-control" id="select-category">
                        <option>Select Your Category</option>
                        <option value="print-media">Print Media</option>
                        <option value="nr-holding-media">Non-Rights Holding Media(TV & Radio)</option>
                        <option value="web-media">Web Media</option>
                        <option value="freelancer">Freelance</option>
                    </select>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        $('#select-category').on('change', function() {
            var slug = $('#select-category').val();
            var action = $('#select-form').attr('action');
            alert(action);
            window.location = action+'/?role='+slug;
        });
    });
</script>
@stop
