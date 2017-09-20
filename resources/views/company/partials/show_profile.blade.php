
<table class="table">
    <tr>
        <th>@lang('app.linkedin_url')</th>
        <td>{{ $company->profile->linkedin_url ? $company->profile->linkedin_url : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.availability')</th>
        <td>{{ $company->profile->availability ? $company->profile->availability : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.size')</th>
        <td>{{ $company->profile->size ? $company->profile->size : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.points')</th>
        <td>{{ $company->profile->points ? $company->profile->points : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.profile_position')</th>
        <td>{{ isset($company->profile->profile_position->id) ? $company->profile->profile_position->getNameLang($company->profile->profile_position->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.actual_position')</th>
        <td>{{ isset($company->profile->actual_position->id) ? $company->profile->actual_position->getNameLang($company->profile->actual_position->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.type_of_shared_search')</th>
        <td>{{ isset($company->profile->type_of_shared_search->id) ? $company->profile->type_of_shared_search->getNameLang($company->profile->type_of_shared_search->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.type_of_involved_search')</th>
        <td>{{ isset($company->profile->type_of_involved_search->id) ? $company->profile->type_of_involved_search->getNameLang($company->profile->type_of_involved_search->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.type_of_shared_opportunity')</th>
        <td>{{ isset($company->profile->type_of_shared_opportunity->id) ? $company->profile->type_of_shared_opportunity->getNameLang($company->profile->type_of_shared_opportunity->id)->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.type_of_involved_opportunity')</th>
        <td>{{ isset($company->profile->type_of_involved_opportunity->id) ? $company->profile->type_of_involved_opportunity->getNameLang($company->profile->type_of_involved_opportunity->id)->name : '-' }}</td>
    </tr>
</table>
