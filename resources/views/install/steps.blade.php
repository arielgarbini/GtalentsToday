<div class="steps">
    <ul>
        <li>
            <a class="{{ isset($steps['welcome']) ? $steps['welcome'] : '' }}">
                <div class="stepNumber"><i class="fa fa-home"></i></div>
                <span class="stepDesc text-small">@lang('app.welcome')</span>
            </a>
        </li>
        <li>
            <a class="{{ isset($steps['requirements']) ? $steps['requirements'] : '' }}">
                <div class="stepNumber"><i class="fa fa-list"></i></div>
                <span class="stepDesc text-small">@lang('app.system_requirements')</span>
            </a>
        </li>
        <li>
            <a class="{{ isset($steps['permissions']) ? $steps['permissions'] : '' }}">
                <div class="stepNumber"><i class="fa fa-lock"></i></div>
                <span class="stepDesc text-small">@lang('app.permissions')</span>
            </a>
        </li>
        <li>
            <a class="{{ isset($steps['database']) ? $steps['database'] : '' }}">
                <div class="stepNumber"><i class="fa fa-database"></i></div>
                <span class="stepDesc text-small">@lang('app.database_info')</span>
            </a>
        </li>
        <li>
            <a class="{{ isset($steps['installation']) ? $steps['installation'] : '' }}">
                <div class="stepNumber"><i class="fa fa-terminal"></i></div>
                <span class="stepDesc text-small">@lang('app.installation')</span>
            </a>
        </li>
        <li>
            <a class="{{ isset($steps['complete']) ? $steps['complete'] : '' }}">
                <div class="stepNumber"><i class="fa fa-flag-checkered"></i></div>
                <span class="stepDesc text-small">@lang('app.complete')</span>
            </a>
        </li>
    </ul>
</div>
