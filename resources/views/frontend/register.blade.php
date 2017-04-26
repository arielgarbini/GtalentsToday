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
			<h3>@lang('app.thanks_for_register')
			</h3>
			<div class="link">
				<a href="{{URL('/')}}" class="btn-main2">@lang('app.continue')</a>
			</div>
		</section>

	</article>

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
</body>
@stop

@section('scripts')
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\RegisterRequest', '#login-container') !!}
@stop