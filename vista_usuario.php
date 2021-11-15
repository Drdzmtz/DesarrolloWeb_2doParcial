<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tickets</title>

	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
	<link rel="stylesheet" href="css/estilos.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
	
	<script type="module" src="js/index.js" defer></script>
</head>
<body>

	<div class="title_views">
		<h1> Ticket de Turno</h1>
	</div>

	<?php include_once("./views/navbar.php"); ?>


	<!-- Formulario -->
	<form id="data" method="post" class="hidden">
		<div class="f-group">
			<label for="f-tname" class="rojo">Nombre completo de quien realizará el trámite:</label>
			<input type="text" id="f-tname" name="f-tname" autofocus>
		</div>

		<div class="f-group">
			<label for="f-curp">CURP:</label>
			<input type="text" id="f-curp" name="f-curp" maxlength="18">
		</div>

		<div class="f-group f-group-3">
			<label for="f-name">Nombre:</label>
			<input type="text" id="f-name" name="f-name">
		</div>

		<div class="f-group f-group-3">
			<label for="f-flast-name">Paterno:</label>
			<input type="text" id="f-flast-name" name="f-flast-name">
		</div>

		<div class="f-group f-group-3">
			<label for="f-slast-name">Materno:</label>
			<input type="text" id="f-slast-name" name="f-slast-name">
		</div>

		<div class="f-group f-group-3">
			<label for="f-tel">Teléfono:</label>
			<input type="text" id="f-tel" name="f-tel" maxlength="10" placeholder="Colocar teléfono de casa con LADA">
		</div>

		<div class="f-group f-group-3">
			<label for="f-cel">Celular:</label>
			<input type="text" id="f-cel" name="f-cel" maxlength="10" placeholder="Colocar teléfono movil">
		</div>

		<div class="f-group f-group-3">
			<label for="f-mail">Correo:</label>
			<input type="text" id="f-mail" name="f-mail">
		</div>

		<div class="f-group">
			<label for="f-level">¿Nivel al que desea ingresar o que ya cursa el alumno?</label>
			<select name="f-level">
				<option value="Secundaria">Secundaria</option>
				<option value="Bachillerato">Bachillerato</option>
				<option value="Licenciatura">Licenciatura</option>
			</select>
		</div>
		
		<div class="f-group">
			<label for="f-city">Municipio donde desea estudie el alumno:</label>
			<select name="f-city">
				<option value="Saltillo">Saltillo</option>
				<option value="Ramos Arizpe">Ramos Arizpe</option>
				<option value="Arteaga">Arteaga</option>
			</select>
		</div>
		
		<div class="f-group">
			<label for="f-subj">Seleccione el asunto que va a tratar</label>
			<select name="f-subj">
				<option value="Tutorias">Tutorías</option>
				<option value="Comprobante de estudios">Comprobante de estudios</option>
				<option value="Quejas">Quejas</option>
				<option value="-">Otro</option>
			</select>
		</div>

		<button class="btn btn-ss" type="submit">Generar Turno</button>

		<div class="img-group">
			<img src="images/cbarras.png" alt="Código de barras">
			<img src="images/cqr.png" alt="Código QR">
		</div>

		<input type="hidden" id="f-id" value="">
	</form>

	<!-- Tickets -->
	<div class="tb-tickets">
		<i id="btn-add" class="material-icons">add_circle</i>

		<table id="tickets">
			<thead>
				<tr>
					<th>Tramitante</th>
					<th>CURP</th>
					<th>Nombre</th>
					<th>A. Paterno</th>
					<th>A. Materno</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>Correo</th>
					<th>Nivel</th>
					<th>Ciudad</th>
					<th>Asunto</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</body>
</html>