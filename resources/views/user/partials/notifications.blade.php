<div class="panel panel-default">
    <div class="panel-heading">@lang('app.notifications')</div>
    <div class="panel-body">
        <div class="row validate-not-input" >
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('app.password')</label>
                        <input type="password" message="{{trans('app.password_required')}}" class="form-control validate-not" name="password" id="password" placeholder="@lang('app.password')">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('app.confirm_password')</label>
                        <input type="password" message="{{trans('app.password_confirm_required')}}" class="form-control validate-not" name="password_confirmation" id="password_confirmation" placeholder="@lang('app.confirm_password')">
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 additional">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="itemCheck">
                            <p>
                                <input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
                                <label for="receive_messages">@lang('app.confirm_send_emails')</label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="itemCheck">
                            <p>
                                <input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
                                <label for="receive_messages">@lang('app.confirm_send_vacancies')</label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @if (!$edit)
            <div class="row additional2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        @lang('app.create_user')
                    </button>
                </div>
            </div>
        @endif

        @if ($edit)
            <div class="row additional2">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i>
                        @lang('app.update_details')
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>