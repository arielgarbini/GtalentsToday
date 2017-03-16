<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>	
</head>
<body class="body-login">

	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="login">
		<!--TITULO DE LA SECCION-->
		<section class="login-title">
			<figure>
				<a href="index.php">
					<img src="img/logotipo.png" alt="gtalents logotipo">
				</a>
			</figure>
			<p>Una cuenta, muchos beneficios</p>
		</section>

		<!--FORMULARIO login-->
		<form action="" class="formLogin" id="login-container">
			<!--CORREO ELECTRONICO-->
			<div class="itemForm">
				<label>Correo Electrónico</label>
				<input type="email" placeholder="Correo Electrónico">
				<span>Correo electrónico inválido</span>
			</div>

			<!--CONTRASEÑA-->
			<div class="itemForm">
				<label>Contraseña</label>
				<input type="password">
				<span>Mínimo 6 dígitos</span>
			</div>

			<!--RECUPERAR CONTRASEÑA-->
			<div class="recover">
				<p><a href="#!" id="btn-recover">¿Olvidaste tu contraseña?</a></p>
			</div>

			<!--SUBMIT-->
			<div class="submit">
				<button type="submit" class="btn-main2">Ingresar</button>
			</div>

			<!--REGISTRARME-->
			<div class="submit">
				<p>¿No tienes una cuenta? <a href="register.php">Regístrate</a></p>
			</div>
		</form>

		<!--FORMULARIO recuperar contraseña-->
		<form action="" class="formLogin" id="recover-container">
			<!--CORREO ELECTRONICO-->
			<div class="itemForm">
				<label>Correo Electrónico</label>
				<input type="email" placeholder="Correo Electrónico">
				<span>Correo electrónico inválido</span>
			</div>

			<!--SUBMIT-->
			<div class="submit">
				<button type="submit" class="btn-main2">Enviar</button>
			</div>

			<!--REGRESAR-->
			<div class="submit">
				<p><a href="#!" id="btn-returnContainer">Regresar</a></p>
			</div>		
		</form>

		<!-- MENSAJE FINAL-->
		<section class="password-send">
			<h3>¡Revisa la bandeja de entrada de tu correo electrónico!</h3>
			<div class="link">
				<a href="index.php" class="btn-main2">Continuar</a>
			</div>
		</section>

	</article>

	

	<?php include 'inc/footer_common.php'; ?>
</body>
</html>