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
