<div class="panel panel-default">

    @if( isset($company->experience->experience_roles ) && count($company->experience->experience_roles) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.experience_role')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->experience_roles as $experience_role)
                        <tr>
                            <td>{{ $experience_role->getNameLang($experience_role->id)->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.experience_role')</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> - </td>
                    </tr>
                </tbody>
            </table>
        </div>

    @endif

</div>
