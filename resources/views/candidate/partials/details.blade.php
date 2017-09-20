<div class="panel panel-default">
    <div class="panel-heading">@lang('app.candidate_details')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">@lang('app.first_name')</label>
                        {!! Form::text('first_name', $edit ? $candidate->first_name: '', ['id' => 'first_name', 'class' => 'form-control','placeholder' => trans('app.first_name')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">@lang('app.last_name')</label>
                        {!! Form::text('last_name', $edit ? $candidate->last_name: '', ['id' => 'last_name', 'class' => 'form-control','placeholder' => trans('app.last_name')]) !!}       
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">@lang('app.email')</label>
                        {!! Form::text('email', $edit ? $candidate->email: '', ['id' => 'email', 'class' => 'form-control','placeholder' =>trans('app.email')]) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="code">@lang('app.candidate_code')</label>
                        {!! Form::text('code', $edit ? $candidate->code: '', ['id' => 'code', 'class' => 'form-control','placeholder' =>trans('app.code'), 'disabled' => 'disabled']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="col-md-6">
                    <div class="form-group orb-form">
                        <label>@lang('app.resume')</label>
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
                        <label for="is_active">@lang('app.status')</label>
                        {!! Form::select('is_active', [1 => trans('app.active') ,0 => trans('app.inactive')],null,
                            ['class' => 'form-control', 'id' => 'is_active', $profile ? 'disabled' : '']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>