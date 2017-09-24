<!--MODAL PERFIL SUPPLIER-->
<div id="modalProfileSupplier{{$supplier->id}}" class="modal modal-userRegistered">
    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.supplier_profile')</h4>
    </div>

    <div class="modal-content">

        <!--RESUMEN SUPPLIER-->
        <div class="profile-colab profile-supplier">
            <section class="supplierContain1">
                <!--ICONO RANGO-->

                <figure class="supplierContain1-ranking">
                    <img class="category-o tooltipped" src="/upload/categories/{{$supplier->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$supplier->company[0]->category->name}}">
                </figure>

                <div class="datos">
                    <h4>{{$supplier->code}}</h4>
                    <p>{{$supplier->company[0]->category->name}}</p>
                </div>
            </section>

            <!--PROMEDIO CALIFICACIONES-->
            <div class="qualification">
                <?php
                $avg = \Vanguard\Testimonial::where('recommended_user_id', $supplier->id)->where('type','supplier')->avg('point');
                ?>
                <figure>
                    <span class="icon-gTalents_stars-3"></span>
                    <span class="icon-gTalents_stars-3 @if(intval($avg) < 2) star-null @endif"></span>
                    <span class="icon-gTalents_stars-3 @if(intval($avg) < 3) star-null @endif"></span>
                    <span class="icon-gTalents_stars-3 @if(intval($avg) < 4) star-null @endif"></span>
                    <span class="icon-gTalents_stars-3 @if(intval($avg) < 5) star-null @endif"></span>
                </figure>
            </div>

            <!--RESUMEN 1-->
            <div class="profile-colab-message">
                <h4>@lang('app.has_particitate_in'):</h4>
                <p>{{count($supplier->vacancy_users)}} @lang('app.jobs_opportunities')</p>
            </div>

            <!--RESUMEN 2-->
            <div class="profile-colab-message">
                <h4>@lang('app.percentaje_candidates'):</h4>
                <p>{{$supplier->candidates_accepted()}}%</p>
            </div>
        </div>


        <!--BTN-MAIN-->
        <!--
        <section class="buttonsMain">
        <div class="item-btn">
            <a href="#!" class="btn-main">
                @lang('app.continue')
            </a>
        </div>
        </section>-->
    </div>
</div>