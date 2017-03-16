@extends('layouts.register')

@section('page-title', trans('app.sign_up'))

@if (settings('registration.captcha.enabled'))
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endif

@section('content')

<body class="body-register">

	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="login register">
		<!--TITULO DE LA SECCION-->
		<section class="login-title">
			<figure>
				<a href="{{ URL('/') }}">
					<img src="assets/img/logotipo.png" alt="gtalents logotipo">
				</a>
			</figure>
			<p>@lang('app.one_account_many_benefits')</p>
		</section>

		{{-- This will simply include partials/messages.blade.php view here --}}
		@include('partials/messages')

		<!--FORMULARIO login-->
        <form role="form" action="<?= url('register') ?>" class="formLogin" method="post" id="login-container" autocomplete="off">
            <input type="hidden" value="<?= csrf_token() ?>" name="_token">

			<!--EMAIL-->
            <div class="itemForm">
				<label>@lang('app.email')</label>
                <input type="email" name="email" id="email" placeholder="@lang('app.example_email')" value="{{ old('email') }}">
            </div>

			<!--USERNAME-->
            <div class="itemForm">
				<label>@lang('app.username')</label>
                <input type="text" name="username" id="username" placeholder="@lang('app.username')" value="{{ old('username') }}">
            </div>

			<!--COUNTRY-->
            <div class="itemForm">
				<label>@lang('app.country')</label>
                {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'browser-default', 'id' => 'country_id', 'placeholder' => trans('app.select'), 'required']) !!}
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

            @if (settings('tos'))
            	<div class="itemForm">
                    <div class="checkbox">
                        <input type="checkbox" name="tos" id="tos" value="1"/>
                        <label for="tos">@lang('app.i_accept')
                        	<a href="#tos-modal" class="modal-trigger waves-effect waves-light">@lang('app.terms_of_service')</a>
                        </label>
                    </div>
                </div>
            @endif


            {{-- Only display captcha if it is enabled --}}
            @if (settings('registration.captcha.enabled'))
                <div class="recaptcha">
                    {!! app('captcha')->display() !!}
                </div>
            @endif
            {{-- end captcha --}}

			<!--RECAPTCHA-->
			<div class="recaptcha">
				
			</div>

			<!--SUBMIT-->
			<div class="submit">
				<button type="submit" class="btn-main2" id="btn-login">@lang('app.register')</button>
			</div>

			<!--LOG IN-->
			<div class="submit">
				<p>@lang('app.have_an_account') <a href="{{URL('loginuser')}}">@lang('app.log_in_')</a></p>
			</div>
		</form>

		<!-- MENSAJE FINAL-->
		<section class="password-send">
			<h3>¡Gracias por registrarte!
				<br> Te contactaremos en breve
			</h3>
			<div class="link">
				<a href="{{URL('/')}}" class="btn-main2">Continuar</a>
			</div>
		</section>

	</article>
</body>

    @if (settings('tos'))
        <div class="modal modalText" id="tos-modal">
            <!--CLOSE-->
            <div class="modal-footer">
                <a type="button" class="modal-action modal-close waves-effect waves-green btn-flat">
                    <span class="icon-gTalents_close"></span>
                </a>
            </div>
            <!--CONTENT-->
            <div class="modal-content">
                <article class="generic grid">
                    <section class="generic-title">
                        <h3 class="modal-title" id="tos-label">@lang('app.terms_of_service')</h3>
                    
                    </section>
                    <section class="paragraph bloque">
                        <div class="skill-A">
                            <h4 class="item">1. Terms</h4>

                            <p class="text-left">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Donec quis lacus porttitor, dignissim nibh sit amet, fermentum felis.
                                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere
                                cubilia Curae; In ultricies consectetur viverra. Nullam velit neque,
                                placerat condimentum tempus tincidunt, placerat eu lectus. Nam molestie
                                porta purus, et pretium risus vehicula in. Cras sem ipsum, varius sagittis
                                rhoncus nec, dictum maximus diam. Duis ac laoreet est. In turpis velit, placerat
                                eget nisi vitae, dignissim tristique nisl. Curabitur sollicitudin, nunc ut
                                viverra interdum, lacus...
                            </p>

                            <h4 class="item">2. Use License</h4>

                            <ol>
                                <li>
                                    Aenean vehicula erat eu nisi scelerisque, a mattis purus blandit. Curabitur congue
                                    ollis nisl malesuada egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit:
                                </li>
                            </ol>

                            <p>...</p>
                        </div>
                    </section>
                </article>
            </div>
        </div>
    @endif
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\RegisterRequest', '#login-container') !!}
@stop