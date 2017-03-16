<footer class="footer">
	<!--CONTENEDOR PADRE-->
	<article class="footer-container grid">
		<!--LOGOTIPO Y REDES SOCIALES-->
		<section class="item">
			<!--LOGOTIPO-->
			<section class="item-avatar">
				<a href="{{ URL('/') }}">
					<figure>
						<img src="assets/img/logotipo.png" alt="gtalents logotipo">
					</figure>
				</a>
			</section>
			<!--REDES SOCIALES-->
			<ul class="social-media">
				<!--LINKEDIN-->
				<li>
					<a href="#!" target="_blank">
						<span class="icon-gTalents_linkedin"></span>
					</a>
				</li>
				<!--FACEBOOK-->
				<li>
					<a href="#!" target="_blank">
						<span class="icon-gTalents_facebook"></span>
					</a>
				</li>
				<!--TWITTER-->
				<li>
					<a href="#!" target="_blank">
						<span class="icon-gTalents_twitter"></span>
					</a>
				</li>
				<!--INSTAGRAM-->
				<li>
					<a href="#!" target="_blank">
						<span class="icon-gTalents_instagram"></span>
					</a>
				</li>
			</ul>
		</section>

		<!--LEER MAS-->
		<section class="item">
			<h4> {{ trans('home.Read more') }}</h4>
			<ul class="item-links">
				<!--MEMBRESIA-->
				<li>
					<a href="#modalMembresias" class=" modal-trigger waves-effect waves-light">
						<p>{{ trans('home.Membership')}} </p>
					</a>
				</li>
				<!--PRIVACIDAD-->
				<li>
					<a href="#!">
						<p> {{ trans('home.Privacy')}} </p>
					</a>
				</li>
				<!--GARANTÍAS-->
				<li>
					<a href="#modalGarantias" class=" modal-trigger waves-effect waves-light">
						<p> {{ trans('home.Guarantee')}} </p>
					</a>
				</li>
			</ul>
		</section>

		<!--LA EMPRESA-->
		<section class="item">
			<h4> {{ trans('home.the company')}} </h4>
			<ul class="item-links">
				<!--SOBRE NOSOTROS-->
				<li>
					<a href="#!">
						<p> {{ trans('home.About us')}} </p>
					</a>
				</li>
				<!--Contáctanos-->
				<li>
					<a href="#!">
						<p> {{ trans('home.Contact us')}} </p>
					</a>
				</li>
				<!--TERMINOS Y CONDICIONES-->
				<li>
					<a href="#!">
						<p> {{ trans('home.Terms and Conditions')}} </p>
					</a>
				</li>
				<!--POLITICAS-->
				<li>
					<a href="#!">
						<p> {{ trans('home.Copyright policies')}} </p>
					</a>
				</li>
			</ul>
		</section>

		<!--PIE DE PAGINA-->
		<section class="derechos">
			<h5>@lang('app.copyright') © - {{ settings('app_name') }} {{ date('Y') }}</h5>
		</section>
	</article>
</footer>