<!--MODAL PERFIL SUPPLIER-->
<div id="modalProfileSupplierIn{{$supplier->supplier_user_id}}" class="modal modal-userRegistered">
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
                    <span class="icon-gTalents_rango-{{$supplier->supplier->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                </figure>

                <div class="datos">
                    <h4>{{$supplier->supplier->code}}</h4>
                    <p>{{$supplier->supplier->company[0]->category->name}}</p>
                </div>
            </section>

            <!--PROMEDIO CALIFICACIONES-->
            <div class="qualification">
                <?php
                $avg = \Vanguard\Testimonial::where('recommended_user_id', $supplier->supplier_user_id)->where('type','supplier')->avg('point');
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
                <p>{{count($supplier->supplier->vacancy_users)}} @lang('app.jobs_opportunities')</p>
            </div>

            <!--RESUMEN 2-->
            <div class="profile-colab-message">
                <h4>@lang('app.percentaje_candidates'):</h4>
                <p>{{$supplier->supplier->candidates_accepted()}}%</p>
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