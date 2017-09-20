<div class="panel panel-default">

    @if( isset($company->experience->sourcing_networks ) && count($company->experience->sourcing_networks) > 0)

        <div class="panel-body">
            <table class="table user-activity">
                <thead>
                    <tr>
                        <th>@lang('app.sourcing_network')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($company->experience->sourcing_networks as $sourcing_network)
                        <tr>
                            <td>{{ $sourcing_network->getNameLang($sourcing_network->id)->name }}</td>
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
                        <th>@lang('app.sourcing_network')</th>
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
