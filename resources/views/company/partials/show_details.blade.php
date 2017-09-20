<table class="table">
    <caption> @lang('app.company_details')</caption>
    <tr>
        <th>@lang('app.companyname')</th>
        <td>{{ $company->name ? $company->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.comercial_name')</th>
        <td>{{ $company->comercial_name ? $company->comercial_name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.register_number')</th>
        <td>{{ $company->register_number ? $company->register_number : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.description')</th>
        <td>{{ $company->description ? $company->description : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.website')</th>
        <td>{{ $company->website ? $company->website : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.status')</th>
        <td>{{ $company->is_active == 1 ? 'Activo' : 'Inactivo' }}</span>
         </td>
    </tr>
    <tr>
        <th>@lang('app.country')</th>
        <td>{{ $company->address->state->country->name ? $company->address->state->country->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.province')</th>
        <td>{{ $company->address->state->name ? $company->address->state->name : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.city')</th>
        <td>{{ $company->address->city ? $company->address->city : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.zip_code')</th>
        <td>{{ $company->address->zip_code ? $company->address->zip_code : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.address')</th>
        <td>{{ $company->address->address ? $company->address->address : '-' }}</td>
    </tr>
    <tr>
        <th>@lang('app.address_type_id')</th>
        <td>{{ $company->address->address_type->name ? $company->address->address_type->name : '-' }}</td>
    </tr>

</table>
