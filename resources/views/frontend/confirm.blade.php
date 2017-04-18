@extends('layouts.master')
	
	@section('title')
		@parent
	@stop
	@section('css')
		@parent
	@stop

@section('content')
<body class="body-confirm">
	<!--HEADER PARA CONFIRMACION DE REGISTRO-->
	<header class="grid">
		<!--LOGOTIPO-->
		<figure>
			<a href="{{ URL('/') }}">
				<img src="{{ URL('assets/img/logotipo.png') }}" alt="">
			</a>
		</figure>

		<!--SELECTOR DE IDIOMAS-->
		<section class="language">
			<select class="browser-default" onChange="window.location.href=this.value">
				<option value="">@lang('app.language')</option>
				<option value="{{ url('lang', ['es']) }}" {{ session('lang') == 'es' ? 'selected' : '' }}>@lang('app.spanish')</option>
				<option value="{{ url('lang', ['en']) }}" {{ session('lang') == 'en' ? 'selected' : '' }}>@lang('app.english')</option>
				<!--<option value="{{ url('lang', ['po']) }}">Portugues</option>-->
			</select>
		</section>
	</header>

	<!-- INDICADORES DE SECUENCIA-->
	<ul class="grid">
		<!--INFO DE CONTACTO-->
		<li class="active" id="btn-infoContactoConfirm">
			<span class="icon-gTalents_contact-card"></span>
			<p>@lang('auth.contact_info')</p>
		</li>

		<!--ANTECEDENTES-->
		<li id="btn-antecentesConfirm">
			<span class="icon-gTalents_antecedentes"></span>
			<p>@lang('app.background')</p>
		</li>

		<!--PREFERENCIAS-->
		<li id="btn-preferenciasConfirm">
			<span class="icon-gTalents_preferencias"></span>
			<p>@lang('app.preferences')</p>
		</li>

		<!--INFORMACION LEGAL-->
		<li id="btn-infoLegalConfirm">
			<span class="icon-gTalents_legal"></span>
			<p>@lang('app.legal_information')</p>
		</li>
	</ul>

	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="register">

		<!--FORMULARIO login-->
		{!! Form::open(['route' => ['completeData', $token], 'files' => true, 'id' => 'form-confirm', 'class' => 'formLogin login']) !!}
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
                    {!! Form::text('email', $user->email, ['message' => trans('app.email_required'), 'class' => 'validate-one', 'id' => 'email', 'placeholder' => trans('app.email')]) !!}
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
                    <label for="confirm_email">@lang('app.confirm_email')</label>
                    {!! Form::text('confirm_email', $user->email, ['message' => trans('app.confirm_email_required'), 'class' => 'validate-one', 'id' => 'confirm_email', 'placeholder' => trans('app.confirm_email')]) !!}
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
                    {!! Form::text('city', '', ['message' => trans('app.city_required'), 'class' => 'validate-two', 'id' => 'city', 'placeholder' => trans('app.city')]) !!}
				</div>

				<!--DIRECCION-->
				<div class="itemForm">
					<label>@lang('app.address')</label>
                    {!! Form::textarea('address', '', ['message' => trans('app.address_required'), 'class' => 'validate-two', 'id' => 'address', 'placeholder' => trans('app.address'), 'cols' => '30', 'rows' => '10']) !!}
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>@lang('app.address') 2</label>
                    {!! Form::text('complement', '', ['id' => 'complement', 'placeholder' => trans('app.complement')]) !!}
				</div>

				<!--CODIGO POSTAL-->
				<div class="itemForm">
					<label>@lang('app.zip_code')</label>
                    {!! Form::text('zip_code', '', ['message' => trans('app.zipcode_required'), 'class' => 'validate-two', 'id' => 'zip_code', 'placeholder' => trans('app.zip_code')]) !!}
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>				
			</div>

			<!--PASO 1-3 | INFO. COMPAÑIA-->
			<div class="formContainer-confirm validate-tres-input" id="paso1-3">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>@lang('app.company_information')</h4>
				</div>
				
				<!--NOMBRE DE LA EMPRESA-->
				<div class="itemForm">
					<label>@lang('app.company_name')</label>
                    {!! Form::text('company_name', '', ['message' => trans('app.company_required'), 'class' => 'validate-tres', 'id' => 'company_name', 'placeholder' => trans('app.company_name')]) !!}
				</div>

				<!--WEBSITE-->
				<div class="itemForm">
					<label>@lang('app.website')</label>
                    {!! Form::text('website', '', ['id' => 'website', 'placeholder' => trans('app.website')]) !!}
				</div>

				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
                    <label for="quantity_employees_id">@lang('app.size_company')</label>
                    {!! Form::select('quantity_employees_id', $quantityEmployees , '', ['message' => trans('app.quantity_employees_required'), 'class' => 'validate-tres browser-default', 'id' => 'quantity_employees_id', 'placeholder' => trans('app.choose_quantity_employees')]) !!}
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
				</div>
			</div>				

			<!--PASO 2 | INFORMACION DE CONTAINER-->
			<!--PASO 2-1 | DETALLES PERSONALES-->
			<div class="formContainer-confirm validate-four-input" id="paso2-1">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>@lang('app.personal_details')</h4>
				</div>
				
				<!--DESCRIPCION PERSONAL/COMPAÑIA-->
				<div class="itemForm">
					<label>@lang('app.description_p_c')</label>
                    {!! Form::textarea('description', '', ['message' => trans('app.description_required'), 'class' => 'validate-four', 'id' => 'description', 'placeholder' => trans('app.description'), 'cols' => '30', 'rows' => '10']) !!}
				</div>

				<!--AÑOS DE RECLUTAMIENTO-->
				<div class="itemForm">
					<label for="years_recruitment_id">@lang('app.years_recruitment')</label>
                    {!! Form::select('years_recruitment_id', $experienceYears , '', ['message' => trans('app.years_recruitment_required'), 'class' => 'validate-four browser-default', 'id' => 'years_recruitment_id', 'placeholder' => trans('app.years_industry')]) !!}
				</div>

				<!--NIVEL DE EDUCACIÓN-->
				<div class="itemForm">
					<label for="education_level_id">@lang('app.education_level')</label>
					{!! Form::select('education_level_id', $educationLevels , '', ['message' => trans('app.education_level_required'), 'class' => 'validate-four browser-default', 'id' => 'education_level_id', 'placeholder' => trans('app.education_level')]) !!}
				</div>

				<!--ESCUELAS ASISTIDAS-->
				<div class="itemForm">
					<label>@lang('app.assisted_schools')</label>
					{!! Form::text('assisted_schools', '', ['id' => 'assisted_schools', 'placeholder' => trans('app.assisted_schools')]) !!}
				</div>

				<!--MEMBRESIAS-->
				<div class="itemForm">
					<label>@lang('app.memberships')</label>
					{!! Form::text('memberships', '', ['id' => 'memberships', 'placeholder' => trans('app.memberships')]) !!}
				</div>

				<!--CERTIFICACION-->
				<div class="itemForm">
					<label>@lang('app.certification')</label>
					{!! Form::select('select-certificado', $educationLevels , '', ['class' => 'browser-default', 'id' => 'select-certificado', 'placeholder' => trans('app.select')]) !!}
					<div id="new-certify"></div>
					<!--AGREGAR OTRA CERTIFICACION-->
					<p><a href="#!" id="btn-certificado">@lang('app.add_certification')</a></p>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>	
			</div>

			<!--PASO 2-2 | ESPECIALIZACION-->
			<div class="formContainer-confirm" id="paso2-2">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>@lang('app.especialization')</h4>
				</div>

				<!-- SELECTORES DE CATEGORIAS -->
				<div class="categoria-container">
					<!--CATEGORIA 1-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.industry')</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select">
							<!--ITEM 1-->
							@foreach($industries as $key => $ind)
							<li value="{{$key}}">
								<a href="#!">
									<p>{{$ind}}</p>
								</a>
							</li>
							@endforeach
						</ul>
					</div>

					<!--CATEGORIA 2-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.functional_area')</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select">
							<!--ITEM 1-->
							@foreach($functionalArea as $key => $fun)
								<li value="{{$key}}">
									<a href="#!">
										<p style="text-transform: capitalize;">{{strtolower($fun)}}</p>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
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
					{!! Form::select('security_question1', $securityQuestions , '', ['class' => 'browser-default', 'id' => 'security_question1', 'placeholder' => trans('app.security_question')]) !!}
				</div>

				<!--RESPUESTA 1 A PREGUNTA DE SEGURIDAD-->
				<div class="itemForm">
					<label>@lang('app.answer') 1</label>
					{!! Form::text('answer1', '', ['id' => 'answer1', 'placeholder' => trans('app.answer')]) !!}
				</div>

				<!--PREGUNTA DE SEGURIDAD 2-->
				<div class="itemForm">
					<label>@lang('app.security_question') 2</label>
					{!! Form::select('security_question2', $securityQuestions , '', ['class' => 'browser-default', 'id' => 'security_question2', 'placeholder' => trans('app.security_question')]) !!}
				</div>

				<!--RESPUESTA 2 A PREGUNTA DE SEGURIDAD-->
				<div class="itemForm">
					<label>@lang('app.answer') 2</label>
					{!! Form::text('answer2', '', ['id' => 'answer2', 'placeholder' => trans('app.answer')]) !!}
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
				      <label for="receive_messages">@lang('app.confirm_send_emails')</label>
				    </p>
				</div>
			</div>

			<!--PASO 4 | INFORMACION LEGAL-->
			<!--PASO 4-1 | INFORMACION LEGAL-->
			<div class="formContainer-confirm validate-six-input" id="paso4-1">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>@lang('app.legal_information')</h4>
				</div>

				<!--PRIMER NOMBRE LEGAL-->
				<div class="itemForm">
					<label>@lang('app.legal_first_name')</label>
					{!! Form::text('legal_first_name', '', ['message' => trans('app.first_name_required'), 'class' => 'validate-six', 'id' => 'legal_first_name', 'placeholder' => trans('app.legal_first_name')]) !!}
				</div>

				<!--APELLIDO LEGAL-->
				<div class="itemForm">
					<label>@lang('app.legal_last_name')</label>
					{!! Form::text('legal_last_name', '', ['message' => trans('app.last_name_required'), 'class' => 'validate-six', 'id' => 'legal_last_name', 'placeholder' => trans('app.legal_last_name')]) !!}
				</div>

				<!--NOMBRE LEGAL-->
				<div class="itemForm">
					<label>@lang('app.legal_company_name')</label>
					{!! Form::text('legal_company_name', '', ['message' => trans('app.company_required'), 'class' => 'validate-six', 'id' => 'legal_company_name', 'placeholder' => trans('app.legal_company_name')]) !!}
				</div>

				<!--TIPO DE COMPAÑIA-->
				<div class="itemForm">
					<label>@lang('app.company_type')</label>
	                {!! Form::select('company_type', $contacts, '', ['message' => trans('app.company_type_required'), 'class' => 'validate-six browser-default', 'id' => 'company_type', 'placeholder' => trans('app.choose_type')]) !!}
				</div>

				<!--DIVISA PRINCIPAL-->
				<div class="itemForm">
					<label>@lang('app.principal_coin')</label>
					{!! Form::select('principal_coin', $currencies , '', ['message' => trans('app.principal_coin_required'), 'class' => 'validate-six browser-default', 'id' => 'principal_coin', 'placeholder' => trans('app.principal_coin')]) !!}
				</div>

				<!--PAIS-->
	            <div class="itemForm">
					<label>@lang('app.country')</label>
	                {!! Form::select('country_id2', $countries, '', ['message' => trans('app.country_required'), 'class' => 'validate-six browser-default', 'id' => 'country_id2', 'placeholder' => trans('app.choose_country')]) !!}
	            </div>

				<!--PROVINCIA-->
				<div class="itemForm">
                    <label for="state2">@lang('app.state_province')</label>
                    {!! Form::select('state2', [] , Input::old('state2'), ['message' => trans('app.state_required'), 'class' => 'validate-six browser-default', 'id' => 'state2', 'placeholder' => trans('app.choose_province')]) !!}
				</div>

				<!--CIUDAD-->
				<div class="itemForm">
                    <label for="city2">@lang('app.city')</label>
                    {!! Form::text('city2', '', ['message' => trans('app.city_required'), 'class' => 'validate-six', 'id' => 'city2', 'placeholder' => trans('app.city')]) !!}
				</div>

				<!--DIRECCION-->
				<div class="itemForm">
					<label>@lang('app.address')</label>
                    {!! Form::textarea('address2', '', ['message' => trans('app.address_required'), 'class' => 'validate-six', 'id' => 'address2', 'placeholder' => trans('app.address'), 'cols' => '30', 'rows' => '10']) !!}
				</div>

				<!--DIRECCION 2-->
				<div class="itemForm">
					<label>@lang('app.complement')</label>
                    {!! Form::text('complement2', '', ['id' => 'complement2', 'placeholder' => trans('app.complement')]) !!}
				</div>

				<!--CODIGO POSTAL-->
				<div class="itemForm">
					<label>@lang('app.zip_code')</label>
                    {!! Form::text('zip_code2', '', ['message' => trans('app.zipcode_required'), 'class' => 'validate-six', 'id' => 'zip_code2', 'placeholder' => trans('app.zip_code')]) !!}
				</div>

				<!--CONDICIONES DE USO-->
				<div class="condiciones-uso">
					<h4>@lang('app.terms_of_use')</h4>
					<div class="condiciones-uso-container">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus veritatis quisquam, dignissimos distinctio, eos repellendus dolore ab quasi repellat voluptates ex vitae minima tempore commodi non repudiandae earum. Rem, molestiae!</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere enim, voluptas impedit culpa ut debitis dolorem. Suscipit dolore, tempore architecto id ipsam sequi, sint ab earum ullam libero ducimus vel.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere enim, voluptas impedit culpa ut debitis dolorem. Suscipit dolore, tempore architecto id ipsam sequi, sint ab earum ullam libero ducimus vel.</p>
					</div>
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="accept_terms_cond" checked="checked" />
				      <label for="accept_terms_cond">* @lang('app.accept_terms_of_use')</label>
				    </p>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>
			</div>

			<!--PASO 4-2 | ULTIMO PASO-->
			<div class="formContainer-confirm" id="paso4-2">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>@lang('app.last_step')</h4>
				</div>

				<!--TIENES UN CODIGO PROMOCIONAL-->
				<div class="itemRadio">
					<h4>@lang('app.do_you_have_promotional')</h4>
					<div class="itemRadio-radio">
						<p>
							<input name="group1" type="radio" id="test1" />
							<label for="test1">@lang('app.yes')</label>
						</p>
						<p>
							<input name="group1" type="radio" id="test2" checked/>
							<label for="test2">@lang('app.no')</label>
						</p>
					</div>
				</div>

				<!--CODIGO PROMOCIONAL-->
				<div class="itemForm" id="promotional_code_item">
					<label>@lang('app.promotional_code')</label>
                    {!! Form::text('promotional_code', '', ['id' => 'promotional_code', 'placeholder' => trans('app.promotional_code')]) !!}
				</div>

				<!--COMO SUPISTE DE NOSOTROS-->
				<div class="itemForm">
					<label>@lang('app.how_did_you_hear_about_us')</label>
	                {!! Form::select('contact_id', $contacts, '', ['class' => 'browser-default', 'id' => 'contact_id', 'placeholder' => trans('app.how_did_you_hear_about_us')]) !!}
				</div>

				<!--PAPEL EN LA ORGANIZACION-->
				<div class="itemRadio">
					<h4>@lang('app.your_organization_role')</h4>
					<div class="itemRadio-radio target_r">
						<p>
							<input name="group2" type="radio" id="test3" value="recruitment" />
							<label for="test3">@lang('app.recruitment')</label>
						</p>
						<p>
							<input name="group2" type="radio" id="test4" value="business" />
							<label for="test4">@lang('app.business')</label>
						</p>
						<p>
							<input name="group2" type="radio" id="test5" value="both" />
							<label for="test5">@lang('app.both')</label>
						</p>
					</div>

                    {!! Form::hidden('organization_role', null, ['id' => 'organization_role']) !!}
				</div>

				<!--PRINCIPALES MEDIOS DE ABASTECIMIENTO-->
				<div class="itemForm">
					<label for="sourcing_networks_id">@lang('app.principal_sourcing')</label>					
					{!! Form::select('sourcing_networks_id', $sourcingNetworks , '', ['class' => 'browser-default', 'id' => 'sourcing_networks_id', 'placeholder' => trans('app.sourcing_networks')]) !!}
				</div>	

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
				</div>		
			</div>

			<!--PASO 4-3 | MENSAJE FINAL-->
			<div class="formContainer-confirm" id="paso4-3">
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
			<div class="move-link" id="btn-return-confirm1">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm1">
				<a href="#!" class="btn-main validate" id="validate-one">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 1-2 a 1-3 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm2">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm2">
				<a href="#!" class="btn-main validate" id="validate-two">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 1-3 a 2-1 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm3">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm3">
				<a href="#!" class="btn-main validate" id="validate-tres">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 2-1 a 2-2 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm4">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm4">
				<a href="#!" class="btn-main validate" id="validate-four" >@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 2-2 a 3 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm5">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm5">
				<a href="#!" class="btn-main" id="validate-select">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 3 a 4-1 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm6">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm6">
				<a href="#!" class="btn-main">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 4-1 a 4-2 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm7">
				<a href="#!" class="btn-return">@lang('app.last_step_s')</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm7">
				<a href="#!" class="btn-main validate" id="validate-six">@lang('app.next_step_s')</a>
			</div>

			<!-- PASO 4-2 a 4-3 -->
			<!--next-->
			<div class="move-link" id="btn-next-confirm8">
				<a href="#!" class="btn-main" >@lang('app.next_step_s')</a>
			</div>
		</section>			

	</article>
@stop

@section('scripts')
    <script type="text/javascript">
		$(document).ready(function(){
		    $('#validate-select').click(function(e){
		        var validate = false;
				$('.categoria-container-item ul li a').each(function(){
				   if($(this).hasClass('active-option')){
				       validate = true;
				   }
				});
				if(!validate){
                    e.preventDefault();
                    e.stopPropagation();
                    $('.categoria-container-item').parent().append('<p class="text-darger" style="color:red; text-align: right; font-style: italic;">{{trans("app.you_must_select_a_specialization")}}</p>');
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

                }else{
                  sweetAlert('Oops...'+'{{ trans('app.the_country_has_no_provinces') }}', '{{ trans('app.select_another_country') }}', 'error');
                }
              }, 'json');
        }
    </script>
@stop