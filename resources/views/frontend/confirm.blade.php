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
					<h4>@lang('app.contact_informations')</h4>
					<p>@lang('app.correct_your_personal_data')</p>
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
                    {!! Form::text('email', $user->email, ['readonly' => 'readonly', 'message' => trans('app.email_required'), 'class' => 'validate-one', 'id' => 'email', 'placeholder' => trans('app.email')]) !!}
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

				<!--PAIS-->
				<div class="itemForm">
					<label>@lang('app.country')</label>
					{!! Form::select('country_id2', $countries, '', ['message' => trans('app.country_required'), 'class' => 'validate-tres browser-default', 'id' => 'country_id2', 'placeholder' => trans('app.choose_country')]) !!}
				</div>

				<div class="itemForm">
					<label>@lang('app.state_province')</label>
					{!! Form::text('state2', '', ['message' => trans('app.state_required'), 'id' => 'state2', 'placeholder' => trans('app.state_province'), 'class' => 'validate-tres']) !!}
				</div>

				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
                    <label for="quantity_employees_id">@lang('app.size_company')</label>
                    {!! Form::select('quantity_employees_id', $quantityEmployees , '', ['message' => trans('app.quantity_employees_required'), 'class' => 'validate-tres browser-default', 'id' => 'quantity_employees_id', 'placeholder' => trans('app.choose_quantity_employees')]) !!}
				</div>


				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
					<label for="quantity_employees_id">@lang('app.current_job_title')</label>
					{!! Form::select('actual_position_id', $positions , '', ['message' => trans('app.current_job_required'), 'class' => 'validate-tres browser-default', 'id' => 'actual_position_id', 'placeholder' => trans('app.choose_actual_position')]) !!}
				</div>

				<div class="categoria-container">
					<!--CATEGORIA 1-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.search_type_share')</h3>
							<span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select searchType">
							<!--ITEM 1-->
								@foreach($searchTypeShared as $key => $se)
								<li value="{{$key}}">
									<a href="#!">
										<p>{{$se}}</p>
									</a>
								</li>
								@endforeach

							<input type="hidden" name="searchType" id="searchType">
						</ul>
					</div>
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.search_type_work')</h3>
							<span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select searchTypeWork">
							<!--ITEM 1-->
							@foreach($searchTypeInvolved as $key => $se)
								<li value="{{$key}}">
									<a href="#!">
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="searchTypeWork" id="searchTypeWork">
						</ul>
					</div>
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.opportunity_share')</h3>
							<span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select opportunityShare">
							<!--ITEM 1-->
							@foreach($opportunityShared as $key => $se)
								<li value="{{$key}}">
									<a href="#!">
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="opportunityShare" id="opportunityShare">
						</ul>
					</div>
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.opportunity_work')</h3>
							<span class="hint--right hint--large hint--bounce" aria-label="Campo Importante!">
								<i class="icon-gTalents_help "></i>
							</span>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select opportunityInvolved">
							<!--ITEM 1-->
							@foreach($opportunityInvolved as $key => $se)
								<li value="{{$key}}">
									<a href="#!">
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="opportunityInvolved" id="opportunityInvolved">
						</ul>
					</div>
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

			<!--PASO 2-2 | ESPECIALIZACION-->
			<div class="formContainer-confirm validate-select-input" id="paso2-2">
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
						<ul class="subopciones subopciones-select industries">
							<!--ITEM 1-->
							@foreach($industries as $key => $ind)
							<li value="{{$key}}">
								<a href="#!">
									<p>{{$ind}}</p>
								</a>
							</li>
							@endforeach
							<input type="hidden" name="industries" id="industries">
						</ul>
					</div>

					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.ubication_region')</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select location">
							<!--ITEM 1-->
							@foreach($regions as $key => $ind)
								<li value="{{$key}}">
									<a href="#!">
										<p>{{$ind}}</p>
									</a>
								</li>
							@endforeach
							<input type="hidden" name="location" id="location">
						</ul>
					</div>

					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.roles')</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select rol">
							<!--ITEM 1-->
							<li value="1">
								<a href="#!">
									<p>Acct Mgmnt</p>
								</a>
							</li>
							<li value="2">
								<a href="#!">
									<p>Researcher</p>
								</a>
							</li>
							<li value="3">
								<a href="#!">
									<p>Sourcer</p>
								</a>
							</li>
							<li value="4">
								<a href="#!">
									<p>Líder de área</p>
								</a>
							</li>
							<li value="5">
								<a href="#!">
									<p>Cold-Calling</p>
								</a>
							</li>
							<input type="hidden" name="rol" id="rol">
						</ul>
					</div>

					<div class="itemForm">
						<label for="cases_numbers_id">@lang('app.cases_numbers')</label>
						{!! Form::select('cases_numbers_id', $cases_numbers , '', ['message' => trans('app.cases_numbers_required'), 'class' => 'validate-select browser-default', 'id' => 'cases_numbers_id', 'placeholder' => trans('app.cases_numbers')]) !!}
					</div>

					<!--CATEGORIA 2-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.level_positions')</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select positi">
							<!--ITEM 1-->
							@foreach($level_positions as $key => $fun)
								<li value="{{$key}}">
									<a href="#!">
										<p style="text-transform: capitalize;">{{strtolower($fun)}}</p>
									</a>
								</li>
							@endforeach
							<input type="hidden" name="positi" id="positi">
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
						<ul class="subopciones subopciones-select funcala">
							<!--ITEM 1-->
							@foreach($functionalArea as $key => $fun)
								<li value="{{$key}}">
									<a href="#!">
										<p style="text-transform: capitalize;">{{strtolower($fun)}}</p>
									</a>
								</li>
							@endforeach
							<input type="hidden" name="funcala" id="funcala">
						</ul>
					</div>
				</div>

				<div class="itemForm">
					<label for="years_experience_id">@lang('app.years_of_experience')</label>
					{!! Form::select('years_experience_id', $experienceYears , '', ['message' => trans('app.years_experience_required'), 'class' => 'validate-select browser-default', 'id' => 'years_experience_id', 'placeholder' => trans('app.years_of_experience')]) !!}
				</div>

                <div class="itemForm">
                    <label for="sourcing_networks_id">@lang('app.principal_sourcing')</label>
                    {!! Form::select('sourcing_networks_id', $sourcingNetworks , '', ['message' => trans('app.sourcing_required'), 'class' => 'validate-select browser-default', 'id' => 'sourcing_networks_id', 'placeholder' => trans('app.sourcing_networks')]) !!}
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
					<h4>@lang('app.notifications')</h4>
					<p>@lang('app.norifications_comment1')</p>
				</div>
				<!--PASSWORD-->
				<div class="itemForm">
					<label>@lang('app.password')</label>
					<input type="password" name="password" id="password" placeholder="@lang('app.password')">
				</div>

				<!--CONFIRM PASSWORD-->
				<div class="itemForm">
					<label>@lang('app.confirm_password')</label>
					<input type="password" name="password_confirmation" id="password_confirmation" placeholder="@lang('app.confirm_password')">
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
				      <label for="receive_messages">@lang('app.confirm_send_emails')</label>
				    </p>
				</div>
				<div class="itemCheck">
					<p>
						<input type="checkbox" class="filled-in" id="receive_messages" checked="checked" />
						<label for="receive_messages">@lang('app.confirm_send_vacancies')</label>
					</p>
				</div>
			</div>

			<!--PASO 4 | INFORMACION LEGAL-->
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

                <!--CODIGO PROMOCIONAL-->
                <div class="itemForm" id="reference_item">
                    <label>@lang('app.reference')</label>
                    {!! Form::text('reference', '', ['id' => 'reference', 'placeholder' => trans('app.reference')]) !!}
                </div>

				<!--PAPEL EN LA ORGANIZACION-->
                {!! Form::hidden('organization_role', 'both', ['id' => 'organization_role']) !!}

                <div class="itemForm">
                    <label for="sourcing_networks_id">@lang('app.principal_sourcing_candidates')</label>
                    {!! Form::select('sourcing_networks_candidates_id', $sourcingNetworks , '', ['class' => 'browser-default', 'id' => 'sourcing_networks_candidates_id', 'placeholder' => trans('app.principal_sourcing_candidates')]) !!}
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
				<a href="#!" class="btn-main validate" id="validate-select">@lang('app.next_step_s')</a>
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

			industries = new Array();
			funcala = new Array();
            rol = new Array();
            positi = new Array();
            locat = new Array();
            $('.subopciones-select li').click(function(){
                $('#validate-especialization').remove();
                if($(this).parent().hasClass('industries')){
                    if($(this).find('a').hasClass('active-option')){
                        industries.push($(this).attr('value'));
                    } else {
                        industries = industries.toString();
                        industries = industries.replace(','+$(this).attr('value'), '');
                        industries = industries.replace($(this).attr('value')+',', '');
                        industries = industries.split(',');
                    }
                    console.log(industries);
                    $('#industries').val(industries.toString());
                }
                if($(this).parent().hasClass('funcala')){
                    if($(this).find('a').hasClass('active-option')){
                        funcala.push($(this).attr('value'));
                    } else {
                        funcala = funcala.toString();
                        funcala = funcala.replace(','+$(this).attr('value'), '');
                        funcala = funcala.replace($(this).attr('value')+',', '');
                        funcala = funcala.split(',');
                    }
                    console.log(funcala);
                    $('#funcala').val(funcala.toString());
                }
                if($(this).parent().hasClass('rol')){
                    if($(this).find('a').hasClass('active-option')){
                        rol.push($(this).attr('value'));
                    } else {
                        rol = rol.toString();
                        rol = rol.replace(','+$(this).attr('value'), '');
                        rol = rol.replace($(this).attr('value')+',', '');
                        rol = rol.split(',');
                    }
                    console.log(rol);
                    $('#rol').val(rol.toString());
                }
                if($(this).parent().hasClass('positi')){
                    if($(this).find('a').hasClass('active-option')){
                        positi.push($(this).attr('value'));
                    } else {
                        positi = positi.toString();
                        positi = positi.replace(','+$(this).attr('value'), '');
                        positi = positi.replace($(this).attr('value')+',', '');
                        positi = positi.split(',');
                    }
                    console.log(positi);
                    $('#funcala').val(positi.toString());
                }
                if($(this).parent().hasClass('location')){
                    if($(this).find('a').hasClass('active-option')){
                        locat.push($(this).attr('value'));
                    } else {
                        locat = locat.toString();
                        locat = locat.replace(','+$(this).attr('value'), '');
                        locat = locat.replace($(this).attr('value')+',', '');
                        locat = locat.split(',');
                    }
                    console.log(locat);
                    $('#location').val(locat.toString());
                }
            });
            /*
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
                    if(!document.getElementById('validate-especialization')){
                        $('.categoria-container-item').parent().append('<p id="validate-especialization" class="text-darger" style="color:red; text-align: right; font-style: italic;">{{trans("app.you_must_select_a_specialization")}}</p>');
					}
				}
			});*/
