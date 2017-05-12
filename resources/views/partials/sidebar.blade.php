<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-avatar">
                <div class="dropdown">
                    <div>
                        <img alt="image" class="img-circle" width="100" src="{{ Auth::user()->present()->avatar }}">
                    </div>
                    <div class="name"><strong>{{ Auth::user()->present()->nameOrEmail }}</strong></div>
                </div>
            </li>
            <li class="{{ Request::is('/') ? 'active open' : ''  }}">
                <a href="{{ route('dashboard') }}" class="{{ Request::is('/') ? 'active' : ''  }}">
                    <i class="fa fa-dashboard fa-fw"></i> @lang('app.dashboard')
                </a>
            </li>

            @permission('candidates.manage')
                <li class="{{ Request::is('candidates*') ? 'active open' : ''  }}">
                    <a href="{{ route ('candidates.index.admin')}}" class="{{ Request::is('candidates*') ? 'active' : ''  }}">
                        <i class="fa fa-list-alt fa-fw"></i> @lang('app.candidates')
                    </a>
                </li>

            @endpermission

            @permission('categories.manage')
                <li class="{{ Request::is('categories*') ? 'active open' : ''  }}">
                    <a href="{{ route ('categories.index')}}" class="{{ Request::is('categories*') ? 'active' : ''  }}">
                        <i class="fa fa-cubes fa-fw"></i> @lang('app.categories')
                    </a>
                </li>

            @endpermission

            @permission('companies.manage')
<!-- ====Modificado por Keyla Rodriguez 02/11/2016-->      
                <li class="{{ Request::is('companies*') ? 'active open' : ''  }}">
                    <a href="{{ route ('companies.index')}}" class="{{ Request::is('companies*') ? 'active' : ''  }}">
                        <i class="fa fa-cogs fa-fw"></i> {{ Auth::user()->hasRole('AdminConsultant') ? trans('app.company') : trans('app.companies') }}
                    </a>
                </li>
<!-- ===================================== -->
            @endpermission
     
                <li class="{{ Request::is('messages*') ? 'active open' : ''  }}">
                    <a href="{{ route('messages.index') }}" class="{{ Request::is('messages*') ? 'active' : ''  }}">
                        <i class="fa fa-cogs fa-envelope"></i> @lang('app.messages')
                    </a>
                </li>

            @permission('news.manage')
                <li class="{{ Request::is('news*') ? 'active open' : ''  }}">
                    <a href="{{ route('news.index') }}" class="{{ Request::is('news*') ? 'active' : ''  }}">
                        <i class="fa fa-list-alt fa-fw"></i> @lang('app.news')
                    </a>
                </li>
            @endpermission

            @permission('users.activity')
                <li class="{{ Request::is('activity*') ? 'active open' : ''  }}">
                    <a href="{{ route('activity.index') }}" class="{{ Request::is('activity*') ? 'active' : ''  }}">
                        <i class="fa fa-list-alt fa-fw"></i> @lang('app.activity_log')
                    </a>
                </li>
            @endpermission

            @permission(['roles.manage', 'permissions.manage'])
                <li class="{{ Request::is('role*') || Request::is('permission*') ? 'active open' : ''  }}">
                    <a href="#">
                        <i class="fa fa-user fa-fw"></i>
                        @lang('app.roles_and_permissions')
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        @permission('roles.manage')
                            <li>
                                <a href="{{ route('role.index') }}" class="{{ Request::is('role*') ? 'active' : ''  }}">
                                    @lang('app.roles')
                                </a>
                            </li>
                        @endpermission
                        @permission('permissions.manage')
                            <li>
                                <a href="{{ route('permission.index') }}"
                                   class="{{ Request::is('permission*') ? 'active' : ''  }}">@lang('app.permissions')</a>
                            </li>
                        @endpermission
                    </ul>
                </li>
            @endpermission

            @permission('users.manage')
                <li class="{{ Request::is('user*') ? 'active open' : ''  }}">
                    <a href="{{ route('user.index') }}" class="{{ Request::is('user*') ? 'active' : ''  }}">
                        <i class="fa fa-users fa-fw"></i> @lang('app.users')
                    </a>
                </li>
            @endpermission
            
            @permission('vacancies.view')
                <li class="{{ Request::is('vacancies*') ? 'active open' : ''  }}">
                    <a href="{{ route ('vacancies.index')}}" class="{{ Request::is('vacancies*') ? 'active' : ''  }}">
                        <i class="fa fa-list-alt fa-fw"></i> @lang('app.vacancies')
                    </a>
                </li>

            @endpermission


            <li class="{{ Request::is('invoices*') ? 'active open' : ''  }}">
                <a href="{{ route ('invoices.list')}}" class="{{ Request::is('invoices*') ? 'active' : ''  }}">
                    <i class="fa fa-list-alt fa-fw"></i> @lang('app.invoices')
                </a>
            </li>

            @permission(['settings.general', 'settings.auth', 'settings.notifications'])
            <li class="{{ Request::is('settings*') ? 'active open' : ''  }}">
                <a href="#">
                    <i class="fa fa-gear fa-fw"></i> @lang('app.settings')
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    @permission('settings.general')
                        <li>
                            <a href="{{ route('settings.general') }}"
                               class="{{ Request::is('settings') ? 'active' : ''  }}">
                                @lang('app.general')
                            </a>
                        </li>
                    @endpermission
                    @permission('settings.auth')
                        <li>
                            <a href="{{ route('settings.auth') }}"
                               class="{{ Request::is('settings/auth*') ? 'active' : ''  }}">
                                @lang('app.auth_and_registration')
                            </a>
                        </li>
                    @endpermission
                    @permission('settings.notifications')
                        <li>
                            <a href="{{ route('settings.notifications') }}"
                               class="{{ Request::is('settings/notifications*') ? 'active' : ''  }}">
                                @lang('app.notifications')
                            </a>
                        </li>
                    @endpermission
                </ul>
            </li>
            @endpermission
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>