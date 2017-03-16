<table class="table">
    <caption>@lang('app.consultants_associated')</caption>
    @if ($company->users)  
        <th>@lang('app.names')</th>
        <th>@lang('app.roles')</th>
        @foreach ($company->users as $user)
            <tr>
                <td>{{$user->first_name}} {{$user->last_name}}</td>
                <td>{{$user->hasRole('AdminConsultant') ? trans('app.admin_consultant') : trans('app.consultant')}}</td>
            </tr>
        @endforeach    
    @else 
        <tr>
            <th>@lang('app.no_consultants_were_found')</th>
        </tr>
    @endif                      
</table>
