<div class="panel panel-default">

    @if( isset($company->experience->regions ) && count($company->experience->regions) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.region')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->regions as $region)
                        <tr>
                            <td>{{ $region->getNameLang($region->id)->name }}</td>
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
                        <th>@lang('app.region')</th>
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
