<!--HEADER USUARIO REGISTRADO-->
<header class="header-registered">
	<!--LOGOTIPO Y SELECTORES-->
	<section class="header-registered-container grid">
		<!--LOGOTIPO-->
		<div class="item-logo">
			<a href="index-registrado.php">
				<figure>
					<img src="img/logotipo.png" alt="gtalents logotipo">
				</figure>
			</a>
		</div>

		<!-- OPCIONES GENERALES-->
		<ul class="item">
			<!--SELECT IDIOMAS-->
			<li>
				<div class="language">
					<select class="browser-default">
						<option value="" disabled selected>idioma</option>
						<option value="1">Español</option>
						<option value="2">Inglés</option>
						<option value="3">Portugues</option>
					</select>
				</div>
			</li>

			<!--LISTADO DE POST-->
			<li>
				<a href="post-list.php">
					<p>Post</p>
				</a>
			</li>

			<!--NUEVO POST-->
			<li class="item-newPost">
				<a href="new-post.php">
					<p>Nuevo Post</p>
				</a>
			</li>

			<!--MENSAJES ALERT-->
			<li>
				<a href="message.php">
					<figure class="icon-message">
						<span class="icon-gTalents_message"></span>
					</figure>
					<figure class="icon-alert">
						<span class="icon-gTalents_point"></span>
					</figure>
				</a>
			</li>

			<!--ALERTAS-->
			<li>
				<a href="#!" id="btn-alertNav">
					<figure class="icon-message">
						<span class="icon-gTalents_alert"></span>
					</figure>
					<figure class="icon-alert">
						<span class="icon-gTalents_point"></span>
					</figure>
				</a>

				<!-- NOTIFICACIONES -->
				<div class="bills" id="alertNavContain">
					<!--ALERTAS-->
					<ul class="alerts-div">
						<!--ALERTA 1-->
						<li>
							<div class="motivo">
								<a href="#">
									<figure>
										<span class="icon-gTalents_point"></span>
									</figure>
									<div class="datos">
										<h4>¡Nuevo Candidato!</h4>
										<p>Desarrollador .NET</p>
									</div>
								</a>
							</div>
							<!--BTN ELIMINAR -->
							<span class="icon-gTalents_close close-alert"></span>
						</li>

						<!--ALERTA 2-->
						<li>
							<div class="motivo">
								<a href="#">
									<figure>
										<span class="icon-gTalents_point"></span>
									</figure>
									<div class="datos">
										<h4>¡Nuevo Candidato!</h4>
										<p>Desarrollador .NET</p>
									</div>
								</a>
							</div>
							<!--BTN ELIMINAR -->
							<span class="icon-gTalents_close close-alert"></span>
						</li>

						<!--ALERTA 3-->
						<li>
							<div class="motivo">
								<a href="#">
									<figure>
										<span class="icon-gTalents_point"></span>
									</figure>
									<div class="datos">
										<h4>¡Nuevo Candidato!</h4>
										<p>Desarrollador .NET</p>
									</div>
								</a>
							</div>
							<!--BTN ELIMINAR -->
							<span class="icon-gTalents_close close-alert"></span>
						</li>

						<!--ALERTA 4-->
						<li>
							<div class="motivo">
								<a href="#">
									<figure>
										<span class="icon-gTalents_point"></span>
									</figure>
									<div class="datos">
										<h4>¡Nuevo Candidato!</h4>
										<p>Desarrollador .NET</p>
									</div>
								</a>
							</div>
							<!--BTN ELIMINAR -->
							<span class="icon-gTalents_close close-alert"></span>
						</li>

						<!--ALERTA 5-->
						<li>
							<div class="motivo">
								<a href="#">
									<figure>
										<span class="icon-gTalents_point"></span>
									</figure>
									<div class="datos">
										<h4>¡Nuevo Candidato!</h4>
										<p>Desarrollador .NET</p>
									</div>
								</a>
							</div>
							<!--BTN ELIMINAR -->
							<span class="icon-gTalents_close close-alert"></span>
						</li>	
					</ul>				
				</div>
			</li>

			<!--USUARIO-->
			<li>
				<a class="btn dropdown-button" href="#!" data-activates="dropdown2">
					<span class="icon-gTalents_user"></span>
					<p>Comandos</p>
				</a>
				<ul id="dropdown2" class="dropdown-content">
					<li>
						<a href="#!">Cerrar Sesión</a>
					</li>
				</ul>
			</li>
		</ul>
	</section>

	<!--NAVEGACION-->
	<nav>
		<!--ICONO MENU MOBILE-->
		<div class="nav-mobile">
			<!--MENU HAMBURGUESA-->
			<div class="nav-mobile-item">
				<a href="#!" id="btn-menuHamburguer">
					<span class="icon-gTalents_hamburguesa hamburguer-1"></span>
					<span class="icon-gTalents_close-simple hamburguer-2"></span>
				</a>
			</div>
		</div>

		<ul class="grid">
			<!--INICIO-->
			<li class="active">
				<a href="index-registrado.php">
					<p>Inicio</p>
				</a>
			</li>
			<!--POST (SOLO SE VERA EN MOBILE)-->
			<li class="option-mobile">
				<a href="post.php">
					<p>Post</p>
				</a>
			</li>
			<!--MIS OPORTUNIDADES-->
			<li>
				<a href="mis-oportunidades.php">
					<p>Mis Oportunidades</p>
				</a>
			</li>
			<!--MI EQUIPO-->
			<li>
				<a href="mi-equipo.php">
					<p>Mi Equipo</p>
				</a>
			</li>
			<!--MIS CANDIDATOS-->
			<li>
				<a href="mis-candidatos.php">
					<p>Mis Candidatos</p>
				</a>
			</li>
			<!--MIS FACTURAS-->
			<li>
				<a href="mis-facturas.php">
					<p>Mis Facturas</p>
				</a>
			</li>
			<!--MIS CALIFICACIONES-->
			<li>
				<a href="mis-calificaciones.php">
					<p>Mis Calificaciones</p>
				</a>
			</li>
			<!--MIS CREDITOS-->
			<li>
				<a href="mis-creditos.php">
					<p>Mis Creditos</p>
				</a>
			</li>
		</ul>
	</nav>
</header>