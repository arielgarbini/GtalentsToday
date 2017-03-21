@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content') 
<!--DETALLES - CONTAINER-->
        <!--CREAR NUEVO POST-->
    <article class="newPost grid">
        <!--ENCABEZADO ICONOS-->
        <section class="newPost-legend">
            <!--CREAR-->
            <div class="item" id="indi-create">
                <figure>
                    <span class="icon-gTalents_crear" ><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </figure>
                <p>@lang('app.create')</p>
            </div>

            <!--DETALLES-->
            <div class="item " id="indi-detail">
                <figure>
                    <span class="icon-gTalents_detalles "><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                </figure>
                <p>@lang('app.details')</p>
            </div>

            <!--EMPEZAR-->
            <div class="item active" id="indi-go">
                <figure>
                    <span class="icon-gTalents_empezar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                </figure>
                <p>@lang('app.start')</p>
            </div>
        </section>
   <!--EMPEZAR - CONTAINER -->
    <section class="newPost-container" id="go-container pagination-on">
        <!--MENSAJE FINAL-->
        <div class="messageWin">
            <figure>
                <span class="icon-gTalents_win-2"></span>
            </figure>
            <p>@lang('app.you_have_created_a_new_opportunity')</p>

            <div class="btn-container">
                <!--NEXT-->
                <div class="item">
                    <a href="{{route('vacancies.show',$vacancy_id)}}" class="btn-main">@lang('app.see_opportunity')</a>
                </div>
            </div>
        </div>
    </section>
</article>
    <!-- RECOMENDACION SUPPLIER-->
    <!--<section class="supplier-recommended grid" id="go-container">-->
    <section class="supplier-recommended grid">
        <!--TITULO DE LA SECCION-->
        <div class="supplier-recommended-title">
            <h3>Te recomendamos estos Suppliers</h3>
        </div>

        <ul class="supplier-recommended-container">
            <!--SUPPLIER 1-->
            <li>
                <!--MODAL-->
                <div class="link-modal">
                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <!--RANGO-->
                <figure>
                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                </figure>

                <!--DATOS-->
                <div class="datos">
                    <h3>UFA-896</h3>
                    <p>Newbie</p>
                </div>

                <!--LINK INVITAR-->
                <div class="link">
                    <a href="" class="btn-main">Invitar</a>
                </div>
            </li>

            <!--SUPPLIER 2-->
            <li>
                <!--MODAL-->
                <div class="link-modal">
                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <!--RANGO-->
                <figure>
                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                </figure>

                <!--DATOS-->
                <div class="datos">
                    <h3>UFA-896</h3>
                    <p>Newbie</p>
                </div>

                <!--LINK INVITAR-->
                <div class="link">
                    <a href="" class="btn-main">Invitar</a>
                </div>
            </li>

            <!--SUPPLIER 3-->
            <li>
                <!--MODAL-->
                <div class="link-modal">
                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <!--RANGO-->
                <figure>
                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                </figure>

                <!--DATOS-->
                <div class="datos">
                    <h3>UFA-896</h3>
                    <p>Newbie</p>
                </div>

                <!--LINK INVITAR-->
                <div class="link">
                    <a href="" class="btn-main">Invitar</a>
                </div>
            </li>

            <!--SUPPLIER 4-->
            <li>
                <!--MODAL-->
                <div class="link-modal">
                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <!--RANGO-->
                <figure>
                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                </figure>

                <!--DATOS-->
                <div class="datos">
                    <h3>UFA-896</h3>
                    <p>Newbie</p>
                </div>

                <!--LINK INVITAR-->
                <div class="link">
                    <a href="" class="btn-main">Invitar</a>
                </div>
            </li>
        </ul>
    </section>

@stop

@section('scripts')
@stop
