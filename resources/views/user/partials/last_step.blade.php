<div class="panel panel-default">
    <div class="panel-heading">@lang('app.last_step')</div>
    <div class="panel-body">
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="itemRadio">
                            <h4>@lang('app.do_you_have_promotional')</h4>
                            <div class="itemRadio-radio">
                                <p>
                                    <input name="group1" type="radio" id="test1" />
                                    <label for="test1">@lang('app.yes')</label>
                                </p>
                                <p>
                                    <input name="group1" type="radio" id="test2" checked/>
                                    <label for="test2">@lang('app.no')</label>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="promotional_code_item">
                        <label>@lang('app.promotional_code')</label>
                        {!! Form::text('promotional_code', '', ['class' => 'form-control', 'id' => 'promotional_code', 'placeholder' => trans('app.promotional_code')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>@lang('app.how_did_you_hear_about_us')</label>
                        {!! Form::select('contact_id', $contacts, ($preferences!='') ? $preferences->contact_id : '', ['class' => 'form-control', 'id' => 'contact_id', 'placeholder' => trans('app.how_did_you_hear_about_us')]) !!}
                    </div>
                    <div class="form-group" id="reference_item">
                        <label>@lang('app.reference')</label>
                        {!! Form::text('reference', ($preferences!='') ? $preferences->reference : '', ['class' => 'form-control', 'id' => 'reference', 'placeholder' => trans('app.reference')]) !!}
                    </div>
                </div>
            </div>

            {!! Form::hidden('organization_role', 'both', ['id' => 'organization_role']) !!}

        </div>
        @if (!$edit)
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    @lang('app.create_user')
                </button>
            </div>
        </div>
        @endif

        @if ($edit)
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" id="update-details-btn">
                    <i class="fa fa-refresh"></i>
                    @lang('app.update_details')
                </button>
            </div>
        @endif

    </div>
</div>