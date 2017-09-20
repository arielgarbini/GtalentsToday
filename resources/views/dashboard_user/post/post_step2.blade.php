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
            <h3>@lang('app.we_recommend_you')</h3>
        </div>

        <ul class="supplier-recommended-container">
            <!--SUPPLIER 1-->
            @foreach($supliers_recommended as $supplier)
            <li>
                <!--MODAL-->
                <div class="link-modal">
                    <a href="#modalProfileSupplier{{$supplier->id}}" class="modal-trigger waves-effect waves-light">
                        <span class="icon-gTalents_profile"></span>
                    </a>
                </div>

                <!--RANGO-->
                <figure class="supplierContain1-ranking">
                    <img class="category-p tooltipped" src="/upload/categories/{{$supplier->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$supplier->company[0]->category->name}}">
                </figure>

                <!--DATOS-->
                <div class="datos">
                    <h3>{{$supplier->code}}</h3>
                    <p>{{$supplier->company[0]->category->name}}</p>
                </div>

                <!--LINK INVITAR-->
                <div class="link">
                    <form method="POST" action="{{route('vacancies.invited.supplier', $vacancy_id)}}">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$supplier->id}}" name="supplier">
                        <input type="hidden" value="1" name="view">
                        <a href="#" class="send_form">
                            <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                        </a>
                    </form>
                </div>
                @include('dashboard_user.post.partials.modalsupplier')
            </li>
            @endforeach
        </ul>
    </section>

@stop

@section('scripts')
@stop
