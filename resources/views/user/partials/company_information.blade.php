<div class="panel panel-default">
    <div class="panel-heading">@lang('app.company_information')</div>
    <div class="panel-body">
        <div class="row validate-dos-input">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">@lang('app.company_name')</label>
                        <input type="text" message="{{trans('app.company_required')}}" class="validate-dos form-control" id="company_name"
                               name="company_name" placeholder="@lang('app.company_name')" value="{{ $company!='' ? $company->name : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="website">@lang('app.website')</label>
                        <input type="text" class="form-control" id="website"
                               name="website" placeholder="@lang('app.website')" value="{{ $company!='' ? $company->website : '' }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country_id2">@lang('app.country')</label>
                        {!! Form::select('country_id2', $countries, ($address!='') ? $address->address : '', ['message' => trans('app.country_required'), 'class' => 'form-control validate-dos browser-default', 'id' => 'country_id2', 'placeholder' => trans('app.choose_country')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('app.state_province')</label>
                        {!! Form::text('state2', ($address!='') ? $address->city : '', ['message' => trans('app.state_required'), 'id' => 'state2', 'placeholder' => trans('app.state_province'), 'class' => 'form-control validate-dos']) !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity_employees_id">@lang('app.size_company')</label>
                        {!! Form::select('quantity_employees_id', $quantityEmployees , ($company!='') ? $company->quantity_employees_id : '', ['message' => trans('app.quantity_employees_required'), 'class' => 'form-control validate-dos', 'id' => 'quantity_employees_id', 'placeholder' => trans('app.choose_quantity_employees')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity_employees_id">@lang('app.current_job_title')</label>
                        {!! Form::select('actual_position_id', $positions , ($profile!='') ? $profile->actual_position_id : '', ['message' => trans('app.current_job_required'), 'class' => 'validate-dos form-control', 'id' => 'actual_position_id', 'placeholder' => trans('app.choose_actual_position')]) !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="categoria-container">
                        <div class="categoria-container-item">
                            <!--TITULO CATEGORIA-->
                            <a href="#!" class="option subopciones-tag">
                                <span class="icon-gTalents_point"></span>
                                <h3>@lang('app.search_type_share')</h3>
                                <span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
                                    <i class="icon-gTalents_help "></i>
                                </span>
                            </a>

                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select searchType">
                                <!--ITEM 1-->
                                <?php $i=0; ?>
                                @foreach($searchTypeShared as $key => $se)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" @if($i%2!=0 && (count($searchTypeShared) - $i) != 0) style="float:left" @else style="width:inherit;"  @endif>
                                        <a href="#!" @if(in_array($se, $type1_name)) class="active-option" @endif>
                                            <p>{{$se}}</p>
                                        </a>
                                    </li>
                                @endforeach

                                <input type="hidden" name="searchType" id="searchType" value="{{implode(',',$type1_id)}}">
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
                                <h3>@lang('app.search_type_work')</h3>
                                <span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
                            </a>

                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select searchTypeWork">
                                <!--ITEM 1-->

                                <?php $i=0; ?>
                                @foreach($searchTypeInvolved as $key => $se)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" @if($i%2!=0 && (count($searchTypeInvolved) - $i) != 0) style="float:left" @else style="width:inherit;"  @endif>
                                        <a href="#!" @if(in_array($se, $type2_name)) class="active-option" @endif>
                                            <p>{{$se}}</p>
                                        </a>
                                    </li>
                                @endforeach


                                <input type="hidden" name="searchTypeWork" id="searchTypeWork" value="{{implode(',',$type2_id)}}">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="categoria-container">
                        <div class="categoria-container-item">
                            <!--TITULO CATEGORIA-->
                            <a href="#!" class="option subopciones-tag">
                                <span class="icon-gTalents_point"></span>
                                <h3>@lang('app.opportunity_share')</h3>
                                <span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
                            </a>

                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select opportunityShare">
                                <!--ITEM 1-->

                                <?php $i=0; ?>
                                @foreach($opportunityShared as $key => $se)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" @if($i%2!=0 && (count($opportunityShared) - $i) != 0) style="float:left" @else style="width:inherit;"  @endif>
                                        <a href="#!" @if(in_array($se, $type3_name)) class="active-option" @endif>
                                            <p>{{$se}}</p>
                                        </a>
                                    </li>
                                @endforeach
                                <input type="hidden" name="opportunityShare" id="opportunityShare" value="{{implode(',',$type3_id)}}">
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
                                <h3>@lang('app.opportunity_work')</h3>
                                <span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
                            </a>

                            <!--CONTENEDOR DE SUB-OPCIONES-->
                            <ul class="subopciones subopciones-select opportunityInvolved">
                                <!--ITEM 1-->
                                <?php $i=0; ?>
                                @foreach($opportunityInvolved as $key => $se)
                                    <?php $i++; ?>
                                    <li value="{{$key}}" @if($i%2!=0 && (count($opportunityInvolved) - $i) != 0) style="float:left" @else style="width:inherit;"  @endif>
                                        <a href="#!" @if(in_array($se, $type4_name)) class="active-option" @endif>
                                            <p>{{$se}}</p>
                                        </a>
                                    </li>
                                @endforeach

                                <input type="hidden" name="opportunityInvolved" id="opportunityInvolved" value="{{implode(',',$type4_id)}}">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        <!--
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">@lang('app.email')</label>
                        <input type="text" message="{{trans('app.email_required')}}" class="validate-one form-control" id="email"
                               name="email" placeholder="@lang('app.email')" value="{{ $edit ? $user->email : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">@lang('app.country')</label>
                        {!! Form::select('country_id', $countries, $edit ? $user->country_id : '', ['message' => trans('app.country_required'), 'class' => 'validate-one form-control', 'placeholder' => trans('app.country')]) !!}
                    </div>
                </div>
            </div>-->

        </div>
    </div>
</div>