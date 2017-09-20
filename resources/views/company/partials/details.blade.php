<div class="panel panel-default">
    <div class="panel-heading">@lang('app.company_details')</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">@lang('app.companyname')</label>
                        {!! Form::text('name', $edit ? $company->name: '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => trans('app.companyname')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="comercial_name">@lang('app.comercial_name')</label>
                        {!! Form::text('comercial_name', $edit ? $company->comercial_name: '', ['class' => 'form-control', 'id' => 'comercial_name', 'placeholder' => trans('app.comercial_name')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="register_number">@lang('app.register_number')</label>
                        {!! Form::text('register_number', $edit ? $company->register_number: '', ['class' => 'form-control', 'id' => 'register_number', 'placeholder' => trans('app.register_number')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">@lang('app.description')</label>
                        {!! Form::text('description', $edit ? $company->description: '', ['class' => 'form-control', 'id' => 'description', 'placeholder' => trans('app.description')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website">@lang('app.website')</label>
                        {!! Form::text('website', $edit ? $company->website: '', ['id' => 'website', 'class' => 'form-control','placeholder' => trans('app.website_example')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">@lang('app.status')</label>
                        {!! Form::select('is_active', [1 => trans('app.active') ,0 => trans('app.inactive')], $edit ? $company->is_active: '', ['class' => 'form-control', 'id' => 'is_active', $profile ? 'disabled' : '']) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country">@lang('app.country')</label>
                        {!! Form::select('country', $countries ,$edit && $company->address->state ? $company->address->state->country->id: '', ['class' => 'form-control', 'id' => 'country', 'placeholder' => trans('app.select')]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="state">@lang('app.province')</label>
                        {!! Form::select('state', [] , Input::old('state'), ['class' => 'form-control', 'id' => 'state', 'placeholder' => trans('app.select_country')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip_code">@lang('app.zip_code')</label>
                        {!! Form::text('zip_code', $edit ? $company->address->zip_code: '', ['class' => 'form-control', 'id' => 'zip_code', 'placeholder' => trans('app.zip_code')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">@lang('app.city')</label>
                        {!! Form::text('city', $edit ? $company->address->city: '', ['class' => 'form-control', 'id' => 'city', 'placeholder' => trans('app.city')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="address">@lang('app.address')</label>
                        {!! Form::text('address', $edit ? $company->address->address: '', ['id' => 'address', 'class' => 'form-control','placeholder' => trans('app.address')]) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address_type_id">@lang('app.address_type_id')</label>
                        {!! Form::select('address_type_id', $addressTypes , $edit ? $company->address->address_type_id: '', ['class' => 'form-control', 'id' => 'address_type_id', 'placeholder' => trans('app.select')]) !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('companies.index')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary" id="update-details-btn">
                    <i class="fa fa-{{ $edit ? 'refresh' : 'save' }}"></i>
                    {{ $edit ? trans('app.update_details') : trans('app.create_company') }}
                </button>
            </div>
        </div>
    </div>
</div>