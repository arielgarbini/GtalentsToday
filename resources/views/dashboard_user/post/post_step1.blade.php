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
                        {!!  Form::select('industry',$industries, ($vacancy!=false) ? $vacancy->industry : null, ['id' => 'industry', 'class' => 'browser-default'] )!!}
                        @if($errors->has('industry'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('industry') }}</p>
                        @endif
                    </div>

                    <!--TIPO DE BUSQUEDA-->
                    <div class="itemForm">
                        <label for="search_type">@lang('app.search_type')</label>
                        {!!  Form::select('search_type',$searchType, ($vacancy!=false) ? $vacancy->search_type : null, ['id' => 'search_type', 'class' => 'browser-default'] )!!}
                        @if($errors->has('search_type'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('search_type') }}</p>
                        @endif
                    </div>
                </div>

                <div class="dual">
                    <!--TIPO DE CONTRATACION-->
                    <div class="itemForm">
                        <label for="contract_type_id">@lang('app.contract_type')</label>
                        {!!  Form::select('contract_type_id', $contractTypes , ($vacancy!=false) ? $vacancy->contract_type_id : null, ['id' => 'contract_type', 'class' => 'browser-default'] )!!}
                        @if($errors->has('contract_type_id'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('contract_type_id') }}</p>
                        @endif
                    </div>

                    <!--AÑOS DE EXPERIENCIA-->
                    <div class="itemForm">
                        <label for="years_of_experience">@lang('app.years_of_experience')</label>
                        {!!  Form::select('years_experience',$experience, ($vacancy!=false) ? $vacancy->years_experience : null, ['id' => 'years_experience' , 'class' => 'browser-default'] )!!}
                        @if($errors->has('years_experience'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('years_experience') }}</p>
                        @endif
                    </div>
                </div>

                <div class="dual">
                    <!--ESPECIALIZACION-->
                    <div class="itemForm">
                        <label for="especialization">@lang('app.especialization')</label>
                        {!!  Form::select('especialization_id',$functionalArea,($vacancy!=false) ? $vacancy->especialization_id : null, ['id' => 'especialization_id' , 'class' => 'browser-default'] )!!}
                        @if($errors->has('especialization_id'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('especialization_id') }}</p>
                        @endif
                    </div>

                    <!--IDIOMAS-->
                    <div class="itemForm">
                        <label for="languages">@lang('app.languages')</label>
                        @if($langs!=false)
                            <select name="list_languages[]" class='chosen-select browser-default' id='list_languages' multiple='multiple'>
                                @foreach($languages as $key => $val)
                                    <option value="{{$key}}" @if(in_array($key, $langc)) selected @endif>{{$val}}</option>
                                @endforeach
                            </select>
                        @else
                            {!! Form::select('list_languages[]', $languages, null, ['placeholder' => '', 'class' => 'chosen-select browser-default', 'id' => 'list_languages', 'multiple' => 'multiple']) !!}
                        @endif
                    </div>
                </div>

                <div id="languages" class="dual">
                    @if($langs!=false)
                        @foreach($langs as $l)
                            <div class="itemForm"><label>{{$l->type($language)}}</label>
                                {!!  Form::select('level-'.$l['type_id'],$lans, $l['level'], ['id' => $l['type_id'].'-'.$l->type($language), 'class' => 'browser-default'] )!!}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="dual">
                    <!--RANGO SALARIAL-->
                    <div class="itemForm">
                        <label for="range_salary">@lang('app.range_salary')</label>
                        {!!  Form::select('range_salary',$compensations, ($vacancy!=false) ? $vacancy->range_salary : null, ['id' => 'range_salary' , 'class' => 'browser-default'] )!!}
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
                                @if($vacancy!=false && $vacancy->group1==1)
                                    {!!  Form::radio('group1',1, null, ['id' => 'test1', 'checked' => 'checked'])!!}
                                @else
                                    {!!  Form::radio('group1',1, null, ['id' => 'test1'])!!}
                                @endif
                                <label for="test1">@lang('app.percentaje')</label>
                            </p>

                            <!-- $ Fijo -->
                            <p>
                                <!--<input name="group1" type="radio" id="test2" />-->
                                @if($vacancy!=false && $vacancy->group1==2)
                                    {!!  Form::radio('group1',2, null, ['id' => 'test2', 'checked' => 'checked'])!!}
                                @else
                                    {!!  Form::radio('group1',2, null, ['id' => 'test2'])!!}
                                @endif
                                <label for="test2">$ @lang('app.fixed')</label>
                               
                            </p>                            
                        </div>
                        <div id="des" class="radio" style="width:9% !important; margin-top: 8px"></div>{!! Form::text('fee', ($vacancy!=false) ? $vacancy->fee : null,['id' => 'fee', 'class' => 'solo-numero form-control','placeholder' => '22', 'maxlength' => 5]) !!}
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
                    {!!  Form::select('replacement_period_id', $replacement_period, ($vacancy!=false) ? $vacancy->replacement_period_id : null, ['id' => 'replacement_period' , 'class' => 'browser-default'] )!!}
                    @if($errors->has('replacement_period_id'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('replacement_period_id') }}</p>
                    @endif 
                    </div>

                    <!--GARANTIA AL EMPLEADOR-->
                    <div class="itemForm">
                        <label for="warranty_to_the_employer"> @lang('app.warranty_employer')</label>
                    {!! Form::text('warranty_employer', ($vacancy!=false) ? $vacancy->warranty_employer : null,['id' => 'conditions', 'class' => 'form-control','placeholder' => trans('app.warranty_employer')]) !!}
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
                {!! Form::textarea('general_conditions',($vacancy!=false) ? $vacancy->general_conditions : null, ['id' => 'general_conditions', 'class' => 'form-control','placeholder' => trans('app.general_conditions')]) !!}
                    @if($errors->has('general_conditions'))
                      <p class="text-darger" style="color:red;"> {{ $errors->first('general_conditions') }}</p>
                    @endif 
                </div>

                <!--CHECKBOX DE TERMINOS-->
                <div class="itemCheck">
                    <p>
                    @if($vacancy!=false && $vacancy->general_conditions!='')
                    {!! Form::checkbox('terms',1,true, ['id' => 'filled-in-box', 'class' => 'filled-in','checked' ]) !!}
                    @else
                    {!! Form::checkbox('terms',1,null, ['id' => 'filled-in-box', 'class' => 'filled-in' ]) !!}
                    @endif
                    <label for="tos" id="filled-in-box-click">@lang('app.i_accept')
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
                        <a class="btn-main next2" id="next-newPost2-back" href="{{$url}}">@lang('app.back')</a>
                    </div>
                    <div class="item">
                         <button type="submit" class="btn-main next2"  id="next-newPost2">@lang('app.next')</button>
                    </div>
                    <div class="item">
                        <button type="submit" name="saveonly" value="true" class="btn-main next " >@lang('app.save')</button>
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
            $('#next-newPost2-back').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                href = $(this).attr('href');
                data = new FormData();
                $('input').each(function(){
                    if($(this).attr('name')!=undefined){
                        data.append($(this).attr('name'), $(this).val());
                    }
                });
                $('select').each(function(){
                    if($(this).attr('name')!=undefined){
                        data.append($(this).attr('name'), $(this).val());
                    }
                });
                $('textarea').each(function(){
                    if($(this).attr('name')!=undefined){
                        data.append($(this).attr('name'), $(this).val());
                    }
                });
                console.log('efsef');
                $.ajax({
                    url: "{{route('vacancies.step1.ajax', $vacancy_id)}}",
                    method: 'POST',
                    data: data,
                    processData: false,
                    processing: true,
                    serverSide: false,
                    contentType: false,
                    success: function(response){
                        window.location = href;
                    }
                });
            });

            @if($langc!=false)
                val = new Array;
                @foreach($langc as $ll)
                    val.push("{{$ll}}");
                @endforeach
            @else
                val = '';
            @endif
            $('#list_languages').change(function(){
               val2 = $(this).val();
               console.log($(this).val());
               if(val2!=null && val2[0]==''){
                   val2 = $(this).val().slice(1);
               }
               if(val!='' && val!=null && val2!=null){
                   for(var i = 0; i<val.length;i++){
                       var existe = false;
                       for(var j = 0; j<val2.length;j++){
                           if(val[i]==val2[j]){
                               existe = true;
                           }
                       }
                       if(existe==false){
                           $('#'+val[i]).parent().remove();
                       }
                   }
               }
               if(val2!=null){
                   var html = '';
                   for(var i=0; i<val2.length; i++){
                       var data = val2[i].split('-');
                       if(document.getElementById(val2[i])==undefined){
                           html += '<div class="itemForm"><label for="'+val2[i]+'">'+data[1]+'</label> <select id="'+val2[i]+'" class="browser-default" name="level-'+data[0]+'"><option value="1">{{trans("app.native")}}</option>';
                           html += '<option value="2">{{trans("app.fluent")}}</option><option value="3">{{trans("app.good")}}</option><option value="4">{{trans("app.functional")}}</option><option value="5">{{trans("app.basic")}}</option></select> </div>';
                       }
                   }
                   $('#languages').append(html);
               }
               if(val2==null){
                   $('#languages').html('');
               }
                val = val2;
            });
            $("#crear-container").hide();
            $('#test1').click(function(){
                $('#fee').val('');
                $('#fee').attr('maxlength',2);
                $('#des').html('%');
            });

            $('#test2').click(function(){
                $('#fee').val('');
                $('#fee').attr('maxlength',6);
                $('#des').html('$');
            });

            $('#filled-in-box-click').click(function () {
               console.log($('#filled-in-box').is(":checked"));
                if($('#filled-in-box').is(":checked")){
                   $('#filled-in-box').prop('checked', false);
               } else {
                   $('#filled-in-box').prop('checked', true);
               }
            });
       });
</script>

   <script type="text/javascript">
       $(document).ready(function() {

           $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"});
       });
   </script>

@stop
