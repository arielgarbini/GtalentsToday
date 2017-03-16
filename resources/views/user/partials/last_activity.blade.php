<div class="panel panel-default">
    @if( !($user->hasRole('Consultant')) And !($user->hasRole('Consultant Unverified')))
        <div class="panel-heading">
            @lang('app.latest_activity')
            <div class="pull-right">
                <a href="{{ route('activity.user', $user->id) }}" class="edit"
                   data-toggle="tooltip" data-placement="top" title="@lang('app.complete_activity_log')">
                    @lang('app.view_all')
                </a>
            </div>
        </div>
    @endif
    <div class="panel-body">
        <table class="table user-activity">
            <thead>
                <tr>
                    <th>@lang('app.action')</th>
                    <th>
                        @lang('app.date')

                        @if( $user->hasRole('Consultant') Or $user->hasRole('Consultant Unverified'))
                        <div class="pull-right">
                            <a href="{{ route('activity.user', $user->id) }}" class="edit"
                               data-toggle="tooltip" data-placement="top" title="@lang('app.complete_activity_log')">
                                @lang('app.view_all')
                            </a>
                        </div>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($userActivities as $activity)
                    <tr>
                        <td>{{ $activity->description }}</td>
                        <td>{{ $activity->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
