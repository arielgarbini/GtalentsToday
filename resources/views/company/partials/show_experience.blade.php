<table class="table">
    <tr>
        <th>@lang('app.cases_numbers')</th>
        <td>{{ isset($company->experience->cases_numbers->id) ? $company->experience->cases_numbers->getNameLang($company->experience->cases_numbers->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.experience_years')</th>
        <td>{{ isset($company->experience->experience_years->id) ? $company->experience->experience_years->getNameLang($company->experience->experience_years->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.level_positions')</th>
        <td>{{ isset($company->experience->level_positions->id) ? $company->experience->level_positions->getNameLang($company->experience->level_positions->id)->name : '-' }}</td>
    </tr>
</table>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#sector" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.sector')
        </a>
    </li>
    <li role="presentation">
        <a href="#industry" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.industry')
        </a>
    </li>
    <li role="presentation">
        <a href="#region" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.region')
        </a>
    </li>
    <li role="presentation">
        <a href="#experience_role" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.experience_role')
        </a>
    </li>
    <li role="presentation">
        <a href="#functional_area" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.functional_area')
        </a>
    </li>
    <li role="presentation">
        <a href="#sourcing_network" aria-controls="details" role="tab" data-toggle="tab">
            @lang('app.sourcing_network')
        </a>
    </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

    <div role="tabpanel" class="tab-pane active" id="sector">
        @include('company.experience.sector')

    </div>

    <div role="tabpanel" class="tab-pane" id="industry">
        @include('company.experience.industry')
    </div>

    <div role="tabpanel" class="tab-pane" id="region">
        @include('company.experience.region')
    </div>

    <div role="tabpanel" class="tab-pane" id="experience_role">
        @include('company.experience.experience_role')
    </div>

    <div role="tabpanel" class="tab-pane" id="functional_area">
        @include('company.experience.functional_area')
    </div>

    <div role="tabpanel" class="tab-pane" id="sourcing_network">
        @include('company.experience.sourcing_network')
    </div>

</div>
