<div id="modalEditar{{$candidate->id}}" class="modal modal-userRegistered modal-fixed-footer"">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Editar Candidato</h4>
        </div>

        <div class="modal-content">
            {!! Form::model($candidate, ['route' => ['candidates.update', $candidate->id], 'method' => 'PUT', 'class' => 'formLogin', 'id' => 'formEdit',]) !!}
               @include('dashboard_user.candidate.partials.fields')               
                <section class="buttonsMain">
                    
                    <div class="item">
                        <a href="#" class="modal-action modal-close waves-effect btn-return">
                        Regresar</a>
                    </div>
                    <div class="item">
                        <button class="btn-main" type="submit" name="action">
                      Editar</button>
                    </div>

                </section>
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Candidato editado exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
            
        </div>
    </div>