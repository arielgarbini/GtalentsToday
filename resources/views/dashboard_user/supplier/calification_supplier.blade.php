@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

	<!--CONTRATAR POSTER-->
	<article class="newPost grid">

		<!--ENCABEZADO ICONOS-->
		<section class="newPost-legend">

			<!--DETALLES-->
			<div class="item active">
				<figure>
					<span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
				</figure>
				<p class="p-desp">Nos complace saber completaste esta oportunidad</p>
			</div>
		</section>

		<form action="" class="formLogin">
			<!-- FORMULARIO PARA CONTRATAR -->
			<section class="newPost-container">
				<!--NOMBRE DE LA POSICION-->
				<div class="itemForm">
					<label>Nombre de la Posición</label>
					<input type="text" placeholder="Nombre de la Posición">
				</div>

				<!--NOMBRE DEL CANDIDATO-->
				<div class="itemForm">
					<label>Nombre del Candidato</label>
					<input type="text" placeholder="Nombre del Candidato">
				</div>

				<div class="dual">
					<!--SALARIO ANUAL-->
					<div class="itemForm">
						<label>Salario Anual</label>
						<input type="text" placeholder="Salario Anual">
					</div>

					<!--FECHA DE INGRESO-->
					<div class="itemForm">
						<label>Fecha de Ingreso</label>
						<input type="text" placeholder="Fecha de Ingreso">
					</div>
				</div>

				<!--Detalles de Oferta  y Compensaciones adicionales-->
				<div class="itemForm">
					<label>Detalles de Oferta  y Compensaciones adicionales</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Detalles de Oferta  y Compensaciones adicionales"></textarea>
				</div>

				<!--COMENTARIO A GTALENTS-->
				<div class="itemForm">
					<label>Comentario a gTalents</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Comentario a gTalents"></textarea>
				</div>

				<!--CALIFICACION-->
				<div class="feedback-contratar">
					<h3>¡Califica a tu Poster!</h3>
					<!--ESTRELLAS-->
					<div class="stars-feedback">
						<select id="stars1" name="rating" autocomplete="off">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>

				<!--COMENTARIO AL Poster-->
				<div class="itemForm">
					<label>Comentario al Poster</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Comentario al Poster"></textarea>
				</div>

				<div class="btn-container">
					<div class="item">
						<a href="#" class="btn-main">Calificar</a>
					</div>
				</div>
			</section>
		</form>
	</article>
@stop

@section('scripts')
   
@stop
