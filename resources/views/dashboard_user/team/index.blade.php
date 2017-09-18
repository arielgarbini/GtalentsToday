@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')
    <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDADES-->
        <section class="user-main-create credits">
            <!--TITULO DE LA SECCION-->
            <section class="credits-title">
                <h3>@lang('app.do_you_have') <strong>{{count($team)}} @lang('app.collaborators')</strong></h3>
            </section>

            <!--LISTADO DE COLABORADORES-->
            <ul class="supplier-container supplier-list">
                <!-- COLABORADOR 1 -->
                @foreach($team as $te)
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>
                        <div class="datos">
                            @if((strlen($te->user->first_name) + strlen($te->user->last_name)) > 15)
                                <h4>{{substr($te->user->first_name.' '.$te->user->last_name, 0, 15)}}...</h4>
                            @else
                                <h4>{{$te->user->first_name.' '.$te->user->last_name}}</h4>
                            @endif
                            @if(strlen($te->user->email) > 23)
                                <span>{{substr($te->user->email, 0, 23)}}...</span>
                            @else
                                <span>{{$te->user->email}}</span>
                            @endif
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
                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='{{$te->id}}'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>
                        <!-- Dropdown Structure -->
                        <ul id='{{$te->id}}' class='dropdown-content'>
                            <li><a href="#modalEditar{{$te->id}}">@lang('app.edit')</a></li>
                            <li><a href="#modalEliminar{{$te->id}}" class="modal-trigger waves-effect waves-light">@lang('app.delete')</a></li>
                        </ul>
                        @include('dashboard_user.team.partials.modaldelete')
                        @include('dashboard_user.team.partials.modaledit')

                    </div>
                </li>
                @endforeach
            </ul>

            <!--
            <ul class="pagination">
                <li class="disabled">
                    <a href="#!">
                        <span class="icon-gTalents_left"></span>
                    </a>
                </li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect">
                    <a href="#!">
                        <span class="icon-gTalents_right"></span>
                    </a>
                </li>
            </ul>-->
        </section>

        <!--NUEVO COLABORADOR - PUNTAJE-->
        <section class="user-main-contain">

            <!--BTN NUEVO COLABORADOR-->
            <div class="btn-section">
                <a href="#modalNewTeam" class="btn-main modal-trigger waves-effect waves-light">
                    @lang('app.new_collaborator')
                </a>
            </div>

            <!-- RANGO Y PUNTAJE -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.position_of_my_Profile')</h3>
                </section>

                <!--RANGO-->
                <section class="ranking">
                    <img class="category-o tooltipped" src="/upload/categories/{{Auth::user()->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{Auth::user()->company[0]->category->name}}">
                <!--<figure class="ranking-active">
                        <span class="icon-gTalents_rango-{{Auth::user()->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </figure>-->
                    <?php
                    $getCategories = \Vanguard\Category::where('id','>',Auth::user()->company[0]->category_id)->get();
                    $i = 0;
                    ?>
                    @foreach($getCategories as $rr)
                        <img class="category-u tooltipped" src="/upload/categories/{{$rr->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$rr->name}}">
                        <?php
                        $i++;
                        if($i==3){
                            break;
                        }
                        ?>
                    @endforeach
                    @for($i=1; $i<=3; $i++)
                        @if(Auth::user()->company[0]->category_id+$i <= 8)
                        <!--RANGO B -->
                        <!--
                            <figure>
                                <span class="icon-gTalents_rango-{{Auth::user()->company[0]->category_id+$i}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                            </figure>-->
                        @endif
                    @endfor
                </section>

                <!--RESUMEN-->
                <section class="position-resum">
                    <!--POSICION-->
                    <div class="item">
                        <h4>@lang('app.my_position')</h4>
                        <p><strong><?php echo Auth::user()->company[0]->category->name; ?></strong></p>
                    </div>

                    <div class="item">
                        <h4>@lang('app.my_points')</h4>
                        <p><strong><?php echo Auth::user()->company[0]->points->sum('sum'); ?>pts</strong></p>
                    </div>

                    <!--PUNTAJE-->
                    <div class="item">
                        <h4>@lang('app.i_lack')</h4>
                        <p><strong><a style="color:#f4511e;" href="#modalMembresias" class="modal-trigger waves-effect waves-light">{{ Auth::user()->company[0]->category->nextLevel() }}pts</a></strong> @lang('app.next_level')</p>
                    </div>
                </section>
            </div>
        </section>
    </article>

    @include('dashboard_user.modalmembership')
    <!--MODAL NUEVO COLABORADOR-->
    @include('dashboard_user.team.partials.modalcreate')

@stop

@section('scripts')
    <script>
        $("#formCreateCollaborator").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                level_of_access: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "{{trans('app.candidate_validate.first_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                },
                last_name: {
                    required: "{{trans('app.candidate_validate.last_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                },
                email: {
                    required: "{{trans('app.candidate_validate.email_required')}}",
                    email: "{{trans('app.candidate_validate.email_valid')}}"
                },
                level_of_access: {
                    required: "{{trans('app.collaborator_validate.level_required')}}",
                }
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

        $('.formCreateCollaborator').each(function () {
            $(this).validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3
                    },
                    last_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    level_of_access: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "{{trans('app.candidate_validate.first_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                    },
                    last_name: {
                        required: "{{trans('app.candidate_validate.last_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                    },
                    email: {
                        required: "{{trans('app.candidate_validate.email_required')}}",
                        email: "{{trans('app.candidate_validate.email_valid')}}"
                    },
                    level_of_access: {
                        required: "{{trans('app.collaborator_validate.level_required')}}",
                    }
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
        });
</script>
@stop
