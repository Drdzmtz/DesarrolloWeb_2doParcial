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
	<link rel="stylesheet" href="../css/estilos.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
	
	<script type="module" src="../js/adm.js" defer></script>
</head>
<body>

	<div class="title_views">
		<h1> Ticket de Turno</h1>
	</div>

	<!-- Tickets -->
	<div class="tb-tickets">
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
					<th>Estatus</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</body>
</html>