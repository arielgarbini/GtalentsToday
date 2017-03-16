<div class="panel panel-default">

    @if( isset($company->experience->functional_areas ) && count($company->experience->functional_areas) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.functional_area')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->functional_areas as $functional_area)
                        <tr>
                            <td>{{ $functional_area->getNameLang($functional_area->id)->name }}</td>
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
                        <th>@lang('app.functional_area')</th>
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
