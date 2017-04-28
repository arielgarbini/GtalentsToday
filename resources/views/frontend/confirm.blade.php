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
		{!! Form::open(['route' => ['completeData', $token], 'files' => true, 'id' => 'form-confirm', 'class' => 'formLogin login', 'name' => 'form-register']) !!}
			<!--PASO 1 | INFORMACION DE CONTAINER-->

			<!--PASO 1-1 | DETALLES DE CONTACTO-->
		<input type="hidden" name="autoSave" value="0" id="autoSave">
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

                    {!! Form::input('text', 'phones', $user->phone, ['message' => trans('app.telf_required'),'class' => 'solo-numero validate-one phone', 'id' => 'phone', 'placeholder' => trans('app.principal_phone')]) !!}
					<input type="hidden" name="phone" id="phone1" value="{{$user->phone}}">
				</div>

				<!--TELEFONO SECUNDARIO-->
				<div class="itemForm">
                    <label for="secundary_phone">@lang('app.secundary_phone')</label>
                    {!! Form::input('text', 'secundary_phones', $user->secundary_phone, ['id' => 'secundary_phone', 'placeholder' => trans('app.secundary_phone'), 'class' => 'solo-numero phone']) !!}
					<input type="hidden" name="secundary_phone" id="phone2" value="{{$user->secundary_phone}}">
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
                    {!! Form::text('company_name', ($company!='') ? $company->name : '', ['message' => trans('app.company_required'), 'class' => 'validate-tres', 'id' => 'company_name', 'placeholder' => trans('app.company_name')]) !!}
				</div>

				<!--WEBSITE-->
				<div class="itemForm">
					<label>@lang('app.website')</label>
                    {!! Form::text('website', ($company!='') ? $company->website : '', ['id' => 'website', 'placeholder' => trans('app.website')]) !!}
				</div>

				<!--PAIS-->
				<div class="itemForm">
					<label>@lang('app.country')</label>
					{!! Form::select('country_id2', $countries, ($address!='') ? $address->address : '', ['message' => trans('app.country_required'), 'class' => 'validate-tres browser-default', 'id' => 'country_id2', 'placeholder' => trans('app.choose_country')]) !!}
				</div>

				<div class="itemForm">
					<label>@lang('app.state_province')</label>
					{!! Form::text('state2', ($address!='') ? $address->city : '', ['message' => trans('app.state_required'), 'id' => 'state2', 'placeholder' => trans('app.state_province'), 'class' => 'validate-tres']) !!}
				</div>

				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
                    <label for="quantity_employees_id">@lang('app.size_company')</label>
                    {!! Form::select('quantity_employees_id', $quantityEmployees , ($company!='') ? $company->quantity_employees_id : '', ['message' => trans('app.quantity_employees_required'), 'class' => 'validate-tres browser-default', 'id' => 'quantity_employees_id', 'placeholder' => trans('app.choose_quantity_employees')]) !!}
				</div>


				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
					<label for="quantity_employees_id">@lang('app.current_job_title')</label>
					{!! Form::select('actual_position_id', $positions , ($profile!='') ? $profile->actual_position_id : '', ['message' => trans('app.current_job_required'), 'class' => 'validate-tres browser-default', 'id' => 'actual_position_id', 'placeholder' => trans('app.choose_actual_position')]) !!}
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
									<a href="#!" @if(in_array($se, $type1_name)) class="active-option" @endif>
										<p>{{$se}}</p>
									</a>
								</li>
								@endforeach

							<input type="hidden" name="searchType" id="searchType" value="{{implode(',',$type1_id)}}">
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
									<a href="#!" @if(in_array($se, $type2_name)) class="active-option" @endif>
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="searchTypeWork" id="searchTypeWork" value="{{implode(',',$type2_id)}}">
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
									<a href="#!" @if(in_array($se, $type3_name)) class="active-option" @endif>
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="opportunityShare" id="opportunityShare" value="{{implode(',',$type3_id)}}">
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
									<a href="#!" @if(in_array($se, $type4_name)) class="active-option" @endif>
										<p>{{$se}}</p>
									</a>
								</li>
							@endforeach

							<input type="hidden" name="opportunityInvolved" id="opportunityInvolved" value="{{implode(',',$type4_id)}}">
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
						<div class="itemForm">
							<input type="search" style="display: none; width: 50% !important; position: relative; left: 20px;" class="search" >
						</div>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select industries" style="max-height: 200px; overflow: auto;">
							<!--ITEM 1-->
							@foreach($industries as $key => $ind)
								<li value="{{$key}}">
									<a href="#!" @if(in_array($ind, $industries_name)) class="active-option" @endif>
										<p>{{$ind}}</p>
									</a>
								</li>
							@endforeach
							<input type="hidden" name="industries" id="industries" value="{{implode(',',$industries_id)}}">
						</ul>
					</div>

					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>@lang('app.ubication_region')</h3>
						</a>

						<div class="itemForm">
							<input type="search" style="display: none; width: 50% !important; position: relative; left: 20px;" class="search" >
						</div>
						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones subopciones-select location" style="max-height: 200px; overflow: auto;">
							<!--ITEM 1-->
							@foreach($regions as $key => $ind)
								<li value="{{$key}}">
									<a href="#!" @if(in_array($ind, $region_name)) class="active-option" @endif>
										<p>{{$ind}}</p>
									</a>
								</li>
							@endforeach
							<input type="hidden" name="location" id="location" value="{{implode(',',$region_id)}}">
						</ul>
					</div>
				</div>

				<div class="itemForm">
					<label for="years_experience_id">@lang('app.job_title')</label>
					{!! Form::select('job_title_id', $jobTitle , ($profile!='') ? $profile->jobtitle_id : '', ['message' => trans('app.job_title_id_required'), 'class' => 'validate-select browser-default', 'id' => 'job_title_id', 'placeholder' => trans('app.job_title')]) !!}
				</div>

				<!--CODIGO PROMOCIONAL-->
				<div class="itemForm" id="reference_job_title">
					<label>@lang('app.reference_job')</label>
					{!! Form::text('reference_job', ($profile!='') ? $profile->reference_job : '', ['id' => 'reference_job', 'placeholder' => trans('app.reference_job')]) !!}
				</div>

				<div class="itemForm">
					<label for="years_experience_id">@lang('app.current_company')</label>
					{!! Form::text('current_company', ($profile!='') ? $profile->current_company : '' , ['class' => 'validate-select', 'message' => trans('app.current_company_required'), 'id' => 'current_company', 'placeholder' => trans('app.current_company')]) !!}
				</div>

				<div class="itemForm">
					<label for="years_experience_id">@lang('app.years_of_experience')</label>
					{!! Form::select('years_experience_id', $experienceYears , ($profile!='') ? $profile->years_experience_id : '', ['message' => trans('app.years_experience_required'), 'class' => 'validate-select browser-default', 'id' => 'years_experience_id', 'placeholder' => trans('app.years_of_experience')]) !!}
				</div>

				<div class="itemForm">
					<label for="years_experience_id">@lang('app.linkedin')</label>
					{!! Form::text('linkedin', ($profile!='') ? $profile->linkedin_url : '' , ['id' => 'linkedin', 'placeholder' => trans('app.linkedin')]) !!}
				</div>

				<div class="itemForm">
					<label for="sourcing_networks_id">@lang('app.principal_sourcing')</label>
					{!! Form::select('sourcing_networks_candidates_id', $sourcingNetworks , ($preferences!='') ? $preferences->sourcing_network_id : '', ['class' => 'browser-default', 'id' => 'sourcing_networks_candidates_id', 'placeholder' => trans('app.principal_sourcing')]) !!}
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
	                {!! Form::select('contact_id', $contacts, ($preferences!='') ? $preferences->contact_id : '', ['class' => 'browser-default', 'id' => 'contact_id', 'placeholder' => trans('app.how_did_you_hear_about_us')]) !!}
				</div>

                <!--CODIGO PROMOCIONAL-->
                <div class="itemForm" id="reference_item">
                    <label>@lang('app.reference')</label>
                    {!! Form::text('reference', ($preferences!='') ? $preferences->reference : '', ['id' => 'reference', 'placeholder' => trans('app.reference')]) !!}
                </div>

				<!--PAPEL EN LA ORGANIZACION-->
                {!! Form::hidden('organization_role', 'both', ['id' => 'organization_role']) !!}

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
            opportunityShare = new Array();
            opportunityInvolved = new Array();
            searchType = new Array();
            searchTypeWork = new Array();
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
                        industries = industries.replace($(this).attr('value'), '');
                        if(industries!=''){
                            industries = industries.split(',');
						} else {
                            industries = new Array();
						}
                    }
                    console.log(industries);
                    $('#industries').val(industries.toString());
                }
                if($(this).parent().hasClass('opportunityShare')){
                    if($(this).find('a').hasClass('active-option')){
                        opportunityShare.push($(this).attr('value'));
                    } else {
                        opportunityShare = opportunityShare.toString();
                        opportunityShare = opportunityShare.replace(','+$(this).attr('value'), '');
                        opportunityShare = opportunityShare.replace($(this).attr('value')+',', '');
                        opportunityShare = opportunityShare.replace($(this).attr('value'), '');
                        if(opportunityShare!=''){
                            opportunityShare = opportunityShare.split(',');
                        } else {
                            opportunityShare = new Array();
                        }
                    }
                    console.log(opportunityShare);
                    $('#opportunityShare').val(opportunityShare.toString());
                }
                if($(this).parent().hasClass('opportunityInvolved')){
                    if($(this).find('a').hasClass('active-option')){
                        opportunityInvolved.push($(this).attr('value'));
                    } else {
                        opportunityInvolved = opportunityInvolved.toString();
                        opportunityInvolved = opportunityInvolved.replace(','+$(this).attr('value'), '');
                        opportunityInvolved = opportunityInvolved.replace($(this).attr('value')+',', '');
                        opportunityInvolved = opportunityInvolved.replace($(this).attr('value'), '');
                        if(opportunityInvolved!=''){
                            opportunityInvolved = opportunityInvolved.split(',');
                        } else {
                            opportunityInvolved = new Array();
                        }
                    }
                    console.log(opportunityInvolved);
                    $('#opportunityInvolved').val(opportunityInvolved.toString());
                }
                if($(this).parent().hasClass('searchType')){
                    if($(this).find('a').hasClass('active-option')){
                        searchType.push($(this).attr('value'));
                    } else {
                        searchType = searchType.toString();
                        searchType = searchType.replace(','+$(this).attr('value'), '');
                        searchType = searchType.replace($(this).attr('value')+',', '');
                        searchType = searchType.replace($(this).attr('value'), '');
                        if(searchType!=''){
                            searchType = searchType.split(',');
                        } else {
                            searchType = new Array();
                        }
                    }
                    console.log(searchType);
                    $('#searchType').val(searchType.toString());
                }
                if($(this).parent().hasClass('searchTypeWork')){
                    if($(this).find('a').hasClass('active-option')){
                        searchTypeWork.push($(this).attr('value'));
                    } else {
                        searchTypeWork = searchTypeWork.toString();
                        searchTypeWork = searchTypeWork.replace(','+$(this).attr('value'), '');
                        searchTypeWork = searchTypeWork.replace($(this).attr('value')+',', '');
                        searchTypeWork = searchTypeWork.replace($(this).attr('value'), '');
                        if(searchTypeWork!=''){
                            searchTypeWork = searchTypeWork.split(',');
                        } else {
                            searchTypeWork = new Array();
                        }
                    }
                    console.log(searchTypeWork);
                    $('#searchTypeWork').val(searchTypeWork.toString());
                }
                if($(this).parent().hasClass('location')){
                    if($(this).find('a').hasClass('active-option')){
                        locat.push($(this).attr('value'));
                    } else {
                        locat = locat.toString();
                        locat = locat.replace(','+$(this).attr('value'), '');
                        locat = locat.replace($(this).attr('value')+',', '');
                        locat = locat.replace($(this).attr('value'), '');
                        if(locat!=''){
                            locat = locat.split(',');
                        } else {
                            locat = new Array();
                        }
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

		    $('.validate').click(function(e){
                var validate = false;
                var vala = $(this).attr('id');
                $('.'+vala+'-input .'+vala).each(function(){
                    if($(this).val()==''){
                        validate = true;
                        var papa = $(this).parent();
                        if(!papa.hasClass('itemForm')){
                            papa = papa.parent();
                        }
                        if(!papa.find('.text-darger').attr('class')) {
                            papa.append('<p class="text-darger" style="color:red;">' + $(this).attr('message') + '</p>');
                            $(this).change(function () {
                                var papa = $(this).parent();
                                if(!papa.hasClass('itemForm')){
                                    papa = papa.parent();
                                }
                                if ($(this).val() != '') {
                                    papa.find('.text-darger').hide();
                                } else {
                                    papa.find('.text-darger').show();
                                }
                            });
                            $(this).keyup(function () {
                                var papa = $(this).parent();
                                if(!papa.hasClass('itemForm')){
                                    papa = papa.parent();
                                }
                                if ($(this).val() != '') {
                                    papa.find('.text-darger').hide();
                                } else {
                                    papa.find('.text-darger').show();
                                }
                            });
                        }
                    }
                });
                if(validate){
                    $(this).addClass('error-form');
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    $(this).removeClass('error-form');
				}
            });

            $('.move-link .btn-main').click(function(){
                if(!$(this).hasClass('error-form')){
                    data = new FormData();
                    $('#autoSave').val('1');
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
                    $.ajax({
						url: "{{route('completeData', $token)}}",
						method: 'POST',
						data: data,
                        processData: false,
                        processing: true,
                        serverSide: false,
                        contentType: false,
						success: function(response){
							console.log(response);
                            $('#autoSave').val('0');
						}
					});
				}
            });
		});

		phone_pais = '';

		$('#phone').change(function(){
            $('#phone1').val($('#phone').intlTelInput("getNumber"));
		});

        $("#phone").on("countrychange", function(e, countryData) {
            $('#phone1').val($('#phone').intlTelInput("getNumber"));
        });

        $('#secundary_phone').change(function(){
            $('#phone2').val($('#secundary_phone').intlTelInput("getNumber"));
        });

        $("#secundary_phone").on("countrychange", function(e, countryData) {
            $('#phone2').val($('#secundary_phone').intlTelInput("getNumber"));
        });

    	$('#promotional_code_item').hide();
        @if(($preferences!='') && $preferences->reference!='')
            	$('#reference_item').show();
		@else
		    	$('#reference_item').hide();
        @endif

		@if(($profile!='') && $profile->reference_job!='')
            $('#reference_job_title').show();
        @else
            $('#reference_job_title').hide();
		@endif

		
		$("#test1").on( "click", function() {
    		$('#promotional_code_item').show("slow");
		});
		
		$("#test2").on( "click", function() {
    		$('#promotional_code_item').hide("slow");
    		$('#promotional_code').val("");
		});

		$('#contact_id').change(function () {
		    if($(this).val() == 1 || $(this).val() == 4 || $(this).val() == 5){
                $('#reference_item').show("slow");
            } else {
                $('#reference_item').hide("slow");
                $('#reference').val("");
            }
        });

        $('#job_title_id').change(function () {
            if($(this).val() == 8){
                $('#reference_job_title').show("slow");
            } else {
                $('#reference_job_title').hide("slow");
                $('#reference_job').val("");
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