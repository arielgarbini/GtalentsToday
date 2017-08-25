<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>
	<!--INPUT UPLOAD-->
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />

	<!--ESTRELLAS-->
	<link rel="stylesheet" href="css/intlTelInput.css">
</head>
<body class="body-registered">

	<?php include 'inc/header-registrado.php'; ?>

	<!--CONTRATAR POSTER-->
	<article class="newPost grid">

		<!--ENCABEZADO ICONOS-->
		<section class="newPost-legend">

			<!--DETALLES-->
			<div class="item active">
				<figure>
					<span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
				</figure>
				<p class="p-desp">Nos complace saber que quieras contratar</p>
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
					<h3>¡Califica a tu Supplier!</h3>
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


				<!--COMENTARIO AL SUPPLIER-->
				<div class="itemForm">
					<label>Comentario al Supplier</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Comentario al Supplier"></textarea>
				</div>

				<!--BOTONES UPLOAD-->
				<div class="upload">
					<!-- ADJUNTAR OFERTA DE EMPLEO -->
					<div class="box">
						<input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
						<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar Oferta de Empleo</span></label>
					</div>
				</div>

				<div class="btn-container">
					<div class="item">
						<a href="#" class="btn-main">Procesar Contrato</a>
					</div>
				</div>
			</section>
		</form>
	</article>


	<?php include 'inc/footer_common.php'; ?>
	
</body>
</html>