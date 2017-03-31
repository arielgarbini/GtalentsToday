<!--MODAL ELIMINAR-->
    <div id="modalEliminar{{$candidate->id}}" class="modal modal-userRegistered modal-fixed-footer">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.are_you_sure_delete_candidate')</h4>
        </div>

        <div class="modal-content">
            {!! Form::open(['method' => 'DELETE','route' => ['candidates.delete', $candidate->id],'style'=>'display:inline']) !!}
                <!--RESUMEN CANDIDATO-->
                <section class="colab">
                    <!--ICONO-->
                    <figure>
                        <span class="icon-gTalents_post icon-candd"></span>
                    </figure>

                    <div class="datos">
                        <h4>{{$candidate->first_name}} {{$candidate->last_name}}</h4>
                        <span>{{$candidate->email}}</span>
                    </div>
                </section>
                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.back')
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <button class="btn-main" type="submit" name="action">
                            @lang('app.delete')</button>
                    </div>
                </section>

            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.candidate_deleted')</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        @lang('app.continue')
                    </a>
                </div>
            </div>
        </div>
    </div>