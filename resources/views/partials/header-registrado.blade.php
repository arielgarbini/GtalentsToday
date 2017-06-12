<!--HEADER USUARIO REGISTRADO-->
<header class="header-registered">
	<!--LOGOTIPO Y SELECTORES-->
	<section class="header-registered-container grid">
		<!--LOGOTIPO-->
		<div class="item-logo">
			<a href="{{ url('/') }}">
				<figure>
					<img src="{{asset('assets/img/logotipo.png') }}" alt="gtalents logotipo">
				</figure>
			</a>
		</div>

		<!-- OPCIONES GENERALES-->
		<ul class="item">
			<!--SELECT IDIOMAS-->
			<li>
				<div class="language">
					<select class="browser-default" onChange="window.location.href=this.value">
						<option value="">@lang('app.language')</option>
						<option value="{{ url('lang', ['es']) }}" {{ session('lang') == 'es' ? 'selected' : '' }}>@lang('app.spanish')</option>
						<option value="{{ url('lang', ['en']) }}" {{ session('lang') == 'en' ? 'selected' : '' }}>@lang('app.english')</option>
						<!--<option value="{{ url('lang', ['po']) }}">Portugues</option>-->
					</select>
				</div>
			</li>
			<!--LISTADO DE POST-->
			<li>
				<!--
				<a href="{{route('vacancies.list')}}">
					<p>@lang('app.opportunities')</p>
				</a>-->
			</li>
			<!--NUEVO POST-->
			<li class="item-newPost">
				<a href="{{ route('vacancies.create')}}">
					<p>@lang('app.new_opportunity')</p>
				</a>
			</li>
			<!--MENSAJES ALERT-->
			<li>
				<a href="{{route('message.indexFrontend')}}" @if($read_messages) class="messages-icon" @endif>
					<figure class="icon-message">
						<span class="icon-gTalents_message"></span>
					</figure>
					@if($read_messages)
						<figure class="icon-alert" id="messages-icon-point">
							<span class="icon-gTalents_point"></span>
						</figure>
					@endif
				</a>
			</li>
			<!--ALERTAS-->
			<li>
				<a href="#!" id="btn-alertNav" @if($read_notification) class="notifications-icon" @endif>
					<figure class="icon-message">
						<span class="icon-gTalents_alert"></span>
					</figure>
					@if($read_notification)
						<figure class="icon-alert" id="notifications-icon-point">
							<span class="icon-gTalents_point"></span>
						</figure>
					@endif
				</a>
			

					<!-- NOTIFICACIONES -->
				<div class="bills" id="alertNavContain">
					<!--ALERTAS-->
					<ul class="alerts-div">
						<!--ALERTA 1-->
                        @foreach($notifications as $notification)
							@if($notification->type=='request_supplier_vacancy')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('vacancies.show',$notification->post_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--ACEPTAR-->
									<form action="{{route('vacancies.approbate.supplier',$notification->post_id)}}" method="POST">
										{{csrf_field()}}
										<input type="hidden" value="{{$notification->id}}" name="notification">
										<span class="icon-gTalents_win-53 acept-alert send_form"></span>
									</form>
                                    <form action="{{route('vacancies.reject.supplier',$notification->post_id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$notification->id}}" name="notification">
                                        <input type="hidden" value="{{$notification->supplier_id}}" name="supplier">
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
									<!--BTN ELIMINAR -->
								</li>
							@elseif($notification->type=='invited_supplier_vacancy')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('vacancies.show',$notification->element_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--ACEPTAR-->
									<form action="{{route('vacancies.approbate.supplier.invited',$notification->element_id)}}" method="POST">
										{{csrf_field()}}
										<input type="hidden" value="{{$notification->id}}" name="notification">
										<input type="hidden" value="{{$notification->user_id}}" name="supplier">
										<span class="icon-gTalents_win-53 acept-alert send_form"></span>
									</form>
									<!--BTN ELIMINAR -->
									<form action="{{route('vacancies.reject.supplier.invited',$notification->element_id)}}" method="POST">
										{{csrf_field()}}
										<input type="hidden" value="{{$notification->id}}" name="notification">
										<input type="hidden" value="{{$notification->user_id}}" name="supplier">
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@elseif($notification->type=='approved_supplier_vacancy' || $notification->type=='rejected_supplier_vacancy' || $notification->type=='approbate_supplier_candidate' || $notification->type=='rejected_supplier_candidate')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('vacancies.post_user',$notification->element_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
								</li>
							@elseif($notification->type=='approved_supplier_invited_vacancy' || $notification->type=='rejected_supplier_invited_vacancy')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('vacancies.show',$notification->element_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>

							@elseif($notification->type=='request_supplier_candidates')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('vacancies.show',$notification->element_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@elseif($notification->type=='message_received')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('message.indexFrontend')}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@elseif($notification->type=='qualify_supplier_vacancy')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('califications.index')}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@elseif($notification->type=='qualify_supplier_vacancy_contract')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('supplier.calification_supplier', $notification->element_id)}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@elseif($notification->type=='get_points' || $notification->type=='promotion_received' || $notification->type=='vacancy_change_status_paused' || $notification->type=='vacancy_change_status_closed')
								<li class="alert-participar">
									<div class="motivo">
										<a href="{{route('dashboard')}}">
											<figure>
												<span class="icon-gTalents_point"></span>
											</figure>
											<div class="datos">
												<h4>{{$notification->title_traduccion}}</h4>
												<p>{{$notification->message_traduccion}}</p>
											</div>
										</a>
									</div>

									<!--BTN ELIMINAR -->
									<form action="{{route('notifications.delete',$notification->id)}}" method="POST">
										{{csrf_field()}}
										<span class="icon-gTalents_close close-alert send_form"></span>
									</form>
								</li>
							@endif
                        @endforeach
                    </ul>
				</div>
			</li>

			<!--USUARIO-->
			<li>
				<a class="btn dropdown-button" href="#!" data-activates="dropdown2">
					<span class="icon-gTalents_user"></span>
					<p>{{ Auth::user()->present()->name }}</p>
				</a>
				<ul id="dropdown2" class="dropdown-content">
					<li>
						<a href="{{ route('auth.profile') }}">@lang('app.profile')</a>
					</li>
					<li>
						<a href="{{ route('auth.logout') }}">@lang('app.logout')</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>

	<!--NAVEGACION-->
	<nav>
		<!--ICONO MENU MOBILE-->
		<div class="nav-mobile">
			<!--MENU HAMBURGUESA-->
			<div class="nav-mobile-item">
				<a href="#!" id="btn-menuHamburguer">
					<span class="icon-gTalents_hamburguesa hamburguer-1"></span>
					<span class="icon-gTalents_close-simple hamburguer-2"></span>
				</a>
			</div>
		</div>

		<!--<a class='dropdown-button btn' href='#' data-activates='dropdown1'>Drop Me!</a>-->

		<!-- Dropdown Structure -->
		<ul class="grid">
			<!--INICIO-->
			<li @if(Request::is('admin')) class="active" @endif>
				<a href="{{route('dashboard')}}">
					<p>@lang('app.home')</p>
				</a>
			</li>
			<!--MIS OPORTUNIDADES-->
			<li @if(Request::is('vacancies/list') || Request::is('vacancies/list/find') || Request::is('vacancies/list/poster') || Request::is('vacancies/list/suplier')) class="active" @endif>
				<a id="list-vacancies" class='dropdown-button' href='#' data-activates='dropdown4'>
					<p>@lang('app.my_opportunities')</p>
				</a>
				<ul id='dropdown4' class='dropdown-content'>
					<li><a href="{{route('vacancies.list','poster')}}">@lang('app.as_poster')</a></li>
					<li><a href="{{route('vacancies.list','supplier')}}">@lang('app.as_supplier')</a></li>
					<li><a href="{{route('vacancies.list','find')}}">@lang('app.find_new_opportunities')</a></li>
				</ul>
			</li>

			<li style="display:none;" class="list-vaca">
				<a href="{{route('vacancies.list','poster')}}">
					<p>@lang('app.as_poster')</p>
				</a>
			</li>

			<li style="display:none;" class="list-vaca">
				<a href="{{route('vacancies.list','supplier')}}">
					<p>@lang('app.as_supplier')</p>
				</a>
			</li>

			<li style="display:none;" class="list-vaca">
				<a href="{{route('vacancies.list','find')}}">
					<p>@lang('app.find_new_opportunities')</p>
				</a>
			</li>
			<!--MI EQUIPO-->
			<li @if(Request::is('team')) class="active" @endif>
				<a href="{{URL::to('team')}}">
					<p>@lang('app.my_team')</p>
				</a>
			</li>
			<!--MIS CANDIDATOS-->
			<li @if(Request::is('candidates')) class="active" @endif>
				<a href="{{URL::to('candidates')}}">
					<p>@lang('app.my_candidates')</p>
				</a>
			</li>
			<!--MIS FACTURAS-->
			<li @if(Request::is('invoices')) class="active" @endif>
				<a href="{{URL::to('invoices')}}">
					<p>@lang('app.my_invoices')</p>
				</a>
			</li>
			<!--MIS CALIFICACIONES-->
			<li @if(Request::is('califications')) class="active" @endif>
				<a href="{{URL::to('califications')}}">
					<p>@lang('app.my_qualifications')</p>
				</a>
			</li>
			<!--MIS CREDITOS-->
			<li @if(Request::is('credits')) class="active" @endif>
				<a href="{{URL::to('credits')}}">
					<p>@lang('app.my_credits')</p>
				</a>
			</li>
		</ul>
	</nav>
</header>