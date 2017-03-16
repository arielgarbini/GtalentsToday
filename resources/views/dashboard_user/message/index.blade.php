@extends('layouts.app1')

@section('page-title', trans('app.messages'))

@section('content')
  <!-- MENSAJES CONTENEDOR -->
	<article class="message-main grid">
		<!--LISTADO DE CONTACTOS-->
		<section class="message-main-contact">
			<!--SEARCH-->
			<div class="team-container">
				<!-- RESUMEN-->
				<section class="team-container-tools">
					<!-- ACTIVO 1 -->
					<div class="active-one">
						<!--FILTRADO-->
						<select class="browser-default">
							<option value="" disabled selected>Todos los mensajes</option>
							<option value="1">Administrador</option>
							<option value="2">Poster</option>
							<option value="3">Novato</option>
						</select>

						<div class="search-opt1 btn-search">
							<span class="icon-gTalents_search"></span>
						</div>							
					</div>

					<!-- SECCION DE BUSQUEDA -->
					<form class="active-two">
						<input type="text" placeholder="Nombre del Colaborador">
						<!--CERRAR SEGMENTO-->
						<div class="close btn-closeInput">
							<span class="icon-gTalents_close"></span>
						</div>							
					</form>
				</section>
			</div>

			<!-- LISTADO DE SUPPLIER POR POST-->
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">
						<h3>Desarrollador Node.js</h3>
					</div>
					<div class="collapsible-body">
						<!--PERSONA 1-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 2-->
						<div class="team-card-person active">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 3-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 4-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 5-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="collapsible-header">
						<h3>Desarrollador .NET</h3>
					</div>
					<div class="collapsible-body">
						<!--PERSONA 1-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 2-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 3-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 4-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 5-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>
					</div>
				</li>
				<li>
					<div class="collapsible-header">
						<h3>Desarrollador JAVA</h3>
					</div>
					<div class="collapsible-body">
						<!--PERSONA 1-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 2-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 3-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 4-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>

						<!--PERSONA 5-->
						<div class="team-card-person">
							<figure>
								<span class="icon-gTalents_supplier-60"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
							</figure>
							<div class="datos">
								<h3>RET-12</h3>
								<p>Agregado recientemente</p>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</section>

		<!--MESAJE-->
		<section class="message-main-message">
			<!--CABECERA MENSAJE-->
			<div class="message-header">
				<!--USUARIO-->
				<div class="item">
					<figure>
						<span class="icon-gTalents_message-header"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
					</figure>
					<div class="datos">
						<h4>RET-012</h4>
						<p>Agregado recientemente</p>
					</div>
				</div>

				<!--OPORTUNIDAD-->
				<div class="item">
					<h4>
						<a href="post-detail.php">Desarrollador Node.js</a>
					</h4>
					<p>Creado por ti</p>
				</div>
			</div>

			<!--MENSAJE-->
			<div class="message-body">
				<!--FECHA DE CONVERSACION-->
				<h5>20 de Noviembre</h5>

				<!--MENSAJE RECIBIDO-->
				<div class="message-body-general received">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hola! ¿Cómo estas?
							<br>Acabo de ver tu Post y me interesa mucho colaborarte con lo que buscas. Sin embargo, veo una ambiguedad con el perfil que planteas. ¿Puedes ser mas especifico?
						</p>
					</div>
					<span>14:15</span>
				</div>

				<!--MENSAJE ENVIADO-->
				<div class="message-body-general send">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hey! Me disculpo por la demora en responderte.
							<br>En efecto, estaba generalizando mucho le perfil profesional que busco y acabo de editar el post. Te invito a leerlo nuevamente, si me puedes ayudar estaria agradecido.
						</p>
					</div>
					<span>16:11</span>
				</div>

				<!--MENSAJE RECIBIDO-->
				<div class="message-body-general received">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hola! ¿Cómo estas?
							<br>Acabo de ver tu Post y me interesa mucho colaborarte con lo que buscas. Sin embargo, veo una ambiguedad con el perfil que planteas. ¿Puedes ser mas especifico?
						</p>
					</div>
					<span>14:15</span>
				</div>

				<!--MENSAJE ENVIADO-->
				<div class="message-body-general send">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hey! Me disculpo por la demora en responderte.
							<br>En efecto, estaba generalizando mucho le perfil profesional que busco y acabo de editar el post. Te invito a leerlo nuevamente, si me puedes ayudar estaria agradecido.
						</p>
					</div>
					<span>16:11</span>
				</div>

				<!--MENSAJE RECIBIDO-->
				<div class="message-body-general received">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hola! ¿Cómo estas?
							<br>Acabo de ver tu Post y me interesa mucho colaborarte con lo que buscas. Sin embargo, veo una ambiguedad con el perfil que planteas. ¿Puedes ser mas especifico?
						</p>
					</div>
					<span>14:15</span>
				</div>

				<!--MENSAJE ENVIADO-->
				<div class="message-body-general send">
					<!--CONTENEDOR INFORMACION-->
					<div class="item">
						<p>
							¡Hey! Me disculpo por la demora en responderte.
							<br>En efecto, estaba generalizando mucho le perfil profesional que busco y acabo de editar el post. Te invito a leerlo nuevamente, si me puedes ayudar estaria agradecido.
						</p>
					</div>
					<span>16:11</span>
				</div>
			</div>

			<!--FORMULARIO ENVIAR MENSAJE-->
			<form class="message-footer">
				<textarea name="" id="" cols="30" rows="10" placeholder="Responde o envía un mensaje"></textarea>
				<div class="item">
					<a href="#" class="btn-main" type="submit">Enviar Mensaje</a>
				</div>
			</form>
		</section>
	</article>
@stop

@section('scripts')
   
@stop
