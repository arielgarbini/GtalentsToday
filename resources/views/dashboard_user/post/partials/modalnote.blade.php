<!--MODAL VER NOTAS DE CANDIDATOS-->
<div id="modalNota{{$candidate['id']}}" class="modal modal-userRegistered">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.candidate_profile')</h4>
    </div>

    <div class="modal-content">
        <!--TARJETA DEL CANDIDATO-->
        <div class="profile-colab">
            <section class="team-card">
                <!--PERSONA-->
                <div class="team-card-person">
                    <figure>
                        <span class="icon-gTalents_team-48"></span>
                    </figure>
                    <div class="datos">
                        <h3>{{$candidate['first_name'].' '.$candidate['last_name']}}</h3>
                        <p>{{substr($candidate['actual_position'], 0, 20)}}</p>
                    </div>
                </div>

                <!--DESCARGAR CV-->
                <div class="link">
                    <a href="#">
                        <span class="icon-gTalents_download"></span>
                    </a>
                </div>
            </section>

            <!--MENSAJE DEL SUPPLIER-->
            <div class="profile-colab-message">
                <h4>
                    <?php
                    echo \Vanguard\User::where('id', $candidate['supplier_user_id'])->get()->first()->code;
                    ?>
                    @lang('app.tell'):</h4>
                <p>
                   <?php
                    echo \Vanguard\VacancyCandidate::where('vacancy_id', $vacancy->id)
                        ->where('candidate_id', $candidate['id'])->get()->first()->comment
                    ?>
                </p>
            </div>
        </div>
        <form>
        <!--RESPUESTA-->
            <!--MENSJE-->
            <div class="itemForm icon-help">
                <label>@lang('app.your_answer')</label>
                <textarea name="" id="" cols="30" rows="10" placeholder="{{trans('app.your_answer')}}"></textarea>
            </div>

            <section class="buttonsMain">
                <!--REGRESAR-->
                <div class="item">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                        @lang('app.back')
                    </a>
                </div>

                <!--DESCARTAR-->
                <div class="item">
                    <form method="POST" action="{{route('vacancies.reject.candidate',$candidate['id'])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                        <button type="submit" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.discard')
                        </button>
                    </form>
                </div>

                <!--ACEPTAR-->
                <div class="item">
                    <form method="POST" action="{{route('vacancies.approbate.candidate',$candidate['id'])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                        <button type="submit" class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.accept')
                        </button>
                    </form>
                </div>
            </section>
        </form>

        <!--MENSAJE DE COLABORADOR CARGADO-->
        <!--<div class="messageModal">
            <figure>
                <span class="icon-gTalents_win-53"></span>
            </figure>
            <p>Mensaje enviado exitosamente</p>

            <div class="item">
                <a href="#!" class="btn-main">
                    @lang('app.continue')
                </a>
            </div>
        </div>-->
    </div>
</div>