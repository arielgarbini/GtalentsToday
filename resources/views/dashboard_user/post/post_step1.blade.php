 @extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')
@foreach ($errors->all() as $error)
      {{ $error }}
 @endforeach

 <!--DETALLES - CONTAINER-->
        <!--CREAR NUEVO POST-->
    <article class="newPost grid">
        <!--ENCABEZADO ICONOS-->
        <section class="newPost-legend">
            <!--CREAR-->
            <div class="item" id="indi-create">
                <figure>
                    <span class="icon-gTalents_crear" ><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </figure>
                <p>Crear</p>
            </div>

            <!--DETALLES-->
            <div class="item active" id="indi-detail">
                <figure>
                    <span class="icon-gTalents_detalles "><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
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
  

            <section class="newPost-container" id="detail-container pagination-on">
 {!! Form::model($vacancies, ['files' => true, 'id' => 'vacancy-form', 'class'=>'formLogin']) !!}
   
                <div class="dual">
                    <!--INDUSTRIA-->
                    <div class="itemForm">
                        <label for="industry">@lang('app.industry')</label>
                        {!!  Form::select('industry',array( '1' => '1', '2' => '2', '3' => '3'), null, ['id' => 'industry', 'class' => 'browser-default'] )!!}
                    </div>

                    <!--TIPO DE BUSQUEDA-->
                    <div class="itemForm">
                        <label for="search_type">@lang('app.search_type')</label>
                        {!!  Form::select('search_type',array('1' => 'Contingency', '2' => 'Retained'), null, ['id' => 'search_type', 'class' => 'browser-default'] )!!}
                    </div>
                </div>

                <div class="dual">
                    <!--TIPO DE CONTRATACION-->
                    <div class="itemForm">
                        <label for="contract_type_id">@lang('app.contract_type')</label>
                        {!!  Form::select('contract_type_id', $contractTypes , null, ['id' => 'contract_type', 'class' => 'browser-default'] )!!}
                      </div>

                    <!--AÑOS DE EXPERIENCIA-->
                    <div class="itemForm">
                        <label for="years_of_experience">@lang('app.years_of_experience')</label>
                        {!!  Form::select('years_experience',array('3-5 años' => '3-5 años', '6-10 años' => '6-10 años', '10-15 años' => '10-15 años'),null, ['id' => 'years_experience' , 'class' => 'browser-default'] )!!}
                    </div>
                </div>

                <div class="dual">
                    <!--ESPECIALIZACION-->
                    <div class="itemForm">
                        <label for="especialization">@lang('app.especialization')</label>
                         {!!  Form::select('especialization_id',array('1' => 'Diseño', '2' => 'Ingeniería'),null, ['id' => 'especialization_id' , 'class' => 'browser-default'] )!!}
                    </div>

                    <!--IDIOMAS-->
                    <div class="itemForm">
                        <label for="languages">@lang('app.languages')</label>
                        {!! Form::select('list_languages[]', $languages, null, ['class' => 'browser-default', 'id' => 'list_languages']) !!}
                    </div>
                </div>

                <div class="dual">
                    <!--RANGO SALARIAL-->
                    <div class="itemForm">
                        <label for="range_salary">@lang('app.range_salary')</label>
                        {!!  Form::select('range_salary',array('USD 5k - 10k' => 'USD 5k - 10k', 'USD 5k - 15k' => 'USD 5k - 15k', 'USD 25k - 35k' => 'USD 25k - 35k'), null, ['id' => 'range_salary' , 'class' => 'browser-default'] )!!}
                    </div>

                    <!--HONORARIO COBRADO AL EMPLEADOR-->
                    <div class="itemForm itemRadio">
                        <label for="fee_charged_to_employer">@lang('app.fee_charged_to_employer')</label>
                        
                        <div class="radio">
                            <!-- % -->
                            <p>
                               <!-- <input name="group1" type="radio" id="test1" />-->
                               {!!  Form::radio('group1','%', null, ['id' => 'test1'])!!}
                                <label for="test1">%</label>
                            </p>

                            <!-- $ Fijo -->
                            <p>
                                <!--<input name="group1" type="radio" id="test2" />-->
                                {!!  Form::radio('group2','$Fijo',null, ['id' => 'test2'])!!}
                                <label for="test2">$ Fijo</label>
                               
                            </p>                            
                        </div>
                    {!! Form::text('fee', null,['id' => 'fee', 'class' => 'form-control','placeholder' => '22']) !!}              
                   @if($errors->has('group1'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('group1') }}</p>
                    @endif 
                   @if($errors->has('group2'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('group2') }}</p>
                    @endif 
                    @if($errors->has('fee'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('fee') }}</p>
                    @endif 
                    </div>
                </div>

                <div class="dual">
                    <!--PERIODO DE REEMPLAZO-->
                    <div class="itemForm">
                        <label for="replacement_period">@lang('app.replacement_period')</label>
                    {!!  Form::select('replacement_period', array('1 mes' => '1 mes', '2 mes' => '2 mes'), null, ['id' => 'replacement_period' , 'class' => 'browser-default'] )!!}
                    @if($errors->has('replacement_period'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('replacement_period') }}</p>
                    @endif 
                    </div>

                    <!--GARANTIA AL EMPLEADOR-->
                    <div class="itemForm">
                        <label for="warranty_to_the_employer"> @lang('app.warranty_employer')</label>
                    {!! Form::text('warranty_employer', null,['id' => 'conditions', 'class' => 'form-control','placeholder' => trans('app.warranty_employer')]) !!}              
                     @if($errors->has('warranty_employer'))
                      <p class="text-darger" style="color:red;"> {{ $errors->first('warranty_employer') }}</p>
                    @endif 
                    </div>
                </div>

                <!--CONDICIONES GENERALES-->
                <div class="itemForm icon-help">
                    <label for="general_conditions">@lang('app.general_conditions')</label>
                    <a class="hint--right  hint--large hint--bounce" aria-label="Condiciones que debe cumplir el candidato para su oportunidad laboral">
                        <i class="icon-gTalents_help "></i>
                    </a>
                {!! Form::text('general_conditions',null, ['id' => 'general_conditions', 'class' => 'form-control','placeholder' => trans('app.general_conditions')]) !!}              
                    @if($errors->has('general_conditions'))
                      <p class="text-darger" style="color:red;"> {{ $errors->first('general_conditions') }}</p>
                    @endif 
                </div>

                <!--CHECKBOX DE TERMINOS-->
                <div class="itemCheck">
                    <p>
                    {!! Form::checkbox('terms',1,true, ['id' => 'filled-in-box', 'class' => 'filled-in','checked' ]) !!}              
                    <label for="filled-in-box">Acepto las políticas y condiciones de gTalents</label>
                    @if($errors->has('terms'))
                      <p class="text-darger" style="color:red;"> {{ $errors->first('terms') }}</p>
                    @endif 
                    </p>
                </div>

                <div class="btn-container">
                    <!--LEFT-->
                    <!--<div class="item">
                        <a href="{{route('vacancies.store')}}" class="btn-return" id="return-newPost1">Regresar</a>
                    </div>-->

                    <!--NEXT-->
                    <div class="item">
                       <!-- <a href="#" class="btn-main" id="next-newPost2">Siguiente</a>-->
                         <button type="submit" class="btn-main next2"  id="next-newPost2">Siguiente</button>
                    </div>
                </div>
            </section>
        </article>
      {!! Form::close() !!}
@stop

@section('scripts')
   <script type="text/javascript">
$(document).ready(function() {
      
                    $("#crear-container").hide();
                
      
       });
</script>

@stop
