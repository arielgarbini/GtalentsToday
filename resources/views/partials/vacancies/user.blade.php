@foreach ($vacancies_users as $vacancy_opportunity)
    <!--POST SUPPLIER -->
    <li>
        <a href="{{route('vacancies.post_user',$vacancy_opportunity->id)}}" class="link-listado">
            <!--RESUMEN OPORTUNIDAD-->
            <section class="opportunity-admin">
                <!--DATOS DEL POST-->
                <div class="item-activity">
                    <h5>@lang('app.active')</h5>
                    <h2>{{$vacancy_opportunity->name}}</h2>
                    <h3>{{substr($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name, 0, 25)}} @if(strlen($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name)>25) ... @endif</h3>
                    <p>@lang('app.published') | {{ $vacancy_opportunity->created_at->diffForHumans() }}</p>

                    <!--SECCIONES TOOLTIPS-->
                    <div class="item-activity-leyend">


                        <!--FACTURACION APROXIMADA-->
                        <?php
                        try{
                            preg_match_all('/\d{1,2}/' ,$vacancy_opportunity->range_salary, $matches);
                            $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                            $factur = number_format($factur, 2, '.', ',');
                        } catch(\exception $e){
                            $factur = '';
                        }
                        ?>
                        <div class="item">
                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{trans('app.approximate_billing')}}: ${{$factur}}">
                                <span class="icon-gTalents_facturacion"></span>
                            </a>
                        </div>
                        <!--CANTIDAD DE SUPPLIERS-->
                        <div class="item">
                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{count($vacancy_opportunity->activeSuppliers())}} Suppliers">
                                <span class="icon-gTalents_comision"></span>
                            </a>
                        </div>

                        <!--CONTIGENCY O RETAINED-->
                        <div class="item">
                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="@if($vacancy_opportunity->search_type==1) {{trans('app.contingency')}} @else {{trans('app.retained')}} @endif">
                                <span class="icon-gTalents_estado-post"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <!--RESUMEN DEL POST-->
                <div class="item">
                    <!--VISITAS-->
                    <div class="item-option">
                        <h4><?php echo $viewed->search(['vacancy_id' => $vacancy_opportunity->id])->count() ?></h4>
                        <span class="opt-sm">@lang('app.visits')</span>
                    </div>

                    <!--CANDIDATOS-->
                    <div class="item-option">
                        <h4>{{$vacancy_opportunity->countCandidatesByStatus('Active')}}</h4>
                        <span class="opt-sm">@lang('app.candidates')</span>
                    </div>

                    <!--POR ACEPTAR-->
                    <div class="item-option">
                        <h4>{{$vacancy_opportunity->countCandidatesByStatus('Unconfirmed')}}</h4>
                        <span class="opt-sm">@lang('app.to_be_accepted')</span>
                    </div>
                </div>
            </section>
        </a>
    </li>

@endforeach