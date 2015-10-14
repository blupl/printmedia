

	<div class="col-md-12">
        <!-- start p -->
                <p style="font-family: SutonnyMJ; font-size: 18px;">GB -- -- Kfvi Kivi Rb¨ Avcbvi cÖwZôvb m‡e©v”P 2 (`yB) Rb d‡Uv mvsevw`‡Ki bvg Gw›Uª Ki‡Z cvi‡e| d‡Uv mvsevw`K 1(GK) Rb n‡j evwK NiwU duvKv ivLyb|</p>
            <!-- End p -->


        @for($x=1; $x <= 4; $x++)

            <!-- Start 1st form -->
                    <div class="col-md-6" style="">
                            <fieldset {!! ($x != 1 ? 'disabled' : '')  !!} class="col-md-12" style="border: 1px solid black; padding-top: 15px; margin-bottom: 20px;">
                                <div class="form-group col-md-12">
                                    <h3 class="left">REPORTER # {{ $x }} {!! ($x != 1 ? '<a class="form-active btn-link"><small>| Active</small></a>' : '')  !!}</h3>
                                </div>
                                {!! Form::hidden('reporter['.$x.'][form_id]', $uniqeId) !!}
                                {!! Form::hidden('reporter['.$x.'][category]', 'reporter') !!}

                                <div class="form-group col-md-12">
                                    <label for="name">NAME</label>
                                    {!! Form::text('reporter['.$x.'][name]', null, ['class'=>'form-control', 'id'=>'name']) !!}
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="personal_id">National ID / Passport Number</label>
                                    {!! Form::text('reporter['.$x.'][personal_id]', null, ['class'=>'form-control', 'id'=>'personal_id']) !!}
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="gender">Gender</label>
                                    {!! Form::select('reporter['.$x.'][gender]', ['male'=>'Male', 'female'=>'Female', 'other'=>'Other'], null,['class'=>'form-control', 'id'=>'gender']) !!}
                                </div>

                                <div class="xdisplay_inputx form-group has-feedback col-md-6">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                                {!! Form::input('date', 'reporter['.$x.'][date_of_birth]', null, ['class'=>'form-control has-feedback-left date_of_birth', 'aria-describedby'=>'dateOfBirth', 'id'=>'', 'placeholder'=>'Date of Birth']) !!}
                                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                                <span id="dateOfBirth" class="sr-only">(success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="mobile">Mobile Phone Number</label>
                                    {!! Form::text('reporter['.$x.'][mobile]', null, ['class'=>'form-control', 'id'=>'mobile']) !!}
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="email">E-Mail ID</label>
                                    {!! Form::text('reporter['.$x.'][email]', null, ['class'=>'form-control', 'id'=>'email']) !!}

                                </div>

                                <div class="form-group col-md-5">
                                    <label for="role">Role</label>
                                    {!! Form::select('reporter['.$x.'][role]', ['reporter'=>'Reporter'], 'reporter', ['class'=>'form-control', 'id'=>'role', 'readonly'=>'readonly']) !!}

                                </div>

                                <div class="form-group col-md-6 col-md-offset-1">
                                        <label for="work_station col-md-12">Work Station</label>
                                        {!! Form::select('reporter['.$x.'][work_station]', ['dhaka'=>'Dhaka', 'chittagong'=>'Chittagong', 'sylhet'=>'Sylhet', 'khulna'=>'Khulna'], null, ['class'=>'form-control', 'id'=>'work_station']) !!}
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="form-group">
                                        <label for="photo">Upload recently taken portrait photo for accreditation card</label>
                                    </div>

                                    <div class="form-group">
                                        {!! Form::text('reporter['.$x.'][photo]', 'yoo', ['class'=>'form-control', 'id'=>'photo']) !!}
                                        <p class="help-block"></p>
                                    </div>

                                    <div class="form-group">
                                        <p style="font-family: SutonnyMJ;">Qwei e¨vw³i bv‡g dvB‡ji bvgKiY Kiyb| Qwe A¯úó, Svcmv A_ev gyLgÛj h_vh_fv‡e cÖZxqgvb bv n‡j Avcbvi G¨v‡µwW‡Ukb KvW© cÖvwß wejw¤^Z n‡Z cv‡i| Qwei mvBR by¨bZg 50 I m‡e©v”P 150 wK‡jvevBU|</p>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="card_collection_point">Select card collection point</label>
                                    {!! Form::select('reporter['.$x.'][card_collection_point]', ['dhaka'=>'Dhaka', 'chittagong'=>'Chittagong', 'sylhet'=>'Sylhet', 'khulna'=>'Khulna'], null,['class'=>'form-control', 'id'=>'card_collection_point']) !!}
                                </div>

                            </fieldset>
                    </div>
            <!-- End 1st form -->
        @endfor

    </div>