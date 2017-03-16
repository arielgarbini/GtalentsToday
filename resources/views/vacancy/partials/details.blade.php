
<!-- Nav tabs steps -->
<div class="container-step">
    <ul class="nav nav-tabs" role="tablist" id="menu-step">
        <li role="presentation" class="active">
            <a href="#create" aria-controls="create" role="tab" data-toggle="tab" id="step-one">
                @lang('app.general')
            </a>
        </li>
        
        <li role="presentation">
            <a href="#details" aria-controls="details" role="tab" data-toggle="tab" id="step-two">
                @lang('app.details')
            </a>
        </li>
        
        <li role="presentation">
            <a href="#conditions" aria-controls="details" role="tab" data-toggle="tab" id="step-three">
                @lang('app.conditions')
            </a>
        </li>
    </ul>
</div>
<br />

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="create">

        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.vacancy_create')</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">@lang('app.name_position')</label>
                                {!! Form::text('name', $edit ? $vacancy->name: '', ['id' => 'name', 'class' => 'form-control','placeholder' => trans('app.name_position')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="positions_number">@lang('app.positions_number')</label>
                                {!! Form::text('positions_number', $edit ? $vacancy->positions_number: '', ['id' => 'positions_number', 'class' => 'form-control','placeholder' => trans('app.positions_number')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="career_plan">@lang('app.career_plan')</label>
                                {!! Form::text('career_plan', $edit ? $vacancy->career_plan: '', ['id' => 'career_plan', 'class' => 'form-control','placeholder' => trans('app.career_plan')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="scheme_work_id">@lang('app.scheme_work')</label>
                                {!! Form::select('scheme_work_id', $schemeWorks ,null, ['class' => 'form-control', 'id' => 'scheme_work_id']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group orb-form">
                                <label>@lang('app.file')</label>
                                <label for="file" class="input input-file">
                                    <div class="button">
                                        <input type="file" id="file" name="file">
                                        @lang('app.browse')
                                    </div>
                                    <input type="text" readonly id="doc_text" placeholder="{{ $edit ? trans('app.edit_or_leave_blank') : trans('app.select_file') }}">
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="list_languages">@lang('app.languages')</label><br>
                                <!--selec multiple--> 
                                {{Form::select('list_languages[]', $languages, $edit? $language_selected : '', ['class' => 'multiselect', 'id' => 'list_languages', 'multiple' => 'multiple'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">@lang('app.description')</label>
                                {!! Form::textarea('description', $edit ? $vacancy->description: '', ['class' => 'form-control', 'id' => 'description', 'placeholder' => trans('app.description')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="responsabilities">@lang('app.responsabilities')</label>
                                {!! Form::textarea('responsabilities', $edit ? $vacancy->responsabilities: '', ['class' => 'form-control', 'id' => 'responsabilities', 'placeholder' => trans('app.responsabilities')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="key_points">@lang('app.key_points')</label>
                                {!! Form::textarea('key_points', $edit ? $vacancy->key_points: '', ['class' => 'form-control', 'id' => 'key_points', 'placeholder' => trans('app.key_points')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary next">
                        <i class="fa fa-arrow-right"></i>
                        @lang('app.next')
                    </button>
                </div>
            </div>
        </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="details">

        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.vacancy_details')</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience">@lang('app.experience')</label>
                                {!! Form::text('experience', $edit ? $vacancy->experience: '', ['id' => 'experience', 'class' => 'form-control','placeholder' => trans('app.experience')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contract_type_id">@lang('app.contract_type')</label>
                                {!! Form::select('contract_type_id', $contractTypes ,null, ['class' => 'form-control', 'id' => 'contract_type_id']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sharing">@lang('app.sharing')</label>
                                {!! Form::text('sharing', $edit ? $vacancy->sharing: '', ['id' => 'sharing', 'class' => 'form-control','placeholder' => trans('app.sharing')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="vacancy_status_id">@lang('app.vacancy_status')</label>
                                {!! Form::select('vacancy_status_id', $vacancyStatus ,null, ['class' => 'form-control', 'id' => 'vacancy_status_id']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="minimum_salary">@lang('app.minimum_salary')</label>
                                {!! Form::text('minimum_salary', $edit ? $vacancy->minimum_salary: '', ['id' => 'minimum_salary', 'class' => 'form-control','placeholder' => trans('app.minimum_salary')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maximum_salary">@lang('app.maximum_salary')</label>
                                {!! Form::text('maximum_salary', $edit ? $vacancy->maximum_salary: '', ['id' => 'maximum_salary', 'class' => 'form-control','placeholder' => trans('app.maximum_salary')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">@lang('app.country')</label>
                                {!! Form::select('country', $countries ,$edit ? $vacancy->address->state->country->id: '', ['class' => 'form-control', 'id' => 'country', 'placeholder' => trans('app.select')]) !!}
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
                                {!! Form::text('zip_code', $edit ? $vacancy->address->zip_code: '', ['class' => 'form-control', 'id' => 'zip_code', 'placeholder' => trans('app.zip_code')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city">@lang('app.city')</label>
                                {!! Form::text('city', $edit ? $vacancy->address->city: '', ['class' => 'form-control', 'id' => 'city', 'placeholder' => trans('app.city')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">@lang('app.address')</label>
                                {!! Form::text('address', $edit ? $vacancy->address->address: '', ['id' => 'address', 'class' => 'form-control','placeholder' => trans('app.address')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address_type_id">@lang('app.address_type_id')</label>
                                {!! Form::select('address_type_id', $addressTypes , $edit ? $vacancy->address->address_type_id: '', ['class' => 'form-control', 'id' => 'address_type_id', 'placeholder' => trans('app.select')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary back">
                        <i class="fa fa-arrow-left"></i>
                        @lang('app.back')
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary next2">
                        <i class="fa fa-arrow-right"></i>
                        @lang('app.next')
                    </button>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>

    </div>

    <div role="tabpanel" class="tab-pane" id="conditions">

        <div class="panel panel-default">
            <div class="panel-heading">@lang('app.conditions')</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="general_conditions">@lang('app.general_conditions')</label>
                                {!! Form::textarea('general_condition', $edit ? $vacancy->condition->general_condition: '', ['id' => 'general_condition', 'class' => 'form-control','placeholder' => trans('app.general_conditions')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="approximate_total_billing">@lang('app.approximate_total_billing')</label>
                                {!! Form::text('approximate_total_billing', $edit ? $vacancy->condition->approximate_total_billing: '', ['id' => 'approximate_total_billing', 'class' => 'form-control','placeholder' => trans('app.approximate_total_billing')]) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="comission">@lang('app.comission')</label>
                                {!! Form::text('comission', $edit ? $vacancy->condition->comission: '', ['id' => 'comission', 'class' => 'form-control','placeholder' => trans('app.comission')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty">@lang('app.days_warranty')</label>
                                {!! Form::text('warranty', $edit ? $vacancy->condition->warranty: '', ['id' => 'warranty', 'class' => 'form-control','placeholder' => trans('app.warranty')]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary back2">
                        <i class="fa fa-arrow-left"></i>
                        @lang('app.back')
                    </button>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary save">
                        <i class="fa fa-save"></i>
                        {{ $edit ? trans('app.edit_vacancy') : trans('app.create_vacancy') }}
                    </button>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>

    </div>
</div>