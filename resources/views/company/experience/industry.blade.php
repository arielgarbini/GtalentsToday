<div class="panel panel-default">

    @if( isset($company->experience->industries ) && count($company->experience->industries) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.industry')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->industries as $industry)
                        <tr>
                            <td>{{ $industry->getNameLang($industry->id)->name }}</td>
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
                        <th>@lang('app.industry')</th>
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
