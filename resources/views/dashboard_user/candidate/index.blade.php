@extends('layouts.app1')

@section('page-title', trans('app.post'))


@section('content')

<!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDADES-->
        <section class="user-main-create credits">
            <!--TITULO DE LA SECCION-->
            
            <section class="credits-title">
                <h3>Tienes <strong>{{count($candidates)}} Candidatos</strong></h3>
            </section> 
            @if (count($candidates))
            <!--LISTADO DE COLABORADORES-->
            <ul class="supplier-container supplier-list">
                <!-- CANDIDATO 1 -->
                @foreach ($candidates as $candidate)
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
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

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='{{$candidate->id}}'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id= '{{$candidate->id}}' class='dropdown-content'>
                            <li><a href="#modalEditar{{$candidate->id}}" class="modal-trigger waves-effect waves-light">Editar</a></li>
                            <li><a href="#modalEliminar{{$candidate->id}}" class="modal-trigger waves-effect waves-light">Eliminar</a></li>
                        </ul>
                        @include('dashboard_user.candidate.partials.modaldelete')
                        @include('dashboard_user.candidate.partials.modaledit')
                    </div>
                </li>
                @endforeach
            </ul>
            @endif
            
        </section>

        <!--NUEVO COLABORADOR - PUNTAJE-->
        <section class="user-main-contain">

            <!--BTN NUEVO COLABORADOR-->
            <div class="btn-section">
                <a href="#modalNewCandidato" class="btn-main modal-trigger waves-effect waves-light">
                    Nuevo Candidato
                </a>
            </div>

            <!-- RANGO Y PUNTAJE -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>Posición de mi Perfil</h3>
                </section>

                <!--RANGO-->
                <section class="ranking">
                    <!--RANGO A-->
                    <figure>
                        <span class="icon-gTalents_rango-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </figure>

                    <!--RANGO B -->
                    <figure>
                        <span class="icon-gTalents_rango-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                    </figure>

                    <!--RANGO C -->
                    <figure>
                        <span class="icon-gTalents_rango-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                    </figure>

                    <!--RANGO D -->
                    <figure class="ranking-active">
                        <span class="icon-gTalents_rango-8"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span></span>
                    </figure>
                </section>

                <!--RESUMEN-->
                <section class="position-resum">
                    <!--POSICION-->
                    <div class="item">
                        <h4>Mi Posición</h4>
                        <p><strong>Recruiting Rockstar</strong></p>
                    </div>

                    <!--PUNTAJE-->
                    <div class="item">
                        <h4>Me faltan</h4>
                        <p><strong>500pts</strong> para el próximo nivel</p>
                    </div>
                </section>
            </div>
        </section>
    </article>

    <!--MODAL NUEVO CANDIDATO-->
    @include('dashboard_user.candidate.partials.modalcreate')

@stop

@section('scripts')
    {!! HTML::script('assets/plugins/jquery-validation/jquery.validate.min.js') !!}
    {!! HTML::script('assets/plugins/jquery-validation/additional-methods.min.js') !!}
    {!! HTML::script('assets/plugins/jquery-validation/localization/messages_es.min.js') !!}
<script>
    $("#formEdit").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 4
                },
                last_name: {
                    required: true,
                    minlength: 4
                },
                email: {
                    required: true,
                },
                telf: {
                    required: true,
                },
                
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
              var placement = $(element).data('error');
              if (placement) {
                $(placement).append(error)
              } else {
                error.insertAfter(element);
              }
            }

        });

    $("#formCreate").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 4
                },
                last_name: {
                    required: true,
                    minlength: 4
                },
                email: {
                    required: true,
                },
                telf: {
                    required: true,
                },
                
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
              var placement = $(element).data('error');
              if (placement) {
                $(placement).append(error)
              } else {
                error.insertAfter(element);
              }
            }

    });



</script>
   
@stop
