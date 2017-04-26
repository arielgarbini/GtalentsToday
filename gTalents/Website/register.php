<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>	
</head>
<body class="body-register">

	<!--CONTENEDOR PADRE PARA LOGIN-->
	<article class="login register">
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
			<!--NOMBRE-->
			<div class="itemForm">
				<label>Nombre</label>
				<input type="text" placeholder="Nombre">
				<span>Datos incorrectos</span>
			</div>

			<!--APELLIDO-->
			<div class="itemForm">
				<label>Apellido</label>
				<input type="text" placeholder="Apellido">
				<span>Datos incorrectos</span>
			</div>

			<!--CORREO ELECTRONICO-->
			<div class="itemForm">
				<label>Correo Electrónico</label>
				<input type="email" placeholder="Correo Electrónico">
				<span>Correo electrónico inválido</span>
			</div>

			<!--CONFIRME CORREO ELECTRONICO-->
			<div class="itemForm">
				<label>Confirme su Correo Electrónico</label>
				<input type="email" placeholder="Correo Electrónico">
				<span>Correo electrónico inválido</span>
			</div>

			<!--CONTRASEÑA-->
			<div class="itemForm">
				<label>Contraseña</label>
				<input type="password" placeholder="Mínimo 6 digitos">
				<span>Mínimo 6 dígitos</span>
			</div>

			<!--CONFIRME CONTRASEÑA-->
			<div class="itemForm">
				<label>Confirme su contraseña</label>
				<input type="password" placeholder="Mínimo 6 digitos">
				<span>Mínimo 6 dígitos</span>
			</div>

			<!--RECAPTCHA-->
			<div class="recaptcha">
				
			</div>

			<!--SUBMIT-->
			<div class="submit">
				<button type="submit" class="btn-main2">Registrarme</button>
			</div>

			<!--REGISTRARME-->
			<div class="submit">
				<p>¿Tienes una cuenta? <a href="login.php">¡Accede!</a></p>
			</div>
		</form>

		<!-- MENSAJE FINAL-->
		<section class="password-send">
			<h3>¡Gracias por registrarte!
				<br> Te contactaremos en breve
			</h3>
			<div class="link">
				<a href="index.php" class="btn-main2">Continuar</a>
			</div>
		</section>

	</article>

	

	<?php include 'inc/footer_common.php'; ?>
</body>
</html>