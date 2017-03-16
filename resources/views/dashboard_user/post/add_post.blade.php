@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')


    <!--CREAR NUEVO POST-->
    <article class="newPost grid">
        <!--ENCABEZADO ICONOS-->
        <section class="newPost-legend">
            <!--CREAR-->
            <div class="item active" id="indi-create">
                <figure>
                    <span class="icon-gTalents_crear"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </figure>
                <p>Crear</p>
            </div>

            <!--DETALLES-->
            <div class="item" id="indi-detail">
                <figure>
                    <span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                </figure>
                <p>Detalles</p>
            </div>

            <!--EMPEZAR-->
            <div class="item" id="indi-go">
                <figure>
                    <span class="icon-gTalents_empezar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                </figure>
                <p>Empezar</p>
            </div>
        </section>

    {!! Form::open(['route' => 'vacancies.store', 'files' => true, 'id' => 'vacancy-form', 'class'=>'formLogin' , 'method' => 'post', 'enctype'=>'multipart/form-data'] ) !!}
        <!-- estatus post activo-->
            <input type="hidden" value="<?= csrf_token() ?>" name="_token">
              
            <!-- CREAR - CONTENEDOR -->
            <section class="newPost-container" id="crear-container">
                <!--NOMBRE DE LA POSICION-->
                <div class="itemForm">
                    <label for="name">@lang('app.name_position')</label>
                {!! Form::text('name', old('name') , ['id' => 'name', 'class' => 'form-control', 'placeholder' => trans('app.name_position')]) !!}  
                         @if($errors->has('name'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('name') }}</p>
                          @endif
                </div>

                <div class="dual">
                    <!--NUMERO DE POSICIONES-->
                    <div class="itemForm">
                        <label for="positions_number">@lang('app.positions_number')</label>
                       {!! Form::text('positions_number',null, ['id' => 'positions_number','class' => 'form-control','placeholder' => trans('app.positions_number')]) !!} 
                         @if($errors->has('positions_number'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('positions_number') }}</p>
                         @endif
                    </div>

                    <!--UBICACION-->
                    <div class="itemForm">
                        <label for="location">@lang('app.location')</label>
                        {!! Form::text('location', null, ['id' => 'location','class' => 'form-control','placeholder' => trans('app.location') ]) !!} 
                          @if($errors->has('location'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('location') }}</p>
                         @endif
                    </div>
                </div>

                <!--EMPLESAS OBJETIVOS-->
                <div class="itemForm">
                    <label for="target_companies">@lang('app.target_companies')</label>
                    {!! Form::textarea('target_companies', null, ['id' => 'target_companies', 'class' => 'form-control','placeholder' => trans('app.companies_where_the_candidate_has_worked') ])!!}
                    @if($errors->has('target_companies'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('target_companies') }}</p>
                    @endif
                </div>

                <!--EMPLESAS OFF-LIMITS-->
                <div class="itemForm">
                    <label for="off_limits_companies">@lang('app.off_limits_companies')</label>
                   {!! Form::textarea('off_limits_companies', null, ['id' => 'off_limits_companies', 'class' => 'form-control','placeholder' => trans('app.off_limits_companies') ])!!}
                  @if($errors->has('off_limits_companies'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('off_limits_companies') }}</p>
                    @endif  
                </div>

                <!--RESPONSABILIDADES-->
                <div class="itemForm">
                    <label for="responsabilities">@lang('app.responsabilities')</label>
                    {!! Form::textarea('responsabilities', null, ['id' => 'responsabilities', 'class' => 'form-control','placeholder' => trans('app.responsabilities') ])!!}
                   @if($errors->has('responsabilities'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('responsabilities') }}</p>
                    @endif   
                </div>

                <!--EXPERIENCIA REQUERIDA-->
                <div class="itemForm">
                    <label for="required_experience">@lang('app.required_experience')</label>
                    {!! Form::textarea('required_experience', null, ['id' => 'required_experience', 'class' => 'form-control','placeholder' => trans('app.required_experience') ]) !!}
                    @if($errors->has('required_experience'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('required_experience') }}</p>
                    @endif 
                </div>

                <!--PREGUNTAS CLAVES-->
                <div class="itemForm icon-help">
                    <label for="key_position_questions">@lang('app.key_position_questions')</label>
                    <a class="hint--right  hint--large hint--bounce" aria-label="Escriba las preguntas claves que le plantearia a un posible candidato según el perfil que busca">
                        <i class="icon-gTalents_help "></i>
                    </a>
                    {!! Form::text('key_position_questions', null, ['id' => 'key_position_questions', 'class' => 'form-control','placeholder' => '3 puntos o preguntas claves de la posición' ])!!}
                  @if($errors->has('key_position_questions'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('key_position_questions') }}</p>
                    @endif 
                </div>
                 

                <!--BOTONES UPLOAD-->
                <div class="upload">
                    <!-- DESCRIPCION DEL PUESTO -->
                    <div class="box">
                     <!--   <input type="file" name="file" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />-->
                        {!! Form::file('files[]', ['id' => 'file-4', 'class' => 'inputfile inputfile-2','data-multiple-caption' => '{count} files selected ' ,'multiple'=> true ])!!}
                     <label for="file-4"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Descripción del Puesto</span></label>
                    
                    </div>

                    <!-- ACUERDO CON EL EMPLEADOR -->
                    <div class="box hint--bottom  hint--large hint--bounce" aria-label="Acuerdo de confidencialidad entre usted y gTalents, sin este acuerdo podremos invalidar su post">
                       <!-- <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />-->
                        {!! Form::file('files[]', ['id' => 'file-2', 'class' => 'inputfile inputfile-2','data-multiple-caption' => '{count} files selected ' , 'multiple' => true ])!!}
                        <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Acuerdo con el Empleador</span></label>
                        
                    </div>
                </div>

                <div class="btn-container">
                    <div class="item">
                       <!-- <a href="#" class="btn-main" id="next-newPost1">Siguiente </a>-->
                        <button type="submit" class="btn-main next " >Siguiente</button>
                    </div>
                </div>
            </section>

    
         

            <!--EMPEZAR - CONTAINER -->
            <!--<section class="newPost-container" id="go-container">
       
                <div class="messageWin">
                    <figure>
                        <span class="icon-gTalents_win-2"></span>
                    </figure>
                    <p>Has creado una nueva oportunidad</p>

                    <div class="btn-container">
                       
                        <div class="item">
                            <a href="{{URL::to('post_detail')}}" class="btn-main">Ver Oportunidad</a>
                        </div>
                    </div>
                </div>
            </section>-->
        {!! Form::close() !!}  
    </article>
    

    <!--MODAL PERFIL SUPPLIER-->
    <div id="modalProfileSupplier" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Perfil del Supplier</h4>
        </div>

        <div class="modal-content">

            <!--RESUMEN SUPPLIER-->
            <div class="profile-colab profile-supplier">
                <section class="supplierContain1">
                    <!--ICONO RANGO-->
                    <figure class="supplierContain1-ranking">
                        <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                    </figure>

                    <div class="datos">
                        <h4>QDT876</h4>
                        <p>Newbie</p>
                    </div>
                </section>

                <!--PROMEDIO CALIFICACIONES-->
                <div class="qualification">
                    <figure>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3 star-null"></span>
                    </figure>
                </div>

                <!--RESUMEN 1-->
                <div class="profile-colab-message">
                    <h4>Ha participado en:</h4>
                    <p>214 oportunidades laborales</p>
                </div>

                <!--RESUMEN 2-->
                <div class="profile-colab-message">
                    <h4>Indice de aceptación de candidatos:</h4>
                    <p>90%</p>
                </div>
            </div>

            
            <!--BTN-MAIN-->
            <div class="item-btn">
                <a href="#!" class="btn-main">
                    Continuar
                </a>
            </div>
        </div>
    </div>
  

@stop

@section('scripts')
  <!--  {!! JsValidator::formRequest('Vanguard\Http\Requests\Vacancy\CreateVacancyRequest', '#vacancy-form') !!}-->
@stop
