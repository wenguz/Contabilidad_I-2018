<?php
/*~ Archivo balance-general.php
.---------------------------------------------------------------------------.
|    Software: CAS - Computerized Accountancy System                        |
|     Versión: 1.0                                                          |
|   Lenguajes: PHP, HTML, CSS3 y Javascript                                 |
| ------------------------------------------------------------------------- |
|   Autores: Ricardo Vigil (alexcontreras@outlook.com)                      |
|          : Vanessa Campos                                                 |
|          : Ingrid Aguilar                                                 |
|          : Jhosseline Rodriguez                                           |
| Copyright (C) 2013, FIA-UES. Todos los derechos reservados.               |
| ------------------------------------------------------------------------- |
|                                                                           |
| Este archivo es parte del sistema de contabilidad C.A.S para la cátedra   |
| de Sistemas Contables de la Facultad de Ingeniería y Arquitectura de la   |
| Universidad de El Salvador.                                               |
|                                                                           |
'---------------------------------------------------------------------------'
*/
?>
<?php 
	include("sesion.php");
	if(!$_COOKIE["sesion"]){
		header("Location: salir.php");
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css"/>
	<link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
	<script>
		!window.jQuery && document.write("<script src='../js/jquery.min.js'><\/script>");
	</script>
	<title>Balance General</title>
</head>

<body>
	<!-- Barra de navegación -->
	<?php include("nav.php"); ?>

	<!-- Contenido de la página -->
	<div class="container" id="contenido">
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-xs-12 col-sm-9">
				<div class="page-header">
					<h3>Balance General</h3>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-lg-12">

							<table class="table ">
								<thead>
									<tr>
										<th colspan="4">
										<h2 class="text-center">Balance General</h2>
										<!--
											<h2 class="text-center">Vinos Nonualcos y Cia. S.A</h2>
											<p align="center">
												<strong>Balance General</strong>
											</p>
											-->
											<p align="center">
												<script>
													var month=new Array();
													month[0]="Enero";
													month[1]="Febrero";
													month[2]="Marzo";
													month[3]="Abril";
													month[4]="Mayo";
													month[5]="Junio";
													month[6]="Julio";
													month[7]="Agosto";
													month[8]="Septiembre";
													month[9]="Octubre";
													month[10]="Noviembre";
													month[11]="Diciembre";
													var fecha = new Date();
													document.write("Al " + fecha.getDate() + " de " + month[fecha.getMonth()] + " de " + fecha.getFullYear());
											</script>
											</p>
										</th>
									</tr>
								</thead>
							</table>

						</div>

						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									<div>
										<div class="row">
											<div class="col-lg-12">

												<table class="table table-condensed table-hover ">
													<tr>
														<th colspan="2">Activos</th>
													</tr>
													<?php
													include_once("conexion.php");
													$sql = "SELECT * FROM cuentas WHERE codigo_cuenta LIKE '1%'";
													$ejecutar = $conexion->query($sql);
													while($acts = $ejecutar->fetch_assoc()){
														echo "<tr colspan='2'>";
														echo "<td >".$acts["codigo_cuenta"].". ".utf8_encode($acts["nombre_cuenta"])."</td>";
														echo "<td class='text-right'>".number_format($acts["saldo_debe"]-$acts["saldo_haber"],2)."</td>";
														echo "</tr>";
													}
													$consulta = "SELECT SUM((saldo_debe-saldo_haber)) total FROM cuentas WHERE codigo_cuenta LIKE '1%'";
													$ejecutar_consulta = $conexion->query($consulta);
													if($ejecutar_consulta->num_rows > 0){
														while ($regs = $ejecutar_consulta->fetch_assoc()) {
															echo "<tr>";
															echo "<td class='text-right'><strong>Total Activos:</strong></td>";
															echo "<td align='right'>".number_format($regs["total"],2)."</td>";
															echo "</tr>";
														}
													}
													?>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div>
										<div class="row">
											<div class="col-lg-12">

												<table class="table ">
													<tr>
														<th>Pasivos</th>
													</tr>	

													<?php
													if(!isset($conexion)){include("conexion.php");}
													$sql = "SELECT * FROM cuentas WHERE codigo_cuenta LIKE '2%'";
													$ejecutar = $conexion->query($sql);
													while($acts = $ejecutar->fetch_assoc()){
														echo "<tr>";
														echo "<td>".$acts["codigo_cuenta"].". ".utf8_encode($acts["nombre_cuenta"])."</td>";
														echo "</tr>";
													}
													$consulta = "SELECT SUM((saldo_debe-saldo_haber)) total FROM cuentas WHERE codigo_cuenta LIKE '2%'";
													$ejecutar_consulta = $conexion->query($consulta);
													if($ejecutar_consulta->num_rows > 0){
														while ($regs = $ejecutar_consulta->fetch_assoc()) {
															$total_pasivos = $regs["total"];
															echo "<tr>";
															echo "<td class='text-right'><strong>Total Pasivos:</strong></td>";
															echo "<td align='right'>".number_format($regs["total"],2)."</td>";
															echo "</tr>";
														}
													}
													?>
												</table>

											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<table class="table">
													<tr>
														<th>Capital</th>
													</tr>

													<?php
													if(!isset($conexion)){include("conexion.php");}
													$sql = "SELECT * FROM cuentas WHERE codigo_cuenta LIKE '3%'";
													$ejecutar = $conexion->query($sql);
													while($acts = $ejecutar->fetch_assoc()){
														echo "<tr>";
														echo "<td>".$acts["codigo_cuenta"].". ".utf8_encode($acts["nombre_cuenta"])."</td>";
														echo "</tr>";
													}
													$consulta = "SELECT SUM((saldo_debe-saldo_haber)) total FROM cuentas WHERE codigo_cuenta LIKE '3%'";
													$ejecutar_consulta = $conexion->query($consulta);
													if($ejecutar_consulta->num_rows > 0){
														while ($regs = $ejecutar_consulta->fetch_assoc()) {
															$total_capital = $regs["total"];
															echo "<tr>";
															echo "<td class='text-right'><strong>Total Capital:</strong></td>";
															echo "<td align='right'>".number_format($regs["total"],2)."</td>";
															echo "</tr>";
														}
													}
													?>
												</table>

											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<table class="table">
													<?php

															echo "<tr>";
															echo "<td class='text-right'><strong>Total Pasivos + Capital:</strong></td>";
															echo "<td align='right'>".number_format($total_pasivos+$total_capital,2)."</td>";
															echo "</tr>";
																										
													?>
												</table>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div><!--/span-->

			<!-- Barra lateral o sidebar -->
			<?php include("sidebar.php"); ?>
			
		</div>
	</div>

	<!-- Pie de página o Footer -->
	<?php include("footer.php"); ?>

	<!-- Ventanas flotantes -->
	<?php include("modal.php"); ?>

	<script src="../js/bootstrap.min.js"></script>
</body>
</html>