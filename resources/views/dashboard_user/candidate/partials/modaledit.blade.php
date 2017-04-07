<div id="modalEditar{{$candidate['id']}}" class="modal modal-userRegistered modal-fixed-footer"">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.edit_candidate')</h4>
        </div>

        <div class="modal-content">
            {!! Form::model($candidate, ['route' => ['candidates.update', $candidate['id']], 'method' => 'PUT', 'class' => 'formCreate', 'id' => 'formEdit', 'enctype' => 'multipart/form-data']) !!}
               @include('dashboard_user.candidate.partials.fields')               
                <section class="buttonsMain">
                    <div class="item">
                        <a href="#" class="modal-action modal-close waves-effect btn-return">
                            @lang('app.back')
                        </a>
                    </div>
                    <div class="item">
                        <button class="btn-main" type="submit" name="action">
                            @lang('app.edit')
                        </button>
                    </div>
                </section>
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.candidate_updated_successfully')</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        @lang('app.continue')
                    </a>
                </div>
            </div>
            {!! Form::close() !!}
            
        </div>
    </div>