@foreach ($latestVacancies as $vacancy)
    <!--POST 1 -->
    <li>
        <a href="{{route('vacancies.show',$vacancy->id)}}" class="link-listado">
            <!-- RESUMEN OPORTUNIDAD-->
            <section class="opportunity-admin">
                <!--DATOS DEL POST-->
                <div class="item-activity">
                    @if(($vacancy->vacancy_status_id ==2 ) || ($vacancy->vacancy_status_id ==6 ) || ($vacancy->vacancy_status_id ==4 ) || ($vacancy->vacancy_status_id ==8 ))
                        <p>{{trans('app.status')}}:  <span class="label label-{{ $vacancy->vacancy_status_id == 1 ? 'success':'warning' }}">
                                                {{ $vacancy->vacancy_status->getNameLang($vacancy->vacancy_status_id)->name }}
                                            </span></p>
                    @else
                        <select class="change-status browser-default" value="{{$vacancy->id}}">
                            <option value="" disabled>@lang('app.choose_an_option')</option>
                            <option value="1" selected>@lang('app.published')</option>
                            <option value="2">@lang('app.paused')</option>
                            <option value="4">@lang('app.close')</option>
                            <option value="edit">@lang('app.edit')</option>
                        </select>
                    @endif
                    <h2>{{$vacancy->name}}</h2>
                    <h3>{{substr($vacancy->locat->country->name.' | '.$vacancy->locat->name, 0, 25)}} @if(strlen($vacancy->locat->country->name.' | '.$vacancy->locat->name)>25) ... @endif</h3>
                    <p>@lang('app.published') | {{ $vacancy->created_at->diffForHumans() }}</p>
                    <h3>@if($vacancy->search_type==1) {{trans('app.contingency')}} @else {{trans('app.retained')}} @endif</h3>
                </div>

                <!--RESUMEN DEL POST-->
                <div class="item">
                    <!--VISITAS-->
                    <div class="item-option">
                        <h5 class="h4Bold">{{count($vacancy->activeSuppliers())}}</h5>
                        <span class="opt-sm">Suppliers</span>
                    </div>

                    <!--CANDIDATOS-->
                    <div class="item-option">
                        <h5 class="h4Bold">{{$vacancy->countCandidatesByStatus('Active')}}</h5>
                        <span class="opt-sm">@lang('app.candidates')</span>
                    </div>

                    <!--POR ACEPTAR-->
                    <div class="item-option">
                        <h5 class="h4Bold">{{$vacancy->countCandidatesByStatus('Unconfirmed')}}</h5>
                        <span class="opt-sm">@lang('app.to_be_accepted')</span>
                    </div>
                </div>
            </section>
        </a>
    </li>
@endforeach