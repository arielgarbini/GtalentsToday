<article class="admin-resum grid">
	<!--USER-->
	<section class="admin-resum-user">
		<figure>
			<span class="icon-gTalents_rango-8"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span></span>
		</figure>
		<div class="admin-resum-user-datos">
			<p>@lang('app.hi'), {{ Auth::user()->present()->name }}</p>
			<h4>ETN-22</h4>
		</div>
	</section>

	<!--CONTENEDOR INFORMACION-->
	<section class="admin-resum-item">
		<!--CREDITOS-->
		<div class="item">
			<p>
				@lang('app.credits')
				<br><strong>1.245</strong>
			</p>
		</div>

		<!--INGRESOS POTENCIALES-->
		<div class="item">
			<!--TITULO-->
			<p>
				Ingresos
				<br>Potenciales
			</p>

			<!--TOTAL-->
			<p>
				Total
				<br><strong>$30</strong>
			</p>

			<!--COMO POSTER-->
			<p>
				@lang('app.poster')
				<br><strong>$11</strong>
			</p>

			<!--COMO SUPPLIER-->
			<p>
				@lang('app.supplier')
				<br><strong>$19</strong>
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
				<br><strong>6</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				Contratacion
				<br><strong>1</strong>
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
				<br><strong>4</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				Contratacion
				<br><strong>3</strong>
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
				<br><strong>6</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				Contratacion
				<br><strong>1</strong>
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
				<br><strong>4</strong>
			</p>

			<!--CONTRATACION-->
			<p>
				Contratacion
				<br><strong>3</strong>
			</p>
		</div>
	</section>
</article>