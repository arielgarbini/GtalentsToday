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
		<article class="postList-contain-filter no-mobile">
			<form action="" class="formLogin">
				<h3>Filtra tu búsqueda</h3>

				<!--BUSQUEDA-->
				<div class="itemForm">
					<input type="text" placeholder="¿Qué buscas?" class="input-search">
				</div>

				<!--COMISION-->
				<div class="itemForm">
					<label>Comisión</label>
					<select class="browser-default">
						<option value="1" selected>USD 25/hora</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--UBICACION-->
				<div class="itemForm">
					<label>Ubicación</label>
					<input type="text" placeholder="Caracas - Venezuela">
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

				<!--TITULO-->
				<div class="itemForm">
					<label>Titulo</label>
					<select class="browser-default">
						<option value="1" selected>Sales Director</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--PERIODOS-->
				<div class="itemForm">
					<label>Periodos</label>
					<select class="browser-default">
						<option value="1" selected>Dia anterior</option>
						<option value="2">Últimos 3 días</option>
						<option value="3">Últimos 7 días</option>
						<option value="4">Últimos 15 días</option>
						<option value="5">Últimos 30 días</option>
						<option value="6">Últimos 60 días</option>
					</select>
				</div>

				<!--SUBMIT-->
				<div class="submit">
					<button type="submit" class="btn-main2">Buscar Poster</button>
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
			<ul class="credits-container post-list">
				<!-- OPORTUNIDAD 1 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador .NET</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>47</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>9</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>3</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
				</li>

				<!-- OPORTUNIDAD 2 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador JAVA</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>89</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>150</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>100</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
				</li>

				<!-- OPORTUNIDAD 3 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador .NET</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>47</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>9</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>3</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
				</li>

				<!-- OPORTUNIDAD 4 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador JAVA</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>89</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>150</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>100</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
				</li>

				<!-- OPORTUNIDAD 5 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador .NET</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>47</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>9</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>3</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
				</li>

				<!-- OPORTUNIDAD 6 -->
				<li>
					<a href="post-detail.php" class="link-listado">
						<!--RESUMEN OPORTUNIDAD-->
						<section class="opportunity-admin">
							<!--DATOS DEL POST-->
							<div class="item-activity">
								<h5>Activo</h5>
								<h2>Desarrollador JAVA</h2>
								<h3>Buenos Aires, Argentina | REF49</h3>
								<p>Publicado | Jue,17 Nov 2016</p>
								<!--SECCIONES TOOLTIPS-->
								<div class="item-activity-leyend">
									<!--FACTURACION APROXIMADA-->
									<div class="item">
										<a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
											<span class="icon-gTalents_facturacion"></span>
										</a>
									</div>

									<!--CANTIDAD DE SUPPLIERS-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
										 	<span class="icon-gTalents_comision"></span>
										 </a>
									</div>

									<!--CONTIGENCY O RETAINED-->
									<div class="item">
										 <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
										 	<span class="icon-gTalents_estado-post"></span>
										 </a>
									</div>
								</div>

							</div>

							<!--RESUMEN DEL POST-->
							<div class="item">
								<!--VISITAS-->
								<div class="item-option">
									<h4>89</h4>
									<span class="opt-sm">Visitas</span>
								</div>

								<!--CANDIDATOS-->
								<div class="item-option">
									<h4>150</h4>
									<span class="opt-sm">Candidatos</span>
								</div>

								<!--POR ACEPTAR-->
								<div class="item-option">
									<h4>100</h4>
									<span class="opt-sm">Por aceptar</span>
								</div>
							</div>
						</section>
					</a>
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
			<article class="postList-contain-filter">
				<form action="" class="formLogin">
					<h3>Filtra tu búsqueda</h3>

					<!--BUSQUEDA-->
					<div class="itemForm">
						<input type="text" placeholder="¿Qué buscas?" class="input-search">
					</div>

					<!--COMISION-->
					<div class="itemForm">
						<label>Comisión</label>
						<select class="browser-default">
							<option value="1" selected>USD 25/hora</option>
							<option value="2">Sra.</option>
							<option value="3">Dr.</option>
						</select>
					</div>

					<!--UBICACION-->
					<div class="itemForm">
						<label>Ubicación</label>
						<input type="text" placeholder="Caracas - Venezuela">
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

					<!--TITULO-->
					<div class="itemForm">
						<label>Titulo</label>
						<select class="browser-default">
							<option value="1" selected>Sales Director</option>
							<option value="2">Sra.</option>
							<option value="3">Dr.</option>
						</select>
					</div>

					<!--PERIODOS-->
					<div class="itemForm">
						<label>Periodos</label>
						<select class="browser-default">
							<option value="1" selected>Dia anterior</option>
							<option value="2">Últimos 3 días</option>
							<option value="3">Últimos 7 días</option>
							<option value="4">Últimos 15 días</option>
							<option value="5">Últimos 30 días</option>
							<option value="6">Últimos 60 días</option>
						</select>
					</div>

					<!--SUBMIT-->
					<div class="submit">
						<button type="submit" class="btn-main2">Buscar Poster</button>
					</div>
				</form>
			</article>
		</section>
	</article>


	<?php include 'inc/footer_common.php'; ?>
</body>
</html>