@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

  <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDAD-->
        <section class="user-main-create credits jobs-detail">
            <!--TITULO-->
            <div class="jobs-detail-title">
                <h3>{{$vacancy->name}}</h3>
                <p>{{$vacancy->location}} | {{$vacancy->contract_type->name}}</p>
            </div>

            <!--CUERPO DE LA DESCRIPCION-->
            <div class="jobs-detail-body">
                <!--DESCRIPCION DE LA EMPRESA-->
                <h4>{{trans('app.description_company')}}</h4>
                <p>@if($companies) {{$companies->name}} @else {{trans('app.independent')}} @endif </p>

                <!--DESCRIPCION DEL TRABAJO-->
                <h4>{{trans('app.work_description')}}</h4>
                <p>{{$vacancy->target_companies}}</p>

                <!--EXPERIENCIA DESEADA-->
                <h4>{{trans('app.desired_experience')}}</h4>
                <ul class="jobs-detail-body-kills">
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>{{$vacancy->required_experience}}</p>
                    </li>
                  <!--  <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: .NET Framework 3.0 / 4.0 (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Bases de Datos: MS SQL Server u ORACLE (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: ASP.NET MVC (Deseable)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: Java Script (Deseable)</p>
                    </li>-->
                </ul>
                <!--INFORMACION ADICIONAL-->
                <h4>{{trans('app.additional_information')}}</h4>
                <p><span style="color:red">Este campo no esta reflejado al crear Nuevo Post</span></p>

                <!--HORARIO DE TRABAJO-->
                <h4>{{trans('app.working_hours')}}</h4>
                <p><span style="color:red">Este campo no esta reflejado al crear Nuevo Post</span></p>

                <!--UBICACION-->
                <h4>{{trans('app.location')}}</h4>
                <p>{{$vacancy->location}}</p>

                <!--TIPO DE CONTRATACION-->
                <h4>{{trans('app.contract_type')}}</h4>
                <p>{{$vacancy->contract_type->name}}</p>

                <!--ESPECIALIZACION-->
                <h4>{{trans('app.especialization')}}</h4>
                <p>Diseño, Programación Frontend.</p>

                <!--AÑOS DE EXPERIENCIA-->
                <h4>{{trans('app.experience_years')}}</h4>
                <p>{{$vacancy->years_experience}}</p>

                <!--IDIOMAS-->
                <h4>{{trans('app.languages')}}</h4>
                <p>Español.</p>

                <!--RANGO SALARIAL-->
                <h4>{{trans('app.range_salary')}}</h4>
                <p>{{$vacancy->range_salary}}</p>

                <!--HONORARIO COBRADO AL EMPLEADOR-->
                <h4>{{trans('app.employer_fee')}}</h4>
                <p>23% - Fijo.</p>

                <!--PERIODO DE REEMPLAZO-->
                <h4>{{trans('app.replacement_period')}}</h4>
                <p>{{$vacancy->replacement_period}}</p>

                <!--LINK DESCARGA-->
                <div class="link">
                    <a href="#">
                        <figure>
                            <span class="icon-gTalents_pdf"></span>
                        </figure>
                        <p>Descripción del puesto</p>
                    </a>
                </div>

                <!--RESUMEN-->
                <ul class="jobs-detail-body-resum">
                    <!--FACTURACION APROXIMADA-->
                    <li>
                        <figure class="icon-verde">
                            <span class="icon-gTalents_billetes"></span>
                        </figure>
                        <div class="datos">
                            <h4>$350</h4>
                            <p>Facturación total aproximada</p>
                        </div>
                    </li>

                    <!--COMISION DEL SUPPLIER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>20% de Comisión</h4>
                            <p>Comisión del Supplier</p>
                        </div>
                    </li>

                    <!--COMISION DEL POSTER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>5% de Comisión</h4>
                            <p>Comisión del Poster</p>
                        </div>
                    </li>

                    <!--COMPENSACION DE LA POSICION-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_stars"></span>
                        </figure>
                        <div class="datos">
                            <h4>1.500 puntos</h4>
                            <p>Compensación de la posición</p>
                        </div>
                    </li>

                    <!--TUS GARANTIAS-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_help"></span>
                        </figure>
                        <div class="datos">
                            <h4>Tus Garantias</h4>
                            <p>Velamos por ti</p>
                        </div>
                    </li>

                    <!--COMISION GTALENTS-->
                    <li>
                        <figure>
                            <span class="icon-gTalents_isotipo"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                        </figure>
                        <div class="datos">
                            <h4>30% de Comisión</h4>
                            <p>Comisión de gTalents</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!--INTERESADO - OFERTAS SIMILARES-->
        <section class="user-main-contain">

            <!--BTN NUEVO COLABORADOR-->
            <div class="btn-section">
                <a href="#modalParticipar" class="btn-main modal-trigger waves-effect waves-light">
                    Estoy Interesado
                </a>
            </div>

            <!-- RESUMEN -->
            <div class="bills">
                <div class="resum-position">
                    <!--COMISION-->
                    <div class="item">
                        <figure>
                            <span class="icon-gTalents_billetes"></span>
                        </figure>
                        <div class="datos">
                            <h4>30% de Comisión</h4>
                            <p>Si cierras la posición</p>
                        </div>
                    </div>

                    <!--GARANTIAS-->
                    <div class="item">
                        <figure>
                            <span class="icon-gTalents_help"></span>
                        </figure>
                        <div class="datos">
                            <h4>Tus Garantias</h4>
                            <p>Velamos por ti</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OFERTAS SIMILARES -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>Ofertas Similares</h3>
                </section>

                <!--RANGO-->
                <ul class="post-list">
                    <!--OFERTA 1-->
                    <li>
                        <a href="#" class="link-listado">
                            <!-- RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Desarrollador .NET</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>

                    <!--OFERTA 2-->
                    <li>
                        <a href="#" class="link-listado">
                            <!-- RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Desarrollador .NET</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>

                    <!--OFERTA 3-->
                    <li>
                        <a href="#" class="link-listado">
                            <!-- RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Desarrollador .NET</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>
                </ul>
            </div>      
        </section>
    </article>


    <!--MODAL PARTICIPAR-->
    <div id="modalParticipar" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>¿Deseas Participar?</h4>
        </div>

        <div class="modal-content">
            <form action="" class="formLogin">
                <!--RESUMEN SUPPLIER-->
                <div class="profile-colab profile-supplier">
                    <!--RESUMEN 1-->
                    <div class="profile-colab-message">
                        <p>Al participar en esta oportunidad podrás conversar con el Poster de forma directa, oferle los candidatos necesarios y aumentar tu reputación y beneficios.</p>
                    </div>
                </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <a href="{{route('vacancies.post_supplier',$vacancy->id)}}" class="btn-main" type="submit" id="btn-modalMain">
                            Participar
                        </a>
                    </div>
                </section>              
            </form>

            <!--MENSAJE DE PARTICIPACION-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Solicitud enviada, pronto te notificaremos tu aceptación por parte del Poster</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
   
@stop
