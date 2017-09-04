@extends('layouts.app1')

@section('page-title', trans('app.candidates'))

@section('content')

<!--CONTENEDOR INDEX REGISTRADO-->
<style>
    .country-list{
        width: 400px !important;
    }
    .intl-tel-input{
        width: 100% !important;
    }
</style>
    <article class="user-main grid">
        <!--OPORTUNIDADES-->
        <section class="user-main-create credits">
            <!--TITULO DE LA SECCION-->
            
            <section class="credits-title">
                <h3>@lang('app.do_you_have') <strong>{{count($candidates)}} @lang('app.candidates')</strong></h3>
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
                            @if((strlen($candidate['first_name']) + strlen($candidate['last_name'])) > 15)
                                <?php $name = $candidate['first_name'].' '.$candidate['last_name'] ?>
                                    <h4>{{substr($name, 0, 15)}}...</h4>
                            @else
                                <h4>{{$candidate['first_name']}} {{$candidate['last_name']}}</h4>
                            @endif
                            @if(strlen($candidate['email']) > 15)
                                <span>{{substr($candidate['email'], 0, 15)}}...</span>
                            @else
                                <span>{{$candidate['email']}}</span>
                            @endif
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='{{$candidate['id']}}'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id= '{{$candidate['id']}}' class='dropdown-content'>
                            <li><a href="#modalEditar{{$candidate['id']}}" class="modal-trigger waves-effect waves-light">@lang('app.edit')</a></li>
                            <li><a href="#modalEliminar{{$candidate['id']}}" class="modal-trigger waves-effect waves-light">@lang('app.delete')</a></li>
                        </ul>
                        <?php
                            $dataFile = 'update-'.$candidate['id'];
                            $cand = $candidate['id'];
                        ?>
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
                    @lang('app.new_candidate')
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
                    <img class="category-o" src="/upload/categories/{{Auth::user()->company[0]->category->avatar}}">
                <!--<figure class="ranking-active">
                        <span class="icon-gTalents_rango-{{Auth::user()->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </figure>-->
                    <?php
                    $getCategories = \Vanguard\Category::where('id','>',Auth::user()->company[0]->category_id)->get();
                    $i = 0;
                    ?>
                    @foreach($getCategories as $rr)
                        <img class="category-u" src="/upload/categories/{{$rr->avatar}}" >
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
    <!--MODAL NUEVO CANDIDATO-->
    <?php $dataFile = 'create' ?>
    @include('dashboard_user.candidate.partials.modalcreate')

@stop

@section('scripts')
<script>
    $("#formCreate").validate({
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
            company: {
                required: true,
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
            company: {
                required: "{{trans('app.candidate_validate.company_required')}}",
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

    $('.formCreate').each(function(){
        $($(this)).validate({
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
                company: {
                    required: true,
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
                company: {
                    required: "{{trans('app.candidate_validate.company_required')}}",
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
    });

</script>
   
@stop
