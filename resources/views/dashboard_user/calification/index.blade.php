@extends('layouts.app1')

@section('page-title', trans('app.califications'))

@section('content')
    <!--CONTENEDOR DE CALIFICACIONES-->
    <!-- COMO POSTER-->
    <article class="bills grid">
        <!--TITULO-->
        <section class="bills-title">
            <h3>@lang('app.as_poster')</h3>
            <p>@lang('app.my_published_opportunities')</p>
        </section>

        <!--CALIFICACIONES-->
        <ul class="collapsible" data-collapsible="accordion">
            @foreach($poster as $sup)
                <li>
                    <div class="collapsible-header">
                        <!-- RESUMEN OPORTUNIDAD-->
                        <section class="opportunity-admin">
                            <!--DATOS DEL POST-->
                            <div class="item-activity">
                                <h5>@lang('app.active')</h5>
                                <h2>{{$sup->name}}</h2>
                                <h3>
                                    <?php
                                    $location = $sup->country->name.' / '.$sup->state->name;
                                    if($sup->city){
                                        $location .= ' / '.$sup->city->name;
                                    }
                                    ?>
                                    {{$location}}
                                </h3>
                                <p>@lang('app.published') | {{ $sup->created_at->diffForHumans() }}</p>
                            </div>

                            <!--RESUMEN DEL POST-->
                            <div class="item">


                            </div>
                        </section>
                    </div>

                    <div class="collapsible-body">
                        <!--COMENTARIO 1-->
                        <section class="comment">
                            <!--USUARIO-->
                            @foreach($sup->testimonials as $t)
                                <div class="comment-user">
                                    <figure>
                                        <img class="category-o tooltipped" src="/upload/categories/{{$t->recommended_by_user->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$t->recommended_by_user->company[0]->category->name}}">
                                    </figure>
                                    <div class="comment-user-datos">
                                        <h3>{{$t->recommended_by_user->code}}</h3>
                                        <h4>{{$t->recommended_by_user->company[0]->category->name}}</h4>
                                    </div>
                                </div>

                                <!--CALIFICACIONES Y COMENTARIO-->
                                <div class="comment-detail">
                                    <!--CALIFICACION-->
                                    <div class="qualification">
                                        <figure>
                                            <span class="icon-gTalents_stars-3 "></span>
                                            <span class="icon-gTalents_stars-3 @if($t->point<2) star-null @endif"></span>
                                            <span class="icon-gTalents_stars-3 @if($t->point<3) star-null @endif"></span>
                                            <span class="icon-gTalents_stars-3 @if($t->point<4) star-null @endif"></span>
                                            <span class="icon-gTalents_stars-3 @if($t->point<5) star-null @endif"></span>
                                        </figure>
                                        <p>{{$t->created_at->diffForHumans()}}</p>
                                    </div>

                                    <!--RESUMEN DE LA CALIFICACION-->
                                    <div class="comment-detail-resum">
                                        <p>
                                            {{$t->testimony}}
                                        </p>
                                    </div>

                                </div>
                            @endforeach
                        </section>
                    </div>
                </li>
            @endforeach
        </ul>
    </article>

    <!-- COMO SUPPLIER-->
    <article class="bills grid">
        <!--TITULO-->
        <section class="bills-title">
            <h3>@lang('app.as_supplier')</h3>
            <p>@lang('app.featured_candidates')</p>
        </section>

        <!--CALIFICACIONES-->
        <ul class="collapsible" data-collapsible="accordion">
            @foreach($supplier as $sup)
            <li>
                <div class="collapsible-header">
                    <!-- RESUMEN OPORTUNIDAD-->
                    <section class="opportunity-admin">
                        <!--DATOS DEL POST-->
                        <div class="item-activity">
                            <h5>@lang('app.active')</h5>
                            <h2>{{$sup->name}}</h2>
                            <h3>
                                <?php
                                $location = $sup->country->name.' / '.$sup->state->name;
                                if($sup->city){
                                    $location .= ' / '.$sup->city->name;
                                }
                                ?>
                                {{$location}}
                            </h3>
                            <p>@lang('app.published') | {{ $sup->created_at->diffForHumans() }}</p>
                        </div>

                        <!--RESUMEN DEL POST-->
                        <div class="item">
                            <!--VISITAS-->

                        </div>
                    </section>
                </div>

                <div class="collapsible-body">
                    <!--COMENTARIO 1-->
                    <section class="comment">
                        <!--USUARIO-->
                        @foreach($sup->testimonials as $t)
                        <div class="comment-user">
                            <figure>
                                <img class="category-o tooltipped" src="/upload/categories/{{$t->recommended_by_user->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$t->recommended_by_user->company[0]->category->name}}">
                            </figure>
                            <div class="comment-user-datos">
                                <h3>{{$t->recommended_by_user->code}}</h3>
                                <h4>{{$t->recommended_by_user->company[0]->category->name}}</h4>
                            </div>
                        </div>

                        <!--CALIFICACIONES Y COMENTARIO-->
                        <div class="comment-detail">
                            <!--CALIFICACION-->
                            <div class="qualification">
                                <figure>
                                    <span class="icon-gTalents_stars-3 "></span>
                                    <span class="icon-gTalents_stars-3 @if($t->point<2) star-null @endif"></span>
                                    <span class="icon-gTalents_stars-3 @if($t->point<3) star-null @endif"></span>
                                    <span class="icon-gTalents_stars-3 @if($t->point<4) star-null @endif"></span>
                                    <span class="icon-gTalents_stars-3 @if($t->point<5) star-null @endif"></span>
                                </figure>
                                <p>{{$t->created_at->diffForHumans()}}</p>
                            </div>

                            <!--RESUMEN DE LA CALIFICACION-->
                            <div class="comment-detail-resum">
                                <p>
                                    {{$t->testimony}}
                                </p>
                            </div>

                        </div>
                        @endforeach
                    </section>
                </div>
            </li>
            @endforeach
        </ul>
    </article>

    <!-- REGISTRO DE ACTIVIDADES-->
    <article class="credits grid">
        <!--TITULO DE LA SECCION-->
        <section class="credits-title">
            <h3>0 @lang('app.activity_records') </h3>
        </section>

        <!--LISTADO DE CREDITOS-->
        <ul class="credits-container">

        </ul>

<!--        <ul class="pagination">
            <li class="disabled">
                <a href="#!">
                    <span class="icon-gTalents_left"></span>
                </a>
            </li>
            <li class="active"><a href="#!">1</a></li>
            <li class="waves-effect"><a href="#!">2</a></li>
            <li class="waves-effect"><a href="#!">3</a></li>
            <li class="waves-effect"><a href="#!">4</a></li>
            <li class="waves-effect"><a href="#!">5</a></li>
            <li class="waves-effect">
                <a href="#!">
                    <span class="icon-gTalents_right"></span>
                </a>
            </li>
        </ul>-->
    </article>
@stop

@section('scripts')
   
@stop
