<!--MODAL ELIMINAR-->
<div id="modalEliminar<?php if(isset($modal)){ echo $modal; }else{ echo $te->id; } ?>" class="modal modal-userRegistered modal-fixed-footer">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.are_you_sure_you_want_to_delete')</h4>
    </div>

    <div class="modal-content">
    {!! Form::open(['method' => 'DELETE','route' => ['team.delete', $te->id],'style'=>'display:inline']) !!}

            <!--RESUMEN COLABORADOR-->
            <section class="colab">
                <!--ICONO-->
                <figure>
                    <span class="icon-gTalents_team-48"></span>
                </figure>

                <div class="datos">
                    <h4>{{$te->user->first_name}} {{$te->user->last_name}}</h4>
                    <span>{{$te->user->email}}</span>
                    <p>
                        @if($te->is_active)
                            @lang('app.active')
                        @else
                            @lang('app.inactive')
                        @endif
                        -
                        @if($te->position == 1)
                            @lang('app.administrator')
                        @elseif($te->position == 2)
                            @lang('app.User')
                        @endif
                    </p>
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
                    <button class="btn-main" type="submit" id="btn-modalMain">
                        @lang('app.delete')
                    </button>
                </div>
            </section>
        </form>

    </div>
</div>