<!DOCTYPE html>
<html lang="es">
<head>
	<?php include 'inc/head_common.php'; ?>
</head>
<body class="body-registered">
	<?php include 'inc/header-registrado.php'; ?>

	<!--CONTENEDOR DE FACTURAS POR COBRAR-->
	<article class="bills grid">
		<!--TITULO-->
		<section class="bills-title">
			<h3>Mis Facturas a Cobrar</h3>
		</section>

		<!--TABLA DE FACTURAS-->
		<table>
			<thead>
				<tr>
					<th data-field="id">Fecha</th>
					<th data-field="name">Oportunidad</th>
					<th data-field="price">Monto</th>
					<th clasS="P-estatus">Estatus</th>
				</tr>
			</thead>

			<tbody>
				<!--FACTURA 1-->
				<tr>
					<td>25/10/2016</td>
					<td>Programador JAVA</td>
					<td>99 USD</td>
					<td clasS="P-estatus">Esperando Pago</td>
				</tr>

				<!--FACTURA 2-->
				<tr>
					<td>25/10/2016</td>
					<td>Diseñador UX/UI</td>
					<td>45 USD</td>
					<td clasS="P-estatus">Pago aceptado</td>
				</tr>

				<!--FACTURA 3-->
				<tr>
					<td>25/10/2016</td>
					<td>Reclutador IT</td>
					<td>75 USD</td>
					<td clasS="P-estatus">Pago Rechazado</td>
				</tr>
			</tbody>
		</table>
	</article>

	<!--CONTENEDOR DE FACTURAS POR PAGAR-->
	<article class="bills grid">
		<!--TITULO-->
		<section class="bills-title">
			<h3>Mis Facturas a Pagar</h3>
		</section>

		<!--TABLA DE FACTURAS-->
		<table>
			<thead>
				<tr>
					<th data-field="id">Fecha</th>
					<th data-field="name">Oportunidad</th>
					<th data-field="price">Monto</th>
					<th clasS="P-estatus">Estatus</th>
					<th class="Tcargo">Tipo de Cargo</th>
					<th>Factura</th>
				</tr>
			</thead>

			<tbody>
				<!--FACTURA 1-->
				<tr>
					<td>25/10/2016</td>
					<td>Programador JAVA</td>
					<td>99 USD</td>
					<td clasS="P-estatus">Esperando Pago</td>
					<td class="Tcargo">depósito</td>
					<td>
						<a href="#!">Descargar Factura</a>
					</td>
				</tr>

				<!--FACTURA 2-->
				<tr>
					<td>25/10/2016</td>
					<td>Diseñador UX/UI</td>
					<td>45 USD</td>
					<td clasS="P-estatus">Pago aceptado</td>
					<td class="Tcargo">depósito</td>
					<td>
						<a href="#!">Descargar Factura</a>
					</td>
				</tr>

				<!--FACTURA 3-->
				<tr>
					<td>25/10/2016</td>
					<td>Reclutador IT</td>
					<td>75 USD</td>
					<td clasS="P-estatus">Pago Rechazado</td>
					<td class="Tcargo">depósito</td>
					<td>
						<a href="#!">Descargar Factura</a>
					</td>
				</tr>
			</tbody>
		</table>
	</article>
	

	<?php include 'inc/footer_common.php'; ?>
</body>
</html>