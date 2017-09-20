<!--MODAL CALIFICAR SUPPLIER-->
<div id="modalCalificar{{$supplier->supplier_user_id}}" class="modal modal-userRegistered">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.rate_supplier')</h4>
    </div>

    <div class="modal-content">
        <!--TARJETA DEL CANDIDATO-->
        <form action="{{route('vacancies.qualify.supplier', $vacancy->id)}}" class="formLogin" method="post">
        <div class="profile-colab calificar-supplier">
            <section class="team-card">
                <!--RESUMEN SUPPLIER-->
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

                <p class="note" style="text-align: center">
                    @lang('app.he_offer') {{$supplier->supplier->candidates_offer($vacancy->id)}} @lang('app.candidates')
                </p>
            </section>

            <!--ESTRELLAS-->
            <div class="stars-feedback">
                <select id="stars1" name="rating" autocomplete="off">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>

        <!--RESPUESTA-->
            {{csrf_field()}}
            <input type="hidden" name="supplier" value="{{$supplier->supplier->id}}">
            <!--MENSJE-->
            <div class="itemForm icon-help">
                <label>@lang('app.what_is_your_opinion?')</label>
                <textarea name="opinion" id="" cols="30" rows="10" placeholder="{{trans('app.what_is_your_opinion?')}}"></textarea>
            </div>

            <section class="buttonsMain">
                <!--REGRESAR-->
                <div class="item">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                        @lang('app.back')
                    </a>
                </div>

                <!--INVITAR-->
                <div class="item">
                    <button type="submit" class="btn-main" type="submit" id="btn-modalMain">
                        @lang('app.qualify')
                    </button>
                </div>
            </section>
        </form>

        <!--MENSAJE DE COLABORADOR CARGADO-->
        <div class="messageModal">
            <figure>
                <span class="icon-gTalents_win-53"></span>
            </figure>
            <p>@lang('app.qualify_supplier')</p>

            <div class="item">
                <a href="#!" class="btn-main">
                    @lang('app.continue')
                </a>
            </div>
        </div>
    </div>
</div>