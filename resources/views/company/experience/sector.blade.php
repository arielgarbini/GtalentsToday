<div class="panel panel-default">

    @if( isset($company->experience->sectors) && count($company->experience->sectors) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.sector')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->sectors as $sector)
                        <tr>
                            <td>{{ $sector->getNameLang($sector->id)->name }}</td>
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
                        <th>@lang('app.sector')</th>
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
