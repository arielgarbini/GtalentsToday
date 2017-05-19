 @extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

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
                <p>@lang('app.create')</p>
            </div>

            <!--DETALLES-->
            <div class="item active" id="indi-detail">
                <figure>
                    <span class="icon-gTalents_detalles "><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                </figure>
                <p>@lang('app.details')</p>
            </div>

            <!--EMPEZAR-->
            <div class="item" id="indi-go">
                <figure>
                    <span class="icon-gTalents_empezar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                </figure>
                <p>@lang('app.start')</p>
            </div>
        </section>
  

            <section class="newPost-container" id="detail-container pagination-on">
 {!! Form::model($vacancies, ['files' => true, 'id' => 'vacancy-form', 'class'=>'formLogin']) !!}
   
                <div class="dual">
                    <!--INDUSTRIA-->
                    <div class="itemForm">
                        <label for="industry">@lang('app.industry')</label>
                        {!!  Form::select('industry',$industries, null, ['id' => 'industry', 'class' => 'browser-default'] )!!}
                        @if($errors->has('industry'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('industry') }}</p>
                        @endif
                    </div>

                    <!--TIPO DE BUSQUEDA-->
                    <div class="itemForm">
                        <label for="search_type">@lang('app.search_type')</label>
                        {!!  Form::select('search_type',$searchType, null, ['id' => 'search_type', 'class' => 'browser-default'] )!!}
                        @if($errors->has('search_type'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('search_type') }}</p>
                        @endif
                    </div>
                </div>

                <div class="dual">
                    <!--TIPO DE CONTRATACION-->
                    <div class="itemForm">
                        <label for="contract_type_id">@lang('app.contract_type')</label>
                        {!!  Form::select('contract_type_id', $contractTypes , null, ['id' => 'contract_type', 'class' => 'browser-default'] )!!}
                        @if($errors->has('contract_type_id'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('contract_type_id') }}</p>
                        @endif
                    </div>

                    <!--AÑOS DE EXPERIENCIA-->
                    <div class="itemForm">
                        <label for="years_of_experience">@lang('app.years_of_experience')</label>
                        {!!  Form::select('years_experience',$experience,null, ['id' => 'years_experience' , 'class' => 'browser-default'] )!!}
                        @if($errors->has('years_experience'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('years_experience') }}</p>
                        @endif
                    </div>
                </div>

                <div class="dual">
                    <!--ESPECIALIZACION-->
                    <div class="itemForm">
                        <label for="especialization">@lang('app.especialization')</label>
                        {!!  Form::select('especialization_id',$functionalArea,null, ['id' => 'especialization_id' , 'class' => 'browser-default'] )!!}
                        @if($errors->has('especialization_id'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('especialization_id') }}</p>
                        @endif
                    </div>

                    <!--IDIOMAS-->
                    <div class="itemForm">
                        <label for="languages">@lang('app.languages')</label>
                        {!! Form::select('list_languages[]', array('1'=>trans('app.spanish'), '2'=> trans('app.english')), null, ['class' => 'browser-default', 'id' => 'list_languages']) !!}
                    </div>
                </div>

                <div class="dual">
                    <!--RANGO SALARIAL-->
                    <div class="itemForm">
                        <label for="range_salary">@lang('app.range_salary')</label>
                        {!!  Form::select('range_salary',array('USD 5k - 10k' => 'USD 5k - 10k', 'USD 5k - 15k' => 'USD 5k - 15k', 'USD 25k - 35k' => 'USD 25k - 35k'), null, ['id' => 'range_salary' , 'class' => 'browser-default'] )!!}
                        @if($errors->has('range_salary'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('range_salary') }}</p>
                        @endif
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
                                {!!  Form::radio('group1','$',null, ['id' => 'test2'])!!}
                                <label for="test2">$ @lang('app.fixed')</label>
                               
                            </p>                            
                        </div>
                    {!! Form::text('fee', null,['id' => 'fee', 'class' => 'form-control','placeholder' => '22', 'maxlength' => 5]) !!}
                   @if($errors->has('group1'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('group1') }}</p>
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
                    {!!  Form::select('replacement_period_id', $replacement_period, null, ['id' => 'replacement_period' , 'class' => 'browser-default'] )!!}
                    @if($errors->has('replacement_period_id'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('replacement_period_id') }}</p>
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
                    <label for="tos">@lang('app.i_accept')
                        <a href="#tos-modal" class="modal-trigger waves-effect waves-light">@lang('app.terms_of_service')</a>
                    </label>
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
 <div id="tos-modal" class="modal modalText">
     <!--CERRAR-->
     <div class="modal-footer">
         <a class=" modal-action modal-close waves-effect waves-green btn-flat">
             <span class="icon-gTalents_close"></span>
         </a>
     </div>

     <!--CONTENIDO-->
     <div class="modal-content">
         <!--GARANTIAS-->
         <article class="generic grid">
             <!--TITULO DE LA SECCION-->
             <section class="generic-title">
                 <span class="icon-gTalents_garantia"></span>
                 <h2> {{ trans('app.terms_of_service' ) }} </h2>
             </section>

             <embed src="{{URL::to('/GTALENTSAGREEMENT.docx.pdf')}}" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
         </article>
     </div>
 </div>
@stop

@section('scripts')
   <script type="text/javascript">
        $(document).ready(function() {
            $("#crear-container").hide();
            $('#test1').click(function(){
                $('#fee').val('');
                $('#fee').attr('maxlength',2);
            });

            $('#test2').click(function(){
                $('#fee').val('');
                $('#fee').attr('maxlength',5);
            });
       });
</script>

@stop
