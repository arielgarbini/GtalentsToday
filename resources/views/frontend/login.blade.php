@extends('layouts.register')
	
	@section('title')
		@parent
	@stop
	@section('css')
		@parent
	@stop

@section('content')

<body class="body-login">
	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="login">
		<!--TITULO DE LA SECCION-->
		<section class="login-title">
			<figure>
				<a href="{{ URL('/') }}">
					<img src="{{URL::to('/assets/img/logotipo.png')}}" alt="gtalents logotipo">
				</a>
			</figure>
			<p>@lang('app.one_account_many_benefits')</p>
		</section>

		{{-- This will simply include partials/messages.blade.php view here --}}
		@include('partials/messages')
		<button class="btn-linkedin"><i class="fa fa-linkedin fa-fw"></i> @lang('app.login_linkedin')</button>
		<!--FORMULARIO login-->
		<form role="form" action="{{ URL('loginuser') }}" class="formLogin" method="POST" id="login-container" autocomplete="off">
  			<input type="hidden" value="<?= csrf_token() ?>" name="_token">
  			
  			@if (Input::has('to'))
				<input type="hidden" value="{{ Input::get('to') }}" name="to">
			@endif

			<div class="itemForm">
				<label for="username">@lang('app.email_or_username')</label>
				<input type="email" name="username" id="username" class="form-control" placeholder="@lang('app.email_or_username')">
			</div>

			<!--CONTRASEÑA-->
			<div class="itemForm">
				<label for="password">@lang('app.password')</label>
				<input type="password" name="password" id="password" class="form-control" placeholder="@lang('app.password')">
			</div>

			<!--REMEMBERME-->
	        <div class="checkbox">
	            @if (settings('remember_me'))
	                <input type="checkbox" name="remember" id="remember" value="1"/>
	                <label for="remember">@lang('app.remember_me')</label>
	            @endif
	        </div>

			<!--RECUPERAR CONTRASEÑA-->
			<div class="recover">
				@if (settings('forgot_password'))				  
					<p><a href="#" id="btn-recover">@lang('app.i_forgot_my_password_')</a></p>
				@endif
			</div>

			<!--SUBMIT-->
	        <div class="submit">
	             <button type="submit" class="btn-main2" id="btn-login">
	                @lang('app.sign_in')
	            </button>
	        </div>

			<!--REGISTER-->
			<div class="submit">

	            @if (settings('reg_enabled'))
				<p>@lang('app.dont_have_an_account_') <a href="{{URL('register')}}">@lang('app.sign_up')</a></p>
	            @endif
			</div>
		</form>

		<!--FORMULARIO recuperar contraseña-->
		<form role="form" action="<?= url('password/remind') ?>" class="formLogin" id="recover-container" method="POST" autocomplete="off">
        	<input type="hidden" value="<?= csrf_token() ?>" name="_token">

			<!--CORREO ELECTRONICO-->
	        <div class="itemForm">
	            <label for="password">@lang('app.email')</label>
	            <input type="email" name="email" id="email" class="form-control" placeholder="@ @lang('app.your_email')">
	        </div>

			<!--SUBMIT-->
	        <div class="submit">
	            <button type="submit" class="btn-main2" id="btn-reset-password">
	                @lang('app.reset_password')
	            </button>
	        </div>

			<!--REGRESAR-->
			<div class="submit">
				<p><a href="#" id="btn-returnContainer">@lang('app.back')</a></p>
			</div>		
		</form>

		<!-- MENSAJE FINAL-->
		<section class="password-send">
			<h3>@lang('app.check_your_email')</h3>
			<div class="link">
				<a href="{{ URL('loginuser') }}" class="btn-main2">@lang('app.continue')</a>
			</div>
		</section>

	</article>
@stop

@section('scripts')
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-container') !!}
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\PasswordRemindRequest', '#recover-container') !!}

	<script>
        function successConfirm(data){
            if(data.register!=undefined){
                url = data.url;
                setTimeout(function(){ location.replace(url) }, 5200);
                swal({
                    title: "{{trans('app.success')}}",
                    text: data.message,
                    timer: 5000,
                    html: true,
                    showConfirmButton: false,
                    type: "success"
                });
			} else {
                location.replace(data.url);
			}
        }

        function successCancel(){

        }

        function successError(data){
            /*if(data.url!=undefined){
                url = data.url;
                setTimeout(function(){ location.replace(url); }, 5200);
			}*/
            swal({
                title: "{{trans('app.error')}}",
                text: data.message,
                timer: 5000,
                html: true,
                showConfirmButton: false,
                type: "error"
            });
        }

        $(document).ready(function(){

            $('.btn-linkedin').click(function(){
                $.ajax({
                    method: 'GET',
                    url: '{{route("url.linkedin")}}?type=2',
                    success : function(data){
                        window.open(data.url, "_blank", "width=800,height=800");
                    }
                });
            })
        });
	</script>
@stop