/*
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
            });*/

            $('#legal_company_name').val($('#company_name').val());
			$('#legal_first_name').val($('#first_name').val());
			$('#legal_last_name').val($('#last_name').val());
            $('#country_id2').val($('#country_id').val());
            $('#state2').val($('#state').val());
            $('#city2').val($('#city').val());
            $('#address2').val($('#address').val());
            $('#complement2').val($('#complement').val());
            $('#zip_code2').val($('#zip_code').val());


		   $('#first_name').keyup(function(){
               $('#legal_first_name').val($(this).val());
		   });

            $('#last_name').keyup(function(){
                $('#legal_last_name').val($(this).val());
            });

            $('#company_name').keyup(function(){
                $('#legal_company_name').val($(this).val());
            });



            $('#city').keyup(function(){
                $('#city2').val($(this).val());
            });

            $('#address').keyup(function(){
                $('#address2').val($(this).val());
            });

            $('#complement').keyup(function(){
                $('#complement2').val($(this).val());
            });

            $('#zip_code').keyup(function(){
                $('#zip_code2').val($(this).val());
            });

            $('#state').change(function(){
                $('#state2').val($(this).val());
            });
		});

    	$('#promotional_code_item').hide();
        $('#reference_item').hide();
		
		$("#test1").on( "click", function() {
    		$('#promotional_code_item').show("slow");
		});
		
		$("#test2").on( "click", function() {
    		$('#promotional_code_item').hide("slow");
    		$('#promotional_code').val("");
		});

		$('#contact_id').change(function () {
		    if($(this).val() == 3){
                $('#reference_item').show("slow");
            } else {
                $('#reference_item').hide("slow");
            }
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
            $('#country_id2').val(country);
            var state = 'state';
            getStates(country, state);
            var state = 'state2';
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