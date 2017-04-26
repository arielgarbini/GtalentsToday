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
				<h3>Tienes <strong>28 Candidatos</strong></h3>
			</section>

			<!--LISTADO DE COLABORADORES-->
			<ul class="supplier-container supplier-list">
				<!-- CANDIDATO 1 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_post icon-candd"></span>
						</figure>

						<div class="datos">
							<h4>Antonio De La Rosa</h4>
							<span>andresjm78@gmail.com</span>
							<p>UX/UI Designer</p>
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

				<!-- CANDIDATO 2 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_post icon-candd"></span>
						</figure>

						<div class="datos">
							<h4>Antonio De La Rosa</h4>
							<span>andresjm78@gmail.com</span>
							<p>UX/UI Designer</p>
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
						</ul>
					</div>
				</li>

				<!-- CANDIDATO 3 -->
				<li>
					<!--RESUMEN OPORTUNIDAD-->
					<section class="colab">
						<!--ICONO-->
						<figure>
							<span class="icon-gTalents_post icon-candd"></span>
						</figure>

						<div class="datos">
							<h4>Antonio De La Rosa</h4>
							<span>andresjm78@gmail.com</span>
							<p>UX/UI Designer</p>
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
				<a href="#modalNewCandidato" class="btn-main modal-trigger waves-effect waves-light">
					Nuevo Candidato
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


	<!--MODAL NUEVO CANDIDATO-->
	<div id="modalNewCandidato" class="modal modal-userRegistered modal-fixed-footer">
		
		<div class="modal-header">
			<!--CERRAR MODAL-->
			<div class="close">
				<a href="#!" class="modal-action modal-close">
					<span class="icon-gTalents_close-2"></span>
				</a>
			</div>

			<h4>Nuevo Candidato</h4>
		</div>

		<div class="modal-content">
			<form action="" class="formLogin">
				
				<div class="dual">
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
				</div>

				<!--TELEFONO-->
				<div class="itemForm">
					<label>Teléfono</label>
					<input id="phone" type="tel">
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>Correo Electrónico</label>
					<input type="email" placeholder="Correo Electrónico">
					<span>Correo electrónico inválido</span>
				</div>

				<!--POSICION ACTUAL-->
				<div class="itemForm">
					<label>Posición actual o más reciente</label>
					<input type="text" placeholder="UX/UI Designer">
				</div>

				<!--COMPAÑIA ACTUAL-->
				<div class="itemForm">
					<label>Compañia actual</label>
					<input type="text" placeholder="Platzi">
				</div>

				<div class="dual">
					<!--PAIS-->
					<div class="itemForm">
						<label>Pais</label>
						<input type="text" placeholder="Venezuela">
					</div>

					<!--COMPENSACION-->
					<div class="itemForm">
						<label>Compensación</label>
						<select class="browser-default">
							<option value="" disabled>Elige un rango</option>
							<option value="1" selected>USD 60k-70k</option>
							<option value="2">USD 40k-50k</option>
							<option value="3">USD 30k-40k</option>
						</select>
					</div>
				</div>

				<!--ADJUNTAR CV-->
				<div class="upload">
					
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
				<p>Nuevo candidato agregado exitosamente</p>
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
				
				<!--RESUMEN CANDIDATO-->
				<section class="colab">
					<!--ICONO-->
					<figure>
						<span class="icon-gTalents_post icon-candd"></span>
					</figure>

					<div class="datos">
						<h4>Antonio De La Rosa</h4>
						<span>andresjm78@gmail.com</span>
						<p>UX/UI Designer</p>
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