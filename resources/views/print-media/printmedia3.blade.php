
<!-- Start 1st form -->

        <div class="col-md-12">
				<h3 class="text-center" style="   padding: 10px;">ORGANIZATION DETAILS</h3>
				<div class="col-md-12" style="border: 1px solid black; padding-top: 15px; margin-bottom: 20px;">
                    {!! Form::hidden('organization[media_category]', Input::get('category')) !!}
                    {!! Form::hidden('organization[user_id]', Auth::user()->id) !!}

                    <div class="form-group col-md-12">
						<label for="organization_name">ORGANIZATION'S NAME</label>
                        {!! Form::text('organization[name]', null, ['class'=>'form-control', 'id'=>'organization_name']) !!}
					</div>

					<div class="form-group col-md-12">
						<label for="organization_editor_name">EDITOR'S NAME</label>
                        {!! Form::text('organization[editor_name]', null, ['class'=>'form-control', 'id'=>'organization_editor_name']) !!}
					</div>

					<div class="form-group col-md-12">
						<label for="organization_address1">OFFICE ADDRESS</label>
                        {!! Form::text('organization[address1]', null, ['class'=>'form-control', 'id'=>'organization_address1', 'placeholder'=>'Office Address, line-1']) !!}
					</div>
					<div class="form-group col-md-12">
                        {!! Form::text('organization[address2]', null, ['class'=>'form-control', 'id'=>'organization_address2',  'placeholder'=>'Office Address, line-2']) !!}
					</div>
					<div class="form-group col-md-7">
                        {!! Form::text('organization[city]', null, ['class'=>'form-control', 'id'=>'organization_city', 'placeholder'=>'City']) !!}
					</div>
					
					<div class="form-group col-md-5">
                        {!! Form::select('organization[country]', ['bangladesh'=>'Bangladesh', 'bhutan'=>'Bhutan', 'maldives'=>'Maldives'], null,['class'=>'form-control select2', 'id'=>'card_collection_point', 'style'=>'width: 100%;']) !!}
					</div>
					
					<div class="form-group col-md-6">
						<label for="organization_phone">Phone <span>(Including country and city code)</span></label>
                        {!! Form::text('organization[phone]', null, ['class'=>'form-control', 'id'=>'organization_phone']) !!}
					</div>

					<div class="form-group col-md-6">
						<label for="organization_email">Your organization's common E-Mail ID</label>
                        {!! Form::text('organization[email]', null, ['class'=>'form-control', 'id'=>'organization_email']) !!}
						Please do not repeat Sports Editor or Assignment Editor's mail ID
					</div>

					<div class="form-group col-md-6">
						<label for="organization_fax">FAX <span>(Including country and city code)</span></label>
                        {!! Form::text('organization[fax]', null, ['class'=>'form-control', 'id'=>'organization_fax']) !!}
					</div>

					<div class="form-group col-md-6">
						<label for="exampleInputWebsite">Website</label>
                        {!! Form::text('organization[website]', null, ['class'=>'form-control', 'id'=>'organization_website']) !!}
					</div>
								
				</div>
		</div>

<!-- End 1st form -->

<!-- Start 2nd form -->
		
        <div class="col-md-12">
				<h3 class="col-md-12 text-center">PERSON WHO FILLED UP THIS FORM</h3>
				<div class="col-md-12" style="border: 1px solid black; padding-top: 20px;">
                    {!! Form::hidden('officer[filled][form_id]', $uniqeId) !!}
                    {!! Form::hidden('officer[filled][category]', 'filled') !!}
                    {!! Form::hidden('officer[filled][media_category]', Input::get('category')) !!}

                    <div class="form-group col-md-6">
                        <label for="name">NAME</label>
                        {!! Form::text('officer[filled][name]', null, ['class'=>'form-control', 'id'=>'name']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="designation">Designation</label>
                        {!! Form::text('officer[filled][designation]', null, ['class'=>'form-control', 'id'=>'designation']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="mobile_number">Mobile Number</label>
                        {!! Form::text('officer[filled][mobile_number]', null, ['class'=>'form-control', 'id'=>'mobile_number']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email">E-Mail</label>
                        {!! Form::text('officer[filled][email]', null, ['class'=>'form-control', 'id'=>'email']) !!}
                    </div>
				</div>
		</div>

