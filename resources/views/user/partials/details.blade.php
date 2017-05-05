<div class="panel panel-default">
    <div class="panel-heading">@lang('app.contact_informations')</div>
    <div class="panel-body">
        <div class="row validate-one-input">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">@lang('app.role')</label>
                        {!! Form::select('role', $roles, $edit ? $user->roles->first()->id : '',
                            ['class' => 'form-control', 'id' => 'role', $user_details ? 'disabled' : '']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">@lang('app.status')</label>
                        {!! Form::select('status', $statuses, $edit ? $user->status : '',
                            ['class' => 'form-control', 'id' => 'status', $user_details ? 'disabled' : '']) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">@lang('app.first_name')</label>
                        <input type="text" message="{{trans('app.first_name_required')}}" class="form-control validate-one" id="first_name"
                               name="first_name" placeholder="@lang('app.first_name')" value="{{ $edit ? $user->first_name : '' }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">@lang('app.last_name')</label>
                        <input type="text" message="{{trans('app.last_name_required')}}" class="form-control validate-one" id="last_name"
                               name="last_name" placeholder="@lang('app.last_name')" value="{{ $edit ? $user->last_name : '' }}">
                    </div>
                </div>
            </div>
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
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="principal_phone">@lang('app.principal_phone')</label>
                        {!! Form::input('text', 'phones',$edit ? $user->phone : '', ['message' => trans('app.telf_required'),'class' => 'form-control solo-numero validate-one phone', 'id' => 'phone', 'placeholder' => trans('app.principal_phone')]) !!}
                        <input type="hidden" name="phone" id="phone1" value="{{$edit ? $user->phone : ''}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="secundary_phone">@lang('app.secundary_phone')</label>
                        {!! Form::input('text', 'secundary_phones', $edit ? $user->secundary_phone : '', ['id' => 'secundary_phone', 'placeholder' => trans('app.secundary_phone'), 'class' => 'form-control solo-numero phone']) !!}
                        <input type="hidden" name="secundary_phone" id="phone2" value="{{$edit ? $user->secundary_phone : ''}}">
                    </div>
                </div>
            </div>

            <!--
                <div class="form-group">
                    <label for="birthday">@lang('app.date_of_birth')</label>
                    <div class="form-group">
                        <div class='input-group date'>
                            <input type='text' name="birthday" id='birthday' value="{{ $edit ? $user->birthday : '' }}" class="form-control" />
                            <span class="input-group-addon" style="cursor: default;">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>-->
        </div>
    </div>
</div>