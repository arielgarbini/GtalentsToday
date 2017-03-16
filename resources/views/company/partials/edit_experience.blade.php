<div class="panel panel-default">
    <div class="panel-heading">@lang('app.experience')</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cases_number_id">@lang('app.cases_numbers')</label>
                    {!! Form::select('cases_number_id', $casesNumbers, $edit ? $company->experience->cases_number_id : '',
                        ['class' => 'form-control', 'id' => 'cases_number_id', 'placeholder' => trans('app.select')]) !!}
                </div>
                <div class="form-group">
                    <label for="level_position_id">@lang('app.level_positions')</label>
                    {!! Form::select('level_position_id', $levelPositions, $edit ? $company->experience->level_position_id : '',
                        ['class' => 'form-control', 'id' => 'level_position_id', 'placeholder' => trans('app.select')]) !!}
                </div>

                <div class="form-group">
                    <label for="list_industries">@lang('app.industry')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_industries[]', $industries, $industry_selected, ['class' => 'form-control multiselect', 'id' => 'list_industries', 'multiple' => 'multiple'])}}
                </div>

                <div class="form-group">
                    <label for="list_experience_roles">@lang('app.experience_role')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_experience_roles[]', $experienceRoles, $experience_role_selected, ['class' => 'form-control multiselect', 'id' => 'list_experience_roles', 'multiple' => 'multiple'])}}
                </div>

                <div class="form-group">
                    <label for="list_sourcing_networks">@lang('app.sourcing_network')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_sourcing_networks[]', $sourcingNetworks, $sourcing_network_selected, ['class' => 'form-control multiselect', 'id' => 'list_sourcing_networks', 'multiple' => 'multiple'])}}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="experience_years_id">@lang('app.experience_years')</label><br>
                    {!! Form::select('experience_years_id', $experienceYears, $edit ? $company->experience->experience_years_id : '',
                        ['class' => 'form-control', 'id' => 'experience_years_id', 'placeholder' => trans('app.select')]) !!}
                </div>

                <div class="form-group">
                    <label for="list_sectors">@lang('app.sector')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_sectors[]', $sectors, $sector_selected, ['class' => 'form-control multiselect', 'id' => 'list_sectors', 'multiple' => 'multiple'])}}
                </div>
                
                <div class="form-group">
                    <label for="list_regions">@lang('app.region')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_regions[]', $regions, $region_selected, ['class' => 'form-control multiselect', 'id' => 'list_regions', 'multiple' => 'multiple'])}}
                </div>
                
                <div class="form-group">
                    <label for="list_functional_areas">@lang('app.functional_area')</label><br>
                    <!--selec multiple--> 
                    {{Form::select('list_functional_areas[]', $functionalAreas, $functional_area_selected, ['class' => 'form-control multiselect', 'id' => 'list_functional_areas', 'multiple' => 'multiple'])}}
                </div>
            </div>

            <div class="col-md-6">
            </div>

            @if ($edit)
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary" id="update-details-btn">
                        <i class="fa fa-refresh"></i>
                        @lang('app.update_experience')
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>