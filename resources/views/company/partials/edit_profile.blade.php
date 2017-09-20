<div class="panel panel-default">
    <div class="panel-heading">@lang('app.user_profile')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="linkedin_url">@lang('app.linkedin_url')</label>
                    <input type="text" class="form-control" id="linkedin_url"
                           name="linkedin_url" placeholder="@lang('app.linkedin_url')" value="{{ $edit ? $company->profile->linkedin_url : '' }}">
                </div>
                <div class="form-group">
                    <label for="availability">@lang('app.availability')</label>
                    <input type="text" class="form-control" id="availability"
                           name="availability" placeholder="@lang('app.availability')" value="{{ $edit ? $company->profile->availability : '' }}">
                </div>
                <div class="form-group">
                    <label for="size">@lang('app.size')</label>
                    <input type="text" class="form-control" id="size"
                           name="size" placeholder="@lang('app.size')" value="{{ $edit ? $company->profile->size : '' }}">
                </div>
                <div class="form-group">
                    <label for="points">@lang('app.points')</label>
                    <input type="text" class="form-control" id="points"
                           name="points" placeholder="@lang('app.points')" value="{{ $edit ? $company->profile->points : '' }}" disabled>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="profile_position_id">@lang('app.profile_position')</label>
                    {!! Form::select('profile_position_id', $profilePositions, $edit ? $company->profile->profile_position_id : '',
                        ['class' => 'form-control', 'id' => 'profile_position_id', 'placeholder' => trans('app.select')]) !!}
                </div>
                <div class="form-group">
                    <label for="actual_position_id">@lang('app.actual_position')</label>
                    {!! Form::select('actual_position_id', $actualPositions, $edit ? $company->profile->actual_position_id : '',
                        ['class' => 'form-control', 'id' => 'actual_position_id', 'placeholder' => trans('app.select')]) !!}
                </div>
                <div class="form-group">
                    <label for="type_of_shared_search_id">@lang('app.type_of_shared_search')</label>
                    {!! Form::select('type_of_shared_search_id', $typeSharedSearchs, $edit ? $company->profile->type_of_shared_search_id : '',
                        ['class' => 'form-control', 'id' => 'type_of_shared_search_id', 'placeholder' => trans('app.select')]) !!}
                </div>

                <div class="form-group">
                    <label for="type_of_involved_search_id">@lang('app.type_of_involved_search')</label>
                    {!! Form::select('type_of_involved_search_id', $typeInvolvedSearchs, $edit ? $company->profile->type_of_involved_search_id : '',
                        ['class' => 'form-control', 'id' => 'type_of_involved_search_id', 'placeholder' => trans('app.select')]) !!}
                </div>
                <div class="form-group">
                    <label for="type_of_shared_opportunity_id">@lang('app.type_of_shared_opportunity')</label>
                    {!! Form::select('type_of_shared_opportunity_id', $typeSharedOpportunities, $edit ? $company->profile->type_of_shared_opportunity_id : '',
                        ['class' => 'form-control', 'id' => 'type_of_shared_opportunity_id', 'placeholder' => trans('app.select')]) !!}
                </div>
                <div class="form-group">
                    <label for="type_of_involved_opportunity_id">@lang('app.type_of_involved_opportunity')</label>
                    {!! Form::select('type_of_involved_opportunity_id', $typeInvolvedOpportunities, $edit ? $company->profile->type_of_involved_opportunity_id : '',
                        ['class' => 'form-control', 'id' => 'type_of_involved_opportunity_id', 'placeholder' => trans('app.select')]) !!}
                </div>
            </div>

            <div class="col-md-6">
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        @lang('app.update_profile')
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>