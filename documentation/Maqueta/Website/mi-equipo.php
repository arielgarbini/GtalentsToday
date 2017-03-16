<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>
	<link rel="stylesheet" href="css/intlTelInput.css">
</head>
<body class="body-registered">
	<?php include 'inc/header-registrado.php'; ?>

	<!--CONTENEDOR INDEX REGISTRADO-->
	<article class="user-main grid">
		<!--OPORTUNIDADES-->
		<section class="user-main-create credits">
			<!--TITULO DE LA SECCION-->
			<section class="credits-title">
				<h3>Tienes <strong>8 Colaboradores</strong></h3>
			</section>

			<!--LISTADO DE COLABORADORES-->
			<ul class="supplier-container supplier-list">
				<!-- COLABORADOR 1 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_team-48"></span>
						</figure>

						<div class="datos">
							<h4>Andres Gonzalez</h4>
							<span>andresjm78@gmail.com</span>
							<p>Activo - Básico</p>
						</div>
					</section>

					<!--OPCIONES-->
					<div class="options">
						<!-- Dropdown Trigger -->
						<a class='dropdown-button' href='#' data-activates='option-team1'>
							<span class="icon-gTalents_submenu"></span>
						</a>

						<!-- Dropdown Structure -->
						<ul id='option-team1' class='dropdown-content'>
							<li><a href="#">Editar</a></li>
							<li><a href="#modalEliminar" class="modal-trigger waves-effect waves-light">Eliminar</a></li>
						</ul>
					</div>
				</li>

				<!-- COLABORADOR 2 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_team-48"></span>
						</figure>

						<div class="datos">
							<h4>Andres Gonzalez</h4>
							<span>andresjm78@gmail.com</span>
							<p>No Confirmado - Básico</p>
						</div>
					</section>

					<!--OPCIONES-->
					<div class="options">
						<!-- Dropdown Trigger -->
						<a class='dropdown-button' href='#' data-activates='option-team2'>
							<span class="icon-gTalents_submenu"></span>
						</a>

						<!-- Dropdown Structure -->
						<ul id='option-team2' class='dropdown-content'>
							<li><a href="#">Editar</a></li>
							<li><a href="#modalEliminar" class="modal-trigger waves-effect waves-light">Eliminar</a></li>
							<li><a href="#">Invitar</a></li>
						</ul>
					</div>
				</li>

				<!-- COLABORADOR 3 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_team-48"></span>
						</figure>

						<div class="datos">
							<h4>Andres Gonzalez</h4>
							<span>andresjm78@gmail.com</span>
							<p>Deshabilitado - Básico</p>
						</div>
					</section>

					<!--OPCIONES-->
					<div class="options">
						<!-- Dropdown Trigger -->
						<a class='dropdown-button' href='#' data-activates='option-team3'>
							<span class="icon-gTalents_submenu"></span>
						</a>

						<!-- Dropdown Structure -->
						<ul id='option-team3' class='dropdown-content'>
							<li><a href="#">Editar</a></li>
							<li><a href="#modalEliminar" class="modal-trigger waves-effect waves-light">Eliminar</a></li>
						</ul>
					</div>
				</li>
			</ul>

			<ul class="pagination">
				<li class="disabled">
					<a href="#!">
						<span class="icon-gTalents_left"></span>
					</a>
				</li>
				<li class="active"><a href="#!">1</a></li>
				<li class="waves-effect"><a href="#!">2</a></li>
				<li class="waves-effect"><a href="#!">3</a></li>
				<li class="waves-effect"><a href="#!">4</a></li>
				<li class="waves-effect"><a href="#!">5</a></li>
				<li class="waves-effect">
					<a href="#!">
						<span class="icon-gTalents_right"></span>
					</a>
				</li>
			</ul>
		</section>

		<!--NUEVO COLABORADOR - PUNTAJE-->
		<section class="user-main-contain">

			<!--BTN NUEVO COLABORADOR-->
			<div class="btn-section">
				<a href="#modalNewTeam" class="btn-main modal-trigger waves-effect waves-light">
					Nuevo Colaborador
				</a>
			</div>

			<!-- RANGO Y PUNTAJE -->
			<div class="bills">
				<!--TITULO DE LA SECCION-->
				<section class="bills-title">
					<h3>Posición de mi Perfil</h3>
				</section>

				<!--RANGO-->
				<section class="ranking">
					<!--RANGO A-->
					<figure>
						<span class="icon-gTalents_rango-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
					</figure>

					<!--RANGO B -->
					<figure>
						<span class="icon-gTalents_rango-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
					</figure>

					<!--RANGO C -->
					<figure>
						<span class="icon-gTalents_rango-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
					</figure>

					<!--RANGO D -->
					<figure class="ranking-active">
						<span class="icon-gTalents_rango-8"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span></span>
					</figure>
				</section>

				<!--RESUMEN-->
				<section class="position-resum">
					<!--POSICION-->
					<div class="item">
						<h4>Mi Posición</h4>
						<p><strong>Recruiting Rockstar</strong></p>
					</div>

					<!--PUNTAJE-->
					<div class="item">
						<h4>Me faltan</h4>
						<p><strong>500pts</strong> para el próximo nivel</p>
					</div>
				</section>
			</div>
		</section>
	</article>


	<!--MODAL NUEVO COLABORADOR-->
	<div id="modalNewTeam" class="modal modal-userRegistered modal-fixed-footer">
		
		<div class="modal-header">
			<!--CERRAR MODAL-->
			<div class="close">
				<a href="#!" class="modal-action modal-close">
					<span class="icon-gTalents_close-2"></span>
				</a>
			</div>

			<h4>Nuevo Colaborador</h4>
		</div>

		<div class="modal-content">
			<form action="" class="formLogin">
				<!--NOMBRE-->
				<div class="itemForm">
					<label>Nombre</label>
					<input type="text" placeholder="Nombre">
					<span>Nombre inválido</span>
				</div>

				<!--APELLIDO-->
				<div class="itemForm">
					<label>Nombre</label>
					<input type="text" placeholder="Apellido">
					<span>Apellido inválido</span>
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>Correo Electrónico</label>
					<input type="email" placeholder="Correo Electrónico">
					<span>Correo electrónico inválido</span>
				</div>

				<!--PREFIJO-->
				<div class="itemForm">
					<label>Nivel de Acceso</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige un tipo de Acceso</option>
						<option value="1">Administrador</option>
						<option value="2">Poster</option>
						<option value="3">Novato</option>
					</select>
				</div>

				<section class="buttonsMain">
					<!--REGRESAR-->
					<div class="item">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
							Regresar
						</a>
					</div>

					<!--INVITAR-->
					<div class="item">
						<a href="#" class="btn-main" type="submit" id="btn-modalMain">
							Invitar
						</a>
					</div>
				</section>
			</form>

			<!--MENSAJE DE COLABORADOR CARGADO-->
			<div class="messageModal">
				<figure>
					<span class="icon-gTalents_win-53"></span>
				</figure>
				<p>Nuevo colaborador agregado exitosamente</p>
				<!--BTN-MAIN-->
				<div class="item">
					<a href="#!" class="btn-main">
						Continuar
					</a>
				</div>
			</div>
		</div>
	</div>

	<!--MODAL ELIMINAR-->
	<div id="modalEliminar" class="modal modal-userRegistered modal-fixed-footer">
		
		<div class="modal-header">
			<!--CERRAR MODAL-->
			<div class="close">
				<a href="#!" class="modal-action modal-close">
					<span class="icon-gTalents_close-2"></span>
				</a>
			</div>

			<h4>¿Seguro quieres eliminarlo?</h4>
		</div>

		<div class="modal-content">
			<form action="" class="formLogin">
				
				<!--RESUMEN COLABORADOR-->
				<section class="colab">
					<!--ICONO-->
					<figure>
						<span class="icon-gTalents_team-48"></span>
					</figure>

					<div class="datos">
						<h4>Andres Gonzalez</h4>
						<span>andresjm78@gmail.com</span>
						<p>Básico</p>
					</div>
				</section>

				<section class="buttonsMain">
					<!--REGRESAR-->
					<div class="item">
						<a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
							Regresar
						</a>
					</div>

					<!--INVITAR-->
					<div class="item">
						<a href="#" class="btn-main" type="submit" id="btn-modalMain">
							Eliminar
						</a>
					</div>
				</section>
			</form>

			<!--MENSAJE DE COLABORADOR CARGADO-->
			<div class="messageModal">
				<figure>
					<span class="icon-gTalents_win-53"></span>
				</figure>
				<p>Candidato eliminado exitosamente</p>
				<!--BTN-MAIN-->
				<div class="item">
					<a href="#!" class="btn-main">
						Continuar
					</a>
				</div>
			</div>
		</div>
	</div>


	<?php include 'inc/footer_common.php'; ?>
</body>
</html>