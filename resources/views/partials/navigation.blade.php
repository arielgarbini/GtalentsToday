<header class="header">
	<article class="header-container">
		
		<div class="row classRow">
			<div class="col m2">
				<!--logotipo-->
				<div class="item">
					<a href="{{ URL('/') }}">
						<figure>
							<img src="assets/img/logotipo.png" alt="gtalents logotipo">
						</figure>
					</a>
				</div>		
			</div>
			<div class="col m10">
				<!-- IDIOMAS - ACCESOS-->
				<nav>
					<!--SELECT IDIOMAS-->
					<div class="language">
						<select class="browser-default" onChange="window.location.href=this.value">
								<option value="">@lang('app.language')</option>
								<option value="{{ url('lang', ['es']) }}" {{ session('lang') == 'es' ? 'selected' : '' }}>@lang('app.spanish')</option>
								<option value="{{ url('lang', ['en']) }}" {{ session('lang') == 'en' ? 'selected' : '' }}>@lang('app.english')</option>
								<!--<option value="{{ url('lang', ['po']) }}">Portugues</option>-->
							</select>
					</div>

				
					<!-- LOGIN-REGISTER PARA MENORES DE 1297 -->
					<div class="btn-special-mobile">
						<!--ACCEDER-->
						<div class="item">
							<a href="{{URL('loginuser')}}" class="btn-main">
								{{ trans('home.Login') }}
							</a>
						</div>

						<!--REGISTRARME-->
						<div class="item">
							<a href="{URL('register')}}" class="btn-return">
								{{ trans('home.Sign up') }}
							</a>
						</div>
					</div>


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

					<ul>				
						<!--INICIO-->
						<li class="item">
							<a href="#index"> @lang('home.Home')</a>
						</li>
						<!--Por qué gTalents-->
						<li class="item">
							<a href="#pqGtalents">{{ trans('home.Why gTalents') }} </a>
						</li>
						<!--VENTAJAS-->
						<li class="item">
							<a href="#ventajas">{{ trans('home.Advantage') }} </a>
						</li>
						<!--COMO COMENZAR-->
						<li class="item">
							<a href="#comoComenzar">{{ trans('home.How to start') }} </a>
						</li>
						<!--MEMBRESIAS-->
						<li class="item">
							<a href="#membresias">{{ trans('home.Memberships') }} </a>
						</li>
						<!--PREGUNTAS FRECUENTES-->
						<li class="item">
							<a href="#question">{{ trans('home.Frequent questions') }}</a>
						</li>
						<!--GARANTIAS-->
						<li class="item">
							<a href="#garantias">{{ trans('home.Guarantee') }} </a>
						</li>
						<!--CONTACTO-->
						<li class="item">
							<a href="#contacto">{{ trans('home.Contact') }} </a>
						</li>

						<!--ACCEDER-->
						<li>
							<a href="{{ URL('loginuser') }}" class="btn-main">
								{{ trans('home.Login') }}
							</a>
						</li>

						<!--REGISTRARME-->
						<li>
							<a href="{{ URL('register') }}" class="btn-return">
								{{ trans('home.Sign up') }}
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
			
	</article>
</header>