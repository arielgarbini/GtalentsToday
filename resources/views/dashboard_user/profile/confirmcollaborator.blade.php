@extends('layouts.app1')

@section('page-title', trans('app.profile'))

@section('content')
    <!-- INDICADORES DE SECUENCIA-->
    <ul class="grid body-profile">
        <!--INFO DE CONTACTO-->
        <li class="active" id="btn-infoContactoConfirm">
            <span class="icon-gTalents_contact-card"></span>
            <p>@lang('auth.contact_info')</p>
        </li>

        <!--PREFERENCIAS-->
        <li id="btn-preferenciasConfirm">
            <span class="icon-gTalents_preferencias"></span>
            <p>@lang('app.preferences')</p>
        </li>
    </ul>

    <!--CONTENEDOR PADRE PARA LOGIN-->
    <article class="register">

        <!--FORMULARIO login-->
    {!! Form::open(['route' => ['update.profile'], 'files' => true, 'id' => 'form-confirm', 'class' => 'formLogin login']) !!}
    <!--PASO 1 | INFORMACION DE CONTAINER-->

        <!--PASO 1-1 | DETALLES DE CONTACTO-->
        <div class="formContainer-confirm validate-one-input" id="paso1-1">
            <!--TITULO DE LA SECCION-->
            <div class="formLogin-title">
                <h4>@lang('app.legal_information')</h4>
                <p>@lang('app.correct_your_personal_data')</p>
            </div>

            <!--PREFIJO-->
            <div class="itemForm">
                <label>@lang('app.prefix')</label>
                <select class="browser-default">
                    <option value="" disabled selected>@lang('app.choose_prefix')</option>
                    <option value="1">@lang('app.mr')</option>
                    <option value="2">@lang('app.mrs')</option>
                </select>
            </div>

            <!--NOMBRE-->
            <div class="itemForm">
                <label for="first_name">@lang('app.first_name')</label>
                {!! Form::text('first_name', $user->first_name, ['message' => trans('app.first_name_required'), 'class' => 'validate-one', 'id' => 'first_name', 'placeholder' => trans('app.first_name')]) !!}
            </div>

            <!--APELLIDO-->
            <div class="itemForm">
                <label for="last_name">@lang('app.last_name')</label>
                {!! Form::text('last_name', $user->last_name, ['message' => trans('app.last_name_required'), 'class' => 'validate-one', 'id' => 'last_name', 'placeholder' => trans('app.last_name')]) !!}
            </div>

            <!--CORREO ELECTRONICO-->
            <div class="itemForm">
                <label for="email">@lang('app.email')</label>
                {!! Form::text('email', $user->email, ['readonly' => 'true' , 'message' => trans('app.email_required'), 'class' => 'validate-one', 'id' => 'email', 'placeholder' => trans('app.email')]) !!}
            </div>

            <!--TELEFONO PRINCIPAL-->
            <div class="itemForm">
                <label for="phone">@lang('app.principal_phone')</label>
                {!! Form::text('phone', $user->phone, ['message' => trans('app.telf_required'),'class' => 'validate-one', 'id' => 'phone', 'placeholder' => trans('app.principal_phone')]) !!}
            </div>

            <!--TELEFONO SECUNDARIO-->
            <div class="itemForm">
                <label for="secundary_phone">@lang('app.secundary_phone')</label>
                {!! Form::text('secundary_phone', $user->secundary_phone, ['id' => 'secundary_phone', 'placeholder' => trans('app.secundary_phone')]) !!}
            </div>

            <!--LEYENDA PUNTOS-->
            <div class="leyend">
                <div class="leyend-point active"></div>
                <div class="leyend-point"></div>
            </div>
        </div>

        <!--PASO 1-2 | DIRECCION-->
        <div class="formContainer-confirm validate-two-input" id="paso1-2">
            <!--TITULO DE LA SECCION-->
            <div class="formLogin-title">
                <h4>@lang('app.address')</h4>
            </div>

            <!--PAIS-->
            <div class="itemForm">
                <label>@lang('app.country')</label>
                {!! Form::select('country_id', $countries, $user->country_id ? $user->country_id: '', ['message' => trans('app.country_required'), 'class' => 'validate-two browser-default', 'id' => 'country_id', 'placeholder' => trans('app.choose_country')]) !!}
            </div>

            <!--PROVINCIA-->
            <div class="itemForm">
                <label for="state">@lang('app.state_province')</label>
                {!! Form::select('state', [] , Input::old('state'), ['message' => trans('app.state_required'), 'class' => 'browser-default validate-two', 'id' => 'state', 'placeholder' => trans('app.choose_province')]) !!}
            </div>

            <!--CIUDAD-->
            <div class="itemForm">
                <label for="city">@lang('app.city')</label>
                {!! Form::text('city', ($address!='') ? $address->city : '', ['message' => trans('app.city_required'), 'class' => 'validate-two', 'id' => 'city', 'placeholder' => trans('app.city')]) !!}
            </div>

            <!--DIRECCION-->
            <div class="itemForm">
                <label>@lang('app.address')</label>
                {!! Form::textarea('address', ($address!='') ? $address->address : '', ['message' => trans('app.address_required'), 'class' => 'validate-two', 'id' => 'address', 'placeholder' => trans('app.address'), 'cols' => '30', 'rows' => '10']) !!}
            </div>

            <!--CORREO ELECTRONICO-->
            <div class="itemForm">
                <label>@lang('app.address') 2</label>
                {!! Form::text('complement', ($address!='') ? $address->complement : '', ['id' => 'complement', 'placeholder' => trans('app.complement')]) !!}
            </div>

            <!--CODIGO POSTAL-->
            <div class="itemForm">
                <label>@lang('app.zip_code')</label>
                {!! Form::text('zip_code', ($address!='') ? $address->zip_code : '', ['message' => trans('app.zipcode_required'), 'class' => 'validate-two', 'id' => 'zip_code', 'placeholder' => trans('app.zip_code')]) !!}
            </div>

            <!--LEYENDA PUNTOS-->
            <div class="leyend">
                <div class="leyend-point"></div>
                <div class="leyend-point active"></div>
            </div>
        </div>

        <!--PASO 3 | PREFERENCIAS-->
        <!--PASO 3-1 | DETALLES DE CONTACTO-->
        <div class="formContainer-confirm" id="paso3">
            <!--TITULO DE LA SECCION-->
            <div class="formLogin-title">
                <h4>@lang('app.security')</h4>
                <p>@lang('app.security_comment1')</p>
            </div>

            <!--PREGUNTA DE SEGURIDAD-->
            <div class="itemForm">
                <label>@lang('app.security_question') 1</label>
                {!! Form::select('security_question1', $securityQuestions , ($preferences!='') ? $preferences->security_question1_id : '', ['class' => 'browser-default', 'id' => 'security_question1', 'placeholder' => trans('app.security_question')]) !!}
            </div>

            <!--RESPUESTA 1 A PREGUNTA DE SEGURIDAD-->
            <div class="itemForm">
                <label>@lang('app.answer') 1</label>
                {!! Form::text('answer1', ($preferences!='') ? $preferences->answer1 : '', ['id' => 'answer1', 'placeholder' => trans('app.answer')]) !!}
            </div>

            <!--PREGUNTA DE SEGURIDAD 2-->
            <div class="itemForm">
                <label>@lang('app.security_question') 2</label>
                {!! Form::select('security_question2', $securityQuestions , ($preferences!='') ? $preferences->security_question2_id : '', ['class' => 'browser-default', 'id' => 'security_question2', 'placeholder' => trans('app.security_question')]) !!}
            </div>

            <!--RESPUESTA 2 A PREGUNTA DE SEGURIDAD-->
            <div class="itemForm">
                <label>@lang('app.answer') 2</label>
                {!! Form::text('answer2', ($preferences!='') ? $preferences->answer2 : '', ['id' => 'answer2', 'placeholder' => trans('app.answer')]) !!}
            </div>

            <!--CHECKBOX DE TERMINOS-->
            <div class="itemCheck">
                <p>
                    <input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
                    <label for="receive_messages">@lang('app.confirm_send_emails')</label>
                </p>
            </div>
        </div>

        <div class="formContainer-confirm" id="paso3-1">
            <!--MENSAJE FINAL-->
            <div class="message-finish">
                <h3>@lang('app.thanks_for_choosing_us')</h3>
                <p>@lang('app.pending_validate')</p>
                <div class="link">
                    <button type="submit" class="btn-main">
                        @lang('app.continue')
                    </button>
                </div>
            </div>
        </div>


    {!! Form::close() !!}

    <!--BOTONES NEXT Y LEFT-->
        <section class="move">
            <!--left-->
            <div class="move-link" id="btn-return-confirm-collaborator1">
                <a href="#!" class="btn-return">@lang('app.last_step_s')</a>
            </div>

            <!--next-->
            <div class="move-link" id="btn-next-confirm-collaborator1">
                <a href="#!" class="btn-main validate" id="validate-one">@lang('app.next_step_s')</a>
            </div>

            <!-- PASO 1-2 a 1-3 -->

            <!--next-->
            <div class="move-link" id="btn-return-confirm-collaborator2">
                <a href="#!" class="btn-return">@lang('app.last_step_s')</a>
            </div>

            <!--next-->
            <div class="move-link" id="btn-next-confirm-collaborator2">
                <a href="#!" class="btn-main validate" id="validate-two">@lang('app.next_step_s')</a>
            </div>

            <!-- PASO 3 a 4-1 -->
            <!--left-->
            <div class="move-link" id="btn-return-confirm-collaborator6">
                <a href="#!" class="btn-return">@lang('app.last_step_s')</a>
            </div>

            <!--next-->
            <div class="move-link" id="btn-next-confirm-collaborator6">
                <a href="#!" class="btn-main">@lang('app.next_step_s')</a>
            </div>

            <!-- PASO 4-2 a 4-3 -->
            <!--next-->
            <div class="move-link" id="btn-next-confirm-collaborator8">
                <a href="#!" class="btn-main" >@lang('app.next_step_s')</a>
            </div>
        </section>

    </article>
    @stop

    @section('scripts')
        <script type="text/javascript">
            $(document).ready(function(){
                $('body').keypress(function(e){
                    if(e.keyCode==13){
                        $('.move-link .btn-main').each(function(){
                            if($(this).parent().css('display') == 'block'){
                                $(this).click();
                                e.preventDefault();
                                e.stopPropagation();
                                return false;
                            }
                        });
                    }
                });
                $('.validate').click(function(e){
                    var validate = false;
                    var vala = $(this).attr('id');
                    $('.'+vala+'-input .'+vala).each(function(){
                        if($(this).val()==''){
                            validate = true;
                            if(!$(this).parent().find('.text-darger').attr('class')) {
                                $(this).parent().append('<p class="text-darger" style="color:red;">' + $(this).attr('message') + '</p>');
                                $(this).change(function () {
                                    if ($(this).val() != '') {
                                        $(this).parent().find('.text-darger').hide();
                                    } else {
                                        $(this).parent().find('.text-darger').show();
                                    }
                                });
                                $(this).keyup(function () {
                                    if ($(this).val() != '') {
                                        $(this).parent().find('.text-darger').hide();
                                    } else {
                                        $(this).parent().find('.text-darger').show();
                                    }
                                });
                            }
                        }
                    });
                    if(validate){
                        e.preventDefault();
                        e.stopPropagation();
                    };
                });

                $('#legal_company_name').val($('#company_name').val());
                $('#legal_first_name').val($('#first_name').val());
                $('#legal_last_name').val($('#last_name').val());

                $('#first_name').keyup(function(){
                    $('#legal_first_name').val($(this).val());
                });

                $('#last_name').keyup(function(){
                    $('#legal_last_name').val($(this).val());
                });

                $('#company_name').keyup(function(){
                    $('#legal_company_name').val($(this).val());
                });
            });

            $('#promotional_code_item').hide();

            $("#test1").on( "click", function() {
                $('#promotional_code_item').show("slow");
            });

            $("#test2").on( "click", function() {
                $('#promotional_code_item').hide("slow");
                $('#promotional_code').val("");
            });

            $(".target_r").on( "click", function() {
                $('#organization_role').val( $('input[name="group2"]:checked').val() );
            });

            if( $('#country_id').val() != ''){
                var country = $('#country_id').find(':selected').val();
                var state = 'state';
                getStates(country, state);
            }

                    @if( Input::old('state') )
            var country = $('#country_id').find(':selected').val();
            var state = 'state';
            getStates(country, state);
            @endif

            $('#country_id').change(function (e) {
                var country = $('#country_id').find(':selected').val();
                var state = 'state';
                getStates(country, state);
            });

            if( $('#country_id2').val() != ''){
                var country = $('#country_id').find(':selected').val();
                var state = 'state2';
                getStates(country, state);
            }

                    @if( Input::old('state2') )
            var country = $('#country_id2').find(':selected').val();
            var state = 'state2';
            getStates(country, state);
            @endif

            $('#country_id2').change(function (e) {
                var country = $('#country_id2').find(':selected').val();
                var state = 'state2';
                getStates(country, state);
            });

            function getStates(country, state){
                $.get("{{ route('country.getProvince') }}",
                    { country: country },
                    function(data) {
                        if(data){
                            $('#'+state).empty();
                            $('#'+state).removeAttr('disabled');
                            $('#'+state).append($('<option></option>').text('{{ trans('app.select_province') }}').val(''));
                            $.each(data, function(i) {
                                $('#'+state).append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                            });

                            var states = $('#'+state).find(':selected').val();
                            @if($address!='')
                            $('#'+state).val("{{$address->state_id}}");
                            @endif
                        }else{
                            sweetAlert('Oops...'+'{{ trans('app.the_country_has_no_provinces') }}', '{{ trans('app.select_another_country') }}', 'error');
                        }
                    }, 'json');
            }


            //CONFIRMACION DE REGISTRO
            //PASO 1-1 a 1-2
            $("#btn-next-confirm-collaborator1").click(function(){
                $("#paso1-2, #btn-return-confirm-collaborator1, #btn-next-confirm-collaborator2").show("slow");
                $("#paso1-1 , #btn-next-confirm-collaborator1").hide("slow");
            })

            //REGRESAR
            $("#btn-return-confirm-collaborator1").click(function(){
                $("#paso1-1, #btn-next-confirm-collaborator1").show("slow");
                $("#paso1-2 , #btn-return-confirm-collaborator1, #btn-next-confirm-collaborator2").hide("slow");
            })

            //PASO 1-2 a 1-3
            $("#btn-next-confirm-collaborator2").click(function(){
                $("#paso3, #btn-return-confirm-collaborator2, #btn-next-confirm-collaborator6").show("slow");
                $("#paso1-2, #btn-return-confirm-collaborator1, #btn-next-confirm-collaborator2").hide("slow");

                //CAMBIAR LEYENDA
                $("#btn-preferenciasConfirm").addClass("active");
                $("#btn-infoContactoConfirm").removeClass("active");
            })

            //REGRESAR
            $("#btn-return-confirm-collaborator2").click(function(){
                $("#paso1-2, #btn-return-confirm-collaborator1, #btn-next-confirm-collaborator2").show("slow");
                $("#paso3, #btn-return-confirm-collaborator2, #btn-next-confirm-collaborator6").hide("slow");

                $("#btn-infoContactoConfirm").addClass("active");
                $("#btn-preferenciasConfirm").removeClass("active");
            })
            //PASO 3 a 4-1
            $("#btn-next-confirm-collaborator6").click(function(){
                $("#paso3-1, #btn-return-confirm-collaborator6").show("slow");
                $("#paso3, #btn-return-confirm-collaborator2, #btn-next-confirm-collaborator6").hide("slow");

                //CAMBIAR LEYENDA
                $("#btn-preferenciasConfirm").addClass("active");
                $("#btn-infoContactoConfirm").removeClass("active");
            })

            //REGRESAR
            $("#btn-return-confirm-collaborator6").click(function(){
                $("#paso3, #btn-return-confirm-collaborator2, #btn-next-confirm-collaborator6").show("slow");
                $("#paso3-1, #btn-return-confirm-collaborator6").hide("slow");

                //CAMBIAR LEYENDA
                $("#btn-preferenciasConfirm").addClass("active");
                $("#btn-infoContactoConfirm").removeClass("active");
            })
        </script>
@stop