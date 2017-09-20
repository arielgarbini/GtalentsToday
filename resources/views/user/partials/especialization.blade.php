<div class="panel panel-default">
    <div class="panel-heading">@lang('app.especialization')</div>
    <div class="panel-body">
        <div class="row validate-select-input">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="categoria-container">
                        <div class="categoria-container-item">
                            <!--TITULO CATEGORIA-->
                            <a href="#!" class="option subopciones-tag">
                                <span class="icon-gTalents_point"></span>
                                <h3>@lang('app.industry')</h3>
                            </a>
                            <div class="itemForm">
                                <input type="search" style="display: none; width: 50% !important; position: relative; left: 20px;" class="search form-control" >
                            </div>

                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select industries" style="max-height: 200px; overflow: auto;">
                                <!--ITEM 1-->
                                <?php $i=0; ?>
                                @foreach($industries as $key => $ind)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" >
                                        <a href="#!" @if(in_array($ind, $industries_name)) class="active-option" @endif>
                                            <p>{{$ind}}</p>
                                        </a>
                                    </li>
                                @endforeach
                                <input type="hidden" name="industries" id="industries" value="{{implode(',',$industries_id)}}">
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="categoria-container">
                        <div class="categoria-container-item">
                            <!--TITULO CATEGORIA-->
                            <a href="#!" class="option subopciones-tag">
                                <span class="icon-gTalents_point"></span>
                                <h3>@lang('app.ubication_region')</h3>
                            </a>

                            <div class="itemForm">
                                <input type="search" style="display: none; width: 50% !important; position: relative; left: 20px;" class="search form-control" >
                            </div>
                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select location" style="max-height: 200px; overflow: auto;">
                                <!--ITEM 1-->
                                <?php $i=0; ?>
                                @foreach($regions as $key => $ind)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" >
                                        <a href="#!" @if(in_array($ind, $region_name)) class="active-option" @endif>
                                            <p>{{$ind}}</p>
                                        </a>
                                    </li>
                                @endforeach
                                <input type="hidden" name="location" id="location" value="{{implode(',',$region_id)}}">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="years_experience_id">@lang('app.job_title')</label>
                        {!! Form::select('job_title_id', $jobTitle , ($profile!='') ? $profile->jobtitle_id : '', ['message' => trans('app.job_title_id_required'), 'class' => 'validate-select form-control', 'id' => 'job_title_id', 'placeholder' => trans('app.job_title')]) !!}
                    </div>
                    <div class="form-group" id="reference_job_title">
                        <label>@lang('app.reference_job')</label>
                        {!! Form::text('reference_job', ($profile!='') ? $profile->reference_job : '', ['class' => 'form-control', 'id' => 'reference_job', 'placeholder' => trans('app.reference_job')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="years_experience_id">@lang('app.current_company')</label>
                        {!! Form::text('current_company', ($profile!='') ? $profile->current_company : '' , ['class' => 'form-control validate-select', 'message' => trans('app.current_company_required'), 'id' => 'current_company', 'placeholder' => trans('app.current_company')]) !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="years_experience_id">@lang('app.years_of_experience')</label>
                        {!! Form::select('years_experience_id', $experienceYears , ($profile!='') ? $profile->years_experience_id : '', ['message' => trans('app.years_experience_required'), 'class' => 'validate-select form-control', 'id' => 'years_experience_id', 'placeholder' => trans('app.years_of_experience')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="years_experience_id">@lang('app.linkedin')</label>
                        {!! Form::text('linkedin', ($profile!='') ? $profile->linkedin_url : '' , ['class' => 'form-control', 'id' => 'linkedin', 'placeholder' => trans('app.linkedin')]) !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sourcing_networks_id">@lang('app.principal_sourcing')</label>
                        {!! Form::select('sourcing_networks_candidates_id', $sourcingNetworks , ($preferences!='') ? $preferences->sourcing_network_id : '', ['class' => 'form-control', 'id' => 'sourcing_networks_candidates_id', 'placeholder' => trans('app.principal_sourcing')]) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>