<article class="admin-resum grid">
	<!--USER-->
	<section class="admin-resum-user">
		<figure>
			<span class="icon-gTalents_rango-8"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span></span>
		</figure>
		<div class="admin-resum-user-datos">
			<p>@lang('app.hi'), {{ Auth::user()->present()->name }}</p>
			<h4>ID: {{ Auth::user()->code }}</h4>
		</div>
	</section>

	<!--CONTENEDOR INFORMACION-->
	<section class="admin-resum-item">
		<!--CREDITOS-->
		<div class="item">
			<p>
				@lang('app.credits')
				<br><strong>{{\Vanguard\Balance::where('company_id', \Auth::user()->company_user->company_id)->sum('credit')}}</strong>
			</p>
		</div>

		<!--INGRESOS POTENCIALES-->
		<div class="item">
			<!--TITULO-->
			<p>
				@lang('app.potential_income')
			</p>

			<!--TOTAL-->
			<p>
				@lang('app.total')
				<br><strong>${{number_format($potentialSupplier+$potentialPoster, 2, '.', ',')}}</strong>
			</p>

			<!--COMO POSTER-->
			<p>
				@lang('app.poster')
				<br><strong>${{number_format($potentialPoster, 2, '.', ',')}}</strong>
			</p>

			<!--COMO SUPPLIER-->
			<p>
				@lang('app.supplier')
				<br><strong>${{number_format($potentialSupplier, 2, '.', ',')}}</strong>
			</p>
		</div>

		<!--COMO POSTER-->
		<div class="item">
			<!--TITULO-->
			<div class="item-leyend">
				<figure>
					<span class="icon-gTalents_poster"></span>
				</figure>
				<p>@lang('app.poster')</p>
			</div>

			<!--ACTIVO-->
			<p>
				@lang('app.actives')
				<br><strong>{{count($latestVacanciesPoster)}}</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				@lang('app.recruitment_dashboard')
				<br><strong>{{$candidatePoster}}</strong>
			</p>
		</div>

		<!--COMO SUPPLIER-->
		<div class="item">
			<!--TITULO-->
			<div class="item-leyend">
				<figure>
					<span class="icon-gTalents_supplier-26"></span>
				</figure>
				<p>@lang('app.supplier')</p>
			</div>

			<!--ACTIVO-->
			<p>
				@lang('app.actives')
				<br><strong>{{count($latestVacanciesSupplier)}}</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				@lang('app.recruitment_dashboard')
				<br><strong>{{$candidateSupplier}}</strong>
			</p>
		</div>
	</section>

	<!--CONTENEDOR INFORMACION MOBILE-->
	<section class="admin-resum-item item-mobile">
		<!--COMO POSTER-->
		<div class="item">
			<!--TITULO-->
			<div class="item-leyend">
				<figure>
					<span class="icon-gTalents_poster"></span>
				</figure>
				<p>@lang('app.poster')</p>
			</div>

			<!--ACTIVO-->
			<p>
				@lang('app.actives')
				<br><strong>{{count($latestVacanciesPoster)}}</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				@lang('app.recruitment_dashboard')
				<br><strong>{{$candidatePoster}}</strong>
			</p>
		</div>

		<!--COMO SUPPLIER-->
		<div class="item">
			<!--TITULO-->
			<div class="item-leyend">
				<figure>
					<span class="icon-gTalents_supplier-26"></span>
				</figure>
				<p>@lang('app.poster')</p>
			</div>

			<!--ACTIVO-->
			<p>
				@lang('app.actives')
				<br><strong>{{count($latestVacanciesSupplier)}}</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				@lang('app.recruitment_dashboard')
				<br><strong>{{$candidateSupplier}}</strong>
			</p>
		</div>
	</section>
</article>