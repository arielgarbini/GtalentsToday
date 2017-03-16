<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>
</head>
<body class="body-registered">

	<?php include 'inc/header-registrado.php'; ?>

	<!-- LISTADO DE POST-->
	<article class="postList-contain grid">
		<!--POST LIST FILTRADO-->
		<article class="postList-contain-filter filter-supplier no-mobile">
			<form action="" class="formLogin">
				<h3>Filtra tu búsqueda</h3>

				<!--BUSQUEDA-->
				<div class="itemForm">
					<input type="text" placeholder="¿Qué buscas?" class="input-search">
				</div>

				<!--COMISION-->
				<div class="itemForm">
					<label>Áreas funcionales</label>
					<select class="browser-default">
						<option value="1" selected>Gerencia</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--INDUSTRIA-->
				<div class="itemForm">
					<label>Industria</label>
					<select class="browser-default">
						<option value="1" selected>Diseño e Informática</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--NIVELES DE POSICION-->
				<div class="itemForm">
					<label>Niveles de posición</label>
					<select class="browser-default">
						<option value="1" selected>Posición</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--UBICACION-->
				<div class="itemForm">
					<label>Ubicación</label>
					<input type="text" placeholder="Caracas - Venezuela">
				</div>

				<!--CALIFICACION-->
				<div class="itemForm">
					<label>Calificación</label>
					<select class="browser-default">
						<option value="1" selected>5 estrellas</option>
						<option value="2">Calificacion</option>
					</select>
				</div>

				<!--NIVEL-->
				<div class="itemForm">
					<label>Nivel</label>
					<select class="browser-default">
						<option value="1" selected>Hiring Pro</option>
						<option value="2">Hiring Pro</option>
						<option value="3">Hiring Pro</option>
					</select>
				</div>

				<!--TAMAÑO DE ORGANIZACION-->
				<div class="itemForm">
					<label>Tamaño de Organización</label>
					<select class="browser-default">
						<option value="1" selected>tamaño</option>
						<option value="2">tamaño</option>
						<option value="3">tamaño</option>
					</select>
				</div>

				<!--SUBMIT-->
				<div class="submit">
					<button type="submit" class="btn-main2">Buscar Supplier</button>
				</div>
			</form>
		</article>


		<!--LISTADO DE POST-->
		<article class="credits">
			<!--TITULO DE LA SECCION-->
			<section class="credits-title">
				<h3>Tienes <strong>1.234 Oportunidades</strong> disponibles</h3>

				<!--FILTRADO DE ORDEN-->
				<div class="orderFilter">
					<label>Ordenar por</label>
					<select class="browser-default">
						<option value="1" selected>Fecha</option>
						<option value="2">Comisión</option>
						<option value="3">Industria</option>
						<option value="4">Ubicación</option>
						<option value="5">Posición</option>
						<option value="6">Cantidad Supplier</option>
						<option value="7">Estado posiciones</option>
					</select>
				</div>
			</section>

			<!--LISTADO DE CREDITOS-->
			<ul class="supplier-container supplier-list">
				<!-- OPORTUNIDAD 1 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>

					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 2 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 3 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 4 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 5 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 6 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 7 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>

					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 8 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 9 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 10 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 11 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
					</div>
				</li>

				<!-- OPORTUNIDAD 12 -->
				<li>
					<a href="post-detail.php">
						<!--RESUMEN OPORTUNIDAD-->
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
					</a>
					
					<!--AGREGAR SUPPLIER-->
					<div class="add-supplier">
						<!--PERFIL-->
						<div class="link">
							<a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
								<span class="icon-gTalents_profile"></span>
							</a>
						</div>

						<!--AGREGAR SUPPLIER-->
						<div class="link">
							<a href="!">
								<span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
							</a>
						</div>
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
		</article>
	</article>
	
	<!--EQUIPO Y CANDIDATOS MOBILE-->
	<article class="team-mobile">
		<!--BOTON-->
		<a class="team-mobile-btn" id="btn-teamMobile">
			<span class="icon-gTalents_search"></span>
		</a>

		<!--TEAM GROUP-->
		<section class="team-mobile-container" id="teamMobile-container">
			<!--POST LIST FILTRADO-->
			<article class="postList-contain-filter filter-supplier">
				<form action="" class="formLogin">
					<h3>Filtra tu búsqueda</h3>

					<!--BUSQUEDA-->
					<div class="itemForm">
						<input type="text" placeholder="¿Qué buscas?" class="input-search">
					</div>

					<!--COMISION-->
					<div class="itemForm">
						<label>Áreas funcionales</label>
						<select class="browser-default">
							<option value="1" selected>Gerencia</option>
							<option value="2">Sra.</option>
							<option value="3">Dr.</option>
						</select>
					</div>

					<!--INDUSTRIA-->
					<div class="itemForm">
						<label>Industria</label>
						<select class="browser-default">
							<option value="1" selected>Diseño e Informática</option>
							<option value="2">Sra.</option>
							<option value="3">Dr.</option>
						</select>
					</div>

					<!--NIVELES DE POSICION-->
					<div class="itemForm">
						<label>Niveles de posición</label>
						<select class="browser-default">
							<option value="1" selected>Posición</option>
							<option value="2">Sra.</option>
							<option value="3">Dr.</option>
						</select>
					</div>

					<!--UBICACION-->
					<div class="itemForm">
						<label>Ubicación</label>
						<input type="text" placeholder="Caracas - Venezuela">
					</div>

					<!--CALIFICACION-->
					<div class="itemForm">
						<label>Calificación</label>
						<select class="browser-default">
							<option value="1" selected>5 estrellas</option>
							<option value="2">Calificacion</option>
						</select>
					</div>

					<!--NIVEL-->
					<div class="itemForm">
						<label>Nivel</label>
						<select class="browser-default">
							<option value="1" selected>Hiring Pro</option>
							<option value="2">Hiring Pro</option>
							<option value="3">Hiring Pro</option>
						</select>
					</div>

					<!--TAMAÑO DE ORGANIZACION-->
					<div class="itemForm">
						<label>Tamaño de Organización</label>
						<select class="browser-default">
							<option value="1" selected>tamaño</option>
							<option value="2">tamaño</option>
							<option value="3">tamaño</option>
						</select>
					</div>

					<!--SUBMIT-->
					<div class="submit">
						<button type="submit" class="btn-main2">Buscar Supplier</button>
					</div>
				</form>
			</article>
		</section>
	</article>

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