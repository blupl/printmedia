@extends('orchestra/foundation::layouts.page')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                @include('blupl/printmedia::widgets.header')

                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Settings 1</a>
                            </li>
                            <li><a href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                @include('blupl/printmedia::_form')

            </div>
        </div>
    </div>
</div>
@stop


@push('orchestra.footer')
    <script type="text/javascript" src="{{ asset('packages/blucms/foundation/js/wizard/jquery.smartWizard.js') }}"></script>
    @include('blupl/printmedia::common._inputScript')
    <script type="text/javascript">
        $(document).ready(function () {
            // Smart Wizard
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });

        $(document).ready(function () {
            // Smart Wizard
            $('#wizard_verticle').smartWizard({
                transitionEffect: 'slide'
            });

        });

        $(document).ready(function () {
            $('.form-active').on('click', function() {
                var filed = $(this).parents('fieldset');
                filed.prop("disabled", false);
                $(this).hide();
            });
        });
    </script>

    <!-- /datepicker -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('.date_of_birth').daterangepicker({
                singleDatePicker: true,
                calender_style: "picker_3"
            }, function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
//                $('.date_of_birth').html(start.format('MMMM D, YYYY'));
            });

        });
    </script>
@endpush
