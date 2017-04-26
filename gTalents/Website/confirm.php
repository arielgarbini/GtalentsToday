<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>
</head>
<body class="body-confirm">
	<!--HEADER PARA CONFIRMACION DE REGISTRO-->
	<header class="grid">
		<!--LOGOTIPO-->
		<figure>
			<a href="index.php">
				<img src="img/logotipo.png" alt="">
			</a>
		</figure>

		<!--SELECTOR DE IDIOMAS-->
		<section class="language">
			<select class="browser-default">
				<option value="" disabled selected>Elige tu idioma</option>
				<option value="1">Español</option>
				<option value="2">Inglés</option>
				<option value="3">Portugues</option>
			</select>
		</section>
	</header>

	<!-- INDICADORES DE SECUENCIA-->
	<ul class="grid">
		<!--INFO DE CONTACTO-->
		<li class="active" id="btn-infoContactoConfirm">
			<span class="icon-gTalents_contact-card"></span>
			<p>Info. de Contacto</p>
		</li>

		<!--ANTECEDENTES-->
		<li id="btn-antecentesConfirm">
			<span class="icon-gTalents_antecedentes"></span>
			<p>Antecedentes</p>
		</li>

		<!--PREFERENCIAS-->
		<li id="btn-preferenciasConfirm">
			<span class="icon-gTalents_preferencias"></span>
			<p>Preferencias</p>
		</li>

		<!--INFORMACION LEGAL-->
		<li id="btn-infoLegalConfirm">
			<span class="icon-gTalents_legal"></span>
			<p>Información legal</p>
		</li>
	</ul>

	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="register">

		<!--FORMULARIO login-->
		<form action="" class="formLogin login" id="form-confirm">
			<!--PASO 1 | INFORMACION DE CONTAINER-->

			<!--PASO 1-1 | DETALLES DE CONTACTO-->
			<div class="formContainer-confirm" id="paso1-1">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Detalles de Contacto</h4>
					<p>Puedes corregir tus datos personales</p>
				</div>

				<!--PREFIJO-->
				<div class="itemForm">
					<label>Prefijo</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige un prefijo</option>
						<option value="1">Sr.</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--NOMBRE-->
				<div class="itemForm">
					<label>Nombre</label>
					<input type="text" placeholder="Nombre">
				</div>

				<!--APELLIDO-->
				<div class="itemForm">
					<label>Apellido</label>
					<input type="text" placeholder="Apellido">
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>Correo Electrónico</label>
					<input type="email" placeholder="Correo Electrónico">
					<span>Correo electrónico inválido</span>
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>Confirme correo electrónico</label>
					<input type="email" placeholder="Confirme correo electrónico">
					<span>Correo electrónico inválido</span>
				</div>

				<!--TELEFONO PRINCIPAL-->
				<div class="itemForm">
					<label>Teléfono principal</label>
					<input type="phone" placeholder="Teléfono principal">
				</div>

				<!--TELEFONO SECUNDARIO-->
				<div class="itemForm">
					<label>Teléfono secundario</label>
					<input type="phone" placeholder="Teléfono secundario">
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
					<div class="leyend-point"></div>
				</div>		
			</div>

			<!--PASO 1-2 | DIRECCION-->
			<div class="formContainer-confirm" id="paso1-2">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Dirección</h4>
				</div>

				<!--PAIS-->
				<div class="itemForm">
					<label>País</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige tu país</option>
						<option value="1">Español</option>
						<option value="2">Inglés</option>
						<option value="3">Portugues</option>
					</select>
				</div>

				<!--DIRECCION-->
				<div class="itemForm">
					<label>Dirección</label>
					<textarea name="" id="" cols="30" rows="10"></textarea>
				</div>

				<!--CORREO ELECTRONICO-->
				<div class="itemForm">
					<label>Dirección 2</label>
					<input type="text" placeholder="Complemento">
				</div>

				<!--CIUDAD-->
				<div class="itemForm">
					<label>Ciudad</label>
					<input type="text" placeholder="Ciudad">
				</div>

				<!--PROVINCIA-->
				<div class="itemForm">
					<label>Estado/Provincia</label>
					<input type="text" placeholder="Estado/Provincia">
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>				
			</div>

			<!--PASO 1-3 | INFO. COMPAÑIA-->
			<div class="formContainer-confirm" id="paso1-3">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Información de la compañía</h4>
				</div>
				
				<!--NOMBRE DE LA EMPRESA-->
				<div class="itemForm">
					<label>Nombre de la Empresa</label>
					<input type="text" placeholder="Nombre de la Empresa">
				</div>

				<!--WEBSITE-->
				<div class="itemForm">
					<label>Sitio web</label>
					<input type="text" placeholder="Sitio web">
				</div>

				<!--TAMAÑO DE LA EMPRESA-->
				<div class="itemForm">
					<label>Tamaño de la Empresa</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige cantidad empleados</option>
						<option value="1">1-5</option>
						<option value="2">6-10</option>
						<option value="3">11-20</option>
					</select>
				</div>

				<!--ESTADO DE LA DIVERSIDAD-->
				<div class="itemForm">
					<label>Estado de la Diversidad</label>
					<select class="browser-default">
						<option value="" disabled selected>Diversidads</option>
						<option value="1">1-5</option>
						<option value="2">6-10</option>
						<option value="3">11-20</option>
					</select>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
				</div>
			</div>				

			<!--PASO 2 | INFORMACION DE CONTAINER-->
			<!--PASO 2-1 | DETALLES PERSONALES-->
			<div class="formContainer-confirm" id="paso2-1">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Detalles personales</h4>
				</div>
				
				<!--DESCRIPCION PERSONAL/COMPAÑIA-->
				<div class="itemForm">
					<label>Descripción personal/compañia</label>
					<textarea name="" id="" cols="30" rows="10"></textarea>
				</div>

				<!--AÑOS DE RECLUTAMIENTO-->
				<div class="itemForm">
					<label>Años de reclutamiento</label>
					<select class="browser-default">
						<option value="" disabled selected>¿Cuantos años en la industria?</option>
						<option value="1">2</option>
						<option value="2">3.</option>
						<option value="3">5</option>
					</select>
				</div>

				<!--NIVEL DE EDUCACIÓN-->
				<div class="itemForm">
					<label>Nivel de educación</label>
					<select class="browser-default">
						<option value="" disabled selected>Nivel de educación</option>
						<option value="1">Bachiller</option>
						<option value="2">TSU</option>
						<option value="3">Universitario</option>
					</select>
				</div>

				<!--ESCUELAS ASISTIDAS-->
				<div class="itemForm">
					<label>Escuelas asistidas</label>
					<input type="text" placeholder="Escuelas asistidas">
				</div>

				<!--MEMBRESIAS-->
				<div class="itemForm">
					<label>Membresías</label>
					<input type="text" placeholder="Membresías">
				</div>

				<!--CERTIFICACION-->
				<div class="itemForm">
					<label>Certificación</label>
					<select class="browser-default" id="select-certificado">
						<option value="" disabled selected>Selecciona uno</option>
						<option value="1">Bachiller</option>
						<option value="2">TSU</option>
						<option value="3">Universitario</option>
					</select>
					<div id="new-certify"></div>
					<!--AGREGAR OTRA CERTIFICACION-->
					<p><a href="#!" id="btn-certificado">Agregar otra certificación</a></p>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>	
			</div>

			<!--PASO 2-2 | ESPECIALIZACION-->
			<div class="formContainer-confirm" id="paso2-2">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Especialización</h4>
				</div>

				<!-- SELECTORES DE CATEGORIAS -->
				<div class="categoria-container">
					<!--CATEGORIA 1-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>Funciones de trabajo</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones">
							<!--OPCION 1-->
							<li>
								<a href="#!" class="subopciones-tag2">
									<p>Artistico</p>
									<span class="icon-gTalents_next"></span>
								</a>

								<!--CATEGORIAS OPCION 1-->
								<ul class="subopciones-select">
									<!--ITEM 1-->
									<li>
										<a href="#!">
											<p>Desarrollo de Contenidos Digitales</p>
										</a>
									</li>

									<!--ITEM 2-->
									<li>
										<a href="#!">
											<p>Documentación/Escritura técnica</p>
										</a>
									</li>

									<!--ITEM 3-->
									<li>
										<a href="#!">
											<p>Periodismo</p>
										</a>
									</li>
								</ul>
							</li>

							<!--OPCION 2-->
							<li>
								<a href="#!" class="subopciones-tag2">
									<p>Artistico</p>
									<span class="icon-gTalents_next"></span>
								</a>

								<!--CATEGORIAS OPCION 1-->
								<ul class="subopciones-select">
									<!--ITEM 1-->
									<li>
										<a href="#!">
											<p>Desarrollo de Contenidos Digitales</p>
										</a>
									</li>

									<!--ITEM 2-->
									<li>
										<a href="#!">
											<p>Documentación/Escritura técnica</p>
										</a>
									</li>

									<!--ITEM 3-->
									<li>
										<a href="#!">
											<p>Periodismo</p>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>

					<!--CATEGORIA 2-->
					<div class="categoria-container-item">
						<!--TITULO CATEGORIA-->
						<a href="#!" class="option subopciones-tag">
							<span class="icon-gTalents_point"></span>
							<h3>Categoria 2</h3>
						</a>

						<!--CONTENEDOR DE SUB-OPCIONES-->
						<ul class="subopciones">
							<!--OPCION 1-->
							<li>
								<a href="#!" class="subopciones-tag2">
									<p>Artistico</p>
									<span class="icon-gTalents_next"></span>
								</a>

								<!--CATEGORIAS OPCION 1-->
								<ul class="subopciones-select">
									<!--ITEM 1-->
									<li>
										<a href="#!" class="active-option">
											<p>Desarrollo de Contenidos Digitales</p>
										</a>
									</li>

									<!--ITEM 2-->
									<li>
										<a href="#!">
											<p>Documentación/Escritura técnica</p>
										</a>
									</li>

									<!--ITEM 3-->
									<li>
										<a href="#!">
											<p>Periodismo</p>
										</a>
									</li>
								</ul>

							</li>
						</ul>
					</div>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
				</div>
			</div>

			<!--PASO 3 | PREFERENCIAS-->
			<!--PASO 3-1 | DETALLES DE CONTACTO-->
			<div class="formContainer-confirm" id="paso3">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Seguridad</h4>
					<p>Nos preocupa tu privacidad</p>
				</div>

				<!--CONTRASEÑA-->
				<div class="itemForm">
					<label>Contraseña</label>
					<input type="password">
					<span>Mínimo 6 dígitos</span>
				</div>

				<!--CONFIRMAR CONTRASEÑA-->
				<div class="itemForm">
					<label>Confirme su Contraseña</label>
					<input type="password">
					<span>Mínimo 6 dígitos</span>
				</div>

				<!--PREGUNTA DE SEGURIDAD-->
				<div class="itemForm">
					<label>Pregunta de Seguridad 1</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige una pregunta</option>
						<option value="1">Pregunta 1</option>
						<option value="2">Pregunta 2</option>
						<option value="3">Pregunta 3</option>
					</select>
				</div>

				<!--RESPUESTA 1 A PREGUNTA DE SEGURIDAD-->
				<div class="itemForm">
					<label>Respuesta 1</label>
					<input type="text" placeholder="Respuesta 1">
				</div>

				<!--PREGUNTA DE SEGURIDAD 2-->
				<div class="itemForm">
					<label>Pregunta de Seguridad 2</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige una pregunta</option>
						<option value="1">Pregunta 1</option>
						<option value="2">Pregunta 2</option>
						<option value="3">Pregunta 3</option>
					</select>
				</div>

				<!--RESPUESTA 2 A PREGUNTA DE SEGURIDAD-->
				<div class="itemForm">
					<label>Respuesta 2</label>
					<input type="text" placeholder="Respuesta 2">
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
				      <label for="filled-in-box">Deseo recibir mensajes de correo electrónico cuando se publican nuevos Generosidades que coincidan perfil</label>
				    </p>
				</div>
			</div>

			<!--PASO 4 | INFORMACION LEGAL-->
			<!--PASO 4-1 | INFORMACION LEGAL-->
			<div class="formContainer-confirm" id="paso4-1">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Información Legal</h4>
				</div>

				<!--PRIMER NOMBRE LEGAL-->
				<div class="itemForm">
					<label>Primer nombre Legal</label>
					<input type="text" placeholder="Primer nombre Legal">
				</div>

				<!--APELLIDO LEGAL-->
				<div class="itemForm">
					<label>Apellido Legal</label>
					<input type="text" placeholder="Apellido Legal">
				</div>

				<!--NOMBRE LEGAL-->
				<div class="itemForm">
					<label>Nombre legal de la compañia</label>
					<input type="text" placeholder="Nombre legal de la compañia">
				</div>

				<!--TIPO DE COMPAÑIA-->
				<div class="itemForm">
					<label>Tipo de Compañia</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige un tipo</option>
						<option value="1">Sr.</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--DIVISA PRINCIPAL-->
				<div class="itemForm">
					<label>Divisa principal</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige un tipo de divisa</option>
						<option value="1">Sr.</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--PAIS-->
				<div class="itemForm">
					<label>País</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige un país</option>
						<option value="1">Sr.</option>
						<option value="2">Sra.</option>
						<option value="3">Dr.</option>
					</select>
				</div>

				<!--DIRECCION-->
				<div class="itemForm">
					<label>Dirección</label>
					<textarea name="" id="" cols="30" rows="10"></textarea>
				</div>

				<!--DIRECCION 2-->
				<div class="itemForm">
					<label>Dirección 2</label>
					<input type="text" placeholder="Complemento">
				</div>

				<!--CIUDAD-->
				<div class="itemForm">
					<label>Ciudad</label>
					<input type="text" placeholder="Ciudad">
				</div>

				<!--ESTADO/PROVINCIA-->
				<div class="itemForm">
					<label>Estado/Provincia</label>
					<input type="text" placeholder="Estado/Provincia">
				</div>

				<!--CODIGO POSTAL-->
				<div class="itemForm">
					<label>Código Postal</label>
					<input type="phone" placeholder="Código Postal">
				</div>

				<!--CONDICIONES DE USO-->
				<div class="condiciones-uso">
					<h4>Condiciones de Uso</h4>
					<div class="condiciones-uso-container">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus veritatis quisquam, dignissimos distinctio, eos repellendus dolore ab quasi repellat voluptates ex vitae minima tempore commodi non repudiandae earum. Rem, molestiae!</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere enim, voluptas impedit culpa ut debitis dolorem. Suscipit dolore, tempore architecto id ipsam sequi, sint ab earum ullam libero ducimus vel.</p>

						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere enim, voluptas impedit culpa ut debitis dolorem. Suscipit dolore, tempore architecto id ipsam sequi, sint ab earum ullam libero ducimus vel.</p>
					</div>
				</div>

				<!--CHECKBOX DE TERMINOS-->
				<div class="itemCheck">
					<p>
				      <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
				      <label for="filled-in-box">* Acepto las gTalents Condiciones de Uso</label>
				    </p>
				</div>

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point active"></div>
					<div class="leyend-point"></div>
				</div>
			</div>

			<!--PASO 4-2 | ULTIMO PASO-->
			<div class="formContainer-confirm" id="paso4-2">
				<!--TITULO DE LA SECCION-->
				<div class="formLogin-title">
					<h4>Último paso</h4>
				</div>

				<!--TIENES UN CODIGO PROMOCIONAL-->
				<div class="itemRadio">
					<h4>¿Tiene un código promocional?</h4>
					<div class="itemRadio-radio">
						<p>
							<input name="group1" type="radio" id="test1" />
							<label for="test1">Si</label>
						</p>
						<p>
							<input name="group1" type="radio" id="test2" />
							<label for="test2">No</label>
						</p>
					</div>
				</div>

				<!--CODIGO PROMOCIONAL-->
				<div class="itemForm">
					<label>Código promocional</label>
					<input type="text" placeholder="Código promocional">
				</div>

				<!--COMO SUPISTE DE NOSOTROS-->
				<div class="itemForm">
					<label>¿Cómo supiste de nosotros?</label>
					<select class="browser-default">
						<option value="" disabled selected>¿Cómo supiste de nosotros?</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>

				<!--PAPEL EN LA ORGANIZACION-->
				<div class="itemRadio">
					<h4>¿Cuál es su papel dentro de su organización?</h4>
					<div class="itemRadio-radio">
						<p>
							<input name="group2" type="radio" id="test3" />
							<label for="test3">Reclutamiento</label>
						</p>
						<p>
							<input name="group2" type="radio" id="test4" />
							<label for="test4">Negocios</label>
						</p>
						<p>
							<input name="group2" type="radio" id="test5" />
							<label for="test5">Ambos</label>
						</p>
					</div>
				</div>

				<!--PRINCIPALES MEDIOS DE ABASTECIMIENTO-->
				<div class="itemForm">
					<label>¿Cuales son sus principales medios de abastecimiento</label>
					<select class="browser-default">
						<option value="" disabled selected>Elige tu respuesta</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
					</select>
				</div>	

				<!--LEYENDA PUNTOS-->
				<div class="leyend">
					<div class="leyend-point"></div>
					<div class="leyend-point active"></div>
				</div>		
			</div>

			<!--PASO 4-3 | MENSAJE FINAL-->
			<div class="formContainer-confirm" id="paso4-3">
				<!--MENSAJE FINAL-->
				<div class="message-finish">
					<h3>¡Gracias por preferirnos!</h3>
					<p>Procederemos a validar tu información y te contactaremos a la mayor brevedad posible</p>
					<div class="link">
						<a href="index.php" class="btn-main">Continuar</a>
					</div>
				</div>
			</div>
			
		</form>

		<!--BOTONES NEXT Y LEFT-->
		<section class="move">
			<!--left-->
			<div class="move-link" id="btn-return-confirm1">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm1">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 1-2 a 1-3 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm2">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm2">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 1-3 a 2-1 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm3">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm3">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 2-1 a 2-2 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm4">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm4">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 2-2 a 3 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm5">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm5">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 3 a 4-1 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm6">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm6">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 4-1 a 4-2 -->
			<!--left-->
			<div class="move-link" id="btn-return-confirm7">
				<a href="#!" class="btn-return">Paso anterior</a>
			</div>

			<!--next-->
			<div class="move-link" id="btn-next-confirm7">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>

			<!-- PASO 4-2 a 4-3 -->
			<!--next-->
			<div class="move-link" id="btn-next-confirm8">
				<a href="#!" class="btn-main" >Próximo paso</a>
			</div>
		</<section>			

	</article>

	

	<?php include 'inc/footer_common.php'; ?>
</body>
</html>