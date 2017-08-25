<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'inc/head_common.php'; ?>
	<link rel="stylesheet" type="text/css" href="css/demo.css" />
	<link rel="stylesheet" type="text/css" href="css/component.css" />
</head>
<body class="body-registered">
	<?php include 'inc/header-registrado.php'; ?>

	<!--CREAR NUEVO POST-->
	<article class="newPost grid">
		<!--ENCABEZADO ICONOS-->
		<section class="newPost-legend">
			<!--CREAR-->
			<div class="item active" id="indi-create">
				<figure>
					<span class="icon-gTalents_crear"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
				</figure>
				<p>Crear</p>
			</div>

			<!--DETALLES-->
			<div class="item" id="indi-detail">
				<figure>
					<span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
				</figure>
				<p>Detalles</p>
			</div>

			<!--EMPEZAR-->
			<div class="item" id="indi-go">
				<figure>
					<span class="icon-gTalents_empezar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
				</figure>
				<p>Empezar</p>
			</div>
		</section>

		<form action="" class="formLogin">
			<!-- CREAR - CONTENEDOR -->
			<section class="newPost-container" id="crear-container">
				<!--NOMBRE DE LA POSICION-->
				<div class="itemForm">
					<label>Nombre de la Posición</label>
					<input type="text" placeholder="Nombre de la Posición">
				</div>

				<div class="dual">
					<!--NUMERO DE POSICIONES-->
					<div class="itemForm">
						<label>Numero de Posiciones</label>
						<input type="text" placeholder="Número de Posiciones">
					</div>

					<!--UBICACION-->
					<div class="itemForm">
						<label>Ubicación</label>
						<input type="text" placeholder="Ubicación">
					</div>
				</div>

				<!--EMPLESAS OBJETIVOS-->
				<div class="itemForm">
					<label>Empresas Objetivo (Opcional)</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Empresas donde haya trabajado el candidato"></textarea>
				</div>

				<!--EMPLESAS OFF-LIMITS-->
				<div class="itemForm">
					<label>Empresas Off-limits</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Empresas Off-limits"></textarea>
				</div>

				<!--RESPONSABILIDADES-->
				<div class="itemForm">
					<label>Responsabilidades</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Responsabilidades"></textarea>
				</div>

				<!--EXPERIENCIA REQUERIDA-->
				<div class="itemForm">
					<label>Experiencia Requerida</label>
					<textarea name="" id="" cols="30" rows="10" placeholder="Experiencia Requerida"></textarea>
				</div>

				<!--PREGUNTAS CLAVES-->
				<div class="itemForm icon-help">
					<label>Preguntas claves de la posición</label>
					<a class="hint--right  hint--large hint--bounce" aria-label="Escriba las preguntas claves que le plantearia a un posible candidato según el perfil que busca">
						<i class="icon-gTalents_help "></i>
					</a>
					<input type="text" placeholder="3 puntos o preguntas claves de la posición">
				</div>

				<!--BOTONES UPLOAD-->
				<div class="upload">
					<!-- DESCRIPCION DEL PUESTO -->
					<div class="box">
						<input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
						<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Descripción del Puesto</span></label>
					</div>

					<!-- ACUERDO CON EL EMPLEADOR -->
					<div class="box hint--bottom  hint--large hint--bounce" aria-label="Acuerdo de confidencialidad entre usted y gTalents, sin este acuerdo podremos invalidar su post">
						<input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
						<label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Acuerdo con el Empleador</span></label>
					</div>
				</div>

				<div class="btn-container">
					<div class="item">
						<a href="#" class="btn-main" id="next-newPost1">Siguiente</a>
					</div>
				</div>
			</section>

			<!--DETALLES - CONTAINER-->
			<section class="newPost-container" id="detail-container">

				<div class="dual">
					<!--INDUSTRIA-->
					<div class="itemForm">
						<label>Industria</label>
						<select class="browser-default">
							<option value="" disabled selected>Elige una industria</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!--TIPO DE BUSQUEDA-->
					<div class="itemForm">
						<label>Tipo de Búsqueda</label>
						<select class="browser-default">
							<option value="1" selected>Contingency</option>
							<option value="2">Retained</option>
						</select>
					</div>
				</div>

				<div class="dual">
					<!--TIPO DE CONTRATACION-->
					<div class="itemForm">
						<label>Tipo de Contratación</label>
						<select class="browser-default">
							<option value="1" selected>Full-Time</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!--AÑOS DE EXPERIENCIA-->
					<div class="itemForm">
						<label>Años de Experiencia</label>
						<select class="browser-default">
							<option value="1" selected>3-5 años</option>
							<option value="2">Retained</option>
						</select>
					</div>
				</div>

				<div class="dual">
					<!--ESPECIALIZACION-->
					<div class="itemForm">
						<label>Especialización</label>
						<select class="browser-default">
							<option value="1" selected>Diseño</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!--IDIOMAS-->
					<div class="itemForm">
						<label>Idiomas</label>
						<select class="browser-default">
							<option value="1" selected>Español</option>
							<option value="2">Ingles</option>
						</select>
					</div>
				</div>

				<div class="dual">
					<!--RANGO SALARIAL-->
					<div class="itemForm">
						<label>Rango Salarial</label>
						<select class="browser-default">
							<option value="1" selected>USD 125k - 150k</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!--HONORARIO COBRADO AL EMPLEADOR-->
					<div class="itemForm itemRadio">
						<label>Honorario cobrado al empleador</label>
						
						<div class="radio">
							<!-- % -->
							<p>
								<input name="group1" type="radio" id="test1" />
								<label for="test1">%</label>
							</p>

							<!-- $ Fijo -->
							<p>
								<input name="group1" type="radio" id="test2" />
								<label for="test2">$ Fijo</label>
							</p>							
						</div>

						<input type="text" placeholder="22">
					</div>
				</div>

				<div class="dual">
					<!--PERIODO DE REEMPLAZO-->
					<div class="itemForm">
						<label>Periodo de Reemplazo</label>
						<select class="browser-default">
							<option value="1" selected>1 mes</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
					</div>

					<!--GARANTIA AL EMPLEADOR-->
					<div class="itemForm">
						<label>Garantia al Empleador</label>
						<input type="text" placeholder="Garantia al Empleador">
					</div>
				</div>

				<!--CONDICIONES GENERALES-->
				<div class="itemForm icon-help">
					<label>Condiciones Generales</label>
					<a class="hint--right  hint--large hint--bounce" aria-label="Condiciones que debe cumplir el candidato para su oportunidad laboral">
						<i class="icon-gTalents_help "></i>
					</a>
					<input type="text" placeholder="Condiciones Generales">
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
				      <label for="filled-in-box">Acepto las políticas y condiciones de gTalents</label>
				    </p>
				</div>

				<div class="btn-container">
					<!--LEFT-->
					<div class="item">
						<a href="#" class="btn-return" id="return-newPost1">Regresar</a>
					</div>

					<!--NEXT-->
					<div class="item">
						<a href="#" class="btn-main" id="next-newPost2">Siguiente</a>
					</div>
				</div>
			</section>

			<!--EMPEZAR - CONTAINER -->
			<section class="newPost-container" id="go-container">
				<!--MENSAJE FINAL-->
				<div class="messageWin">
					<figure>
						<span class="icon-gTalents_win-2"></span>
					</figure>
					<p>Has creado una nueva oportunidad</p>

					<div class="btn-container">
						<!--NEXT-->
						<div class="item">
							<a href="post-detail.php" class="btn-main">Ver Oportunidad</a>
						</div>
					</div>
				</div>
			</section>
		</form>
	</article>
	
	<!-- RECOMENDACION SUPPLIER-->
	<section class="supplier-recommended grid" id="go-container">
		<!--TITULO DE LA SECCION-->
		<div class="supplier-recommended-title">
			<h3>Te recomendamos estos Suppliers</h3>
		</div>

		<ul class="supplier-recommended-container">
			<!--SUPPLIER 1-->
			<li>
				<!--MODAL-->
				<div class="link-modal">
					<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
						<span class="icon-gTalents_profile"></span>
					</a>
				</div>

				<!--RANGO-->
				<figure>
					<span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
				</figure>

				<!--DATOS-->
				<div class="datos">
					<h3>UFA-896</h3>
					<p>Newbie</p>
				</div>

				<!--LINK INVITAR-->
				<div class="link">
					<a href="" class="btn-main">Invitar</a>
				</div>
			</li>

			<!--SUPPLIER 2-->
			<li>
				<!--MODAL-->
				<div class="link-modal">
					<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
						<span class="icon-gTalents_profile"></span>
					</a>
				</div>

				<!--RANGO-->
				<figure>
					<span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
				</figure>

				<!--DATOS-->
				<div class="datos">
					<h3>UFA-896</h3>
					<p>Newbie</p>
				</div>

				<!--LINK INVITAR-->
				<div class="link">
					<a href="" class="btn-main">Invitar</a>
				</div>
			</li>

			<!--SUPPLIER 3-->
			<li>
				<!--MODAL-->
				<div class="link-modal">
					<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
						<span class="icon-gTalents_profile"></span>
					</a>
				</div>

				<!--RANGO-->
				<figure>
					<span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
				</figure>

				<!--DATOS-->
				<div class="datos">
					<h3>UFA-896</h3>
					<p>Newbie</p>
				</div>

				<!--LINK INVITAR-->
				<div class="link">
					<a href="" class="btn-main">Invitar</a>
				</div>
			</li>

			<!--SUPPLIER 4-->
			<li>
				<!--MODAL-->
				<div class="link-modal">
					<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
						<span class="icon-gTalents_profile"></span>
					</a>
				</div>

				<!--RANGO-->
				<figure>
					<span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
				</figure>

				<!--DATOS-->
				<div class="datos">
					<h3>UFA-896</h3>
					<p>Newbie</p>
				</div>

				<!--LINK INVITAR-->
				<div class="link">
					<a href="" class="btn-main">Invitar</a>
				</div>
			</li>
		</ul>
	</section>
	

	<!--MODAL PERFIL SUPPLIER-->
	<div id="modalProfileSupplier" class="modal modal-userRegistered">
		
		<div class="modal-header">
			<!--CERRAR MODAL-->
			<div class="close">
				<a href="#!" class="modal-action modal-close">
					<span class="icon-gTalents_close-2"></span>
				</a>
			</div>

			<h4>Perfil del Supplier</h4>
		</div>

		<div class="modal-content">

			<!--RESUMEN SUPPLIER-->
			<div class="profile-colab profile-supplier">
				<section class="supplierContain1">
					<!--ICONO RANGO-->
					<figure class="supplierContain1-ranking">
						<span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
					</figure>

					<div class="datos">
						<h4>QDT876</h4>
						<p>Newbie</p>
					</div>
				</section>

				<!--PROMEDIO CALIFICACIONES-->
				<div class="qualification">
					<figure>
						<span class="icon-gTalents_stars-3"></span>
						<span class="icon-gTalents_stars-3"></span>
						<span class="icon-gTalents_stars-3"></span>
						<span class="icon-gTalents_stars-3"></span>
						<span class="icon-gTalents_stars-3 star-null"></span>
					</figure>
				</div>

				<!--RESUMEN 1-->
				<div class="profile-colab-message">
					<h4>Ha participado en:</h4>
					<p>214 oportunidades laborales</p>
				</div>

				<!--RESUMEN 2-->
				<div class="profile-colab-message">
					<h4>Indice de aceptación de candidatos:</h4>
					<p>90%</p>
				</div>
			</div>

			
			<!--BTN-MAIN-->
			<div class="item-btn">
				<a href="#!" class="btn-main">
					Continuar
				</a>
			</div>
		</div>
	</div>

	<?php include 'inc/footer_common.php'; ?>
</body>
</html>