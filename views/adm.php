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
<body class="p-3 mb-2 bg-secondary bg-gradient">

	<div class="title_views">
		<h1>Vista de administrador</h1>
	</div>

	<div class="container-fluid text-center text-dark">
		<h4> En esta pantalla puedes editar el estatus de los tickets, no es posible borrarlos para mantener un buen historial. </h4>
	</div>

	<!-- Tickets -->
	<div class="tb-tickets p-3 mb-2 bg-info bg-gradient text-black">
		<table id="tickets" class="cell-border compact stripe display">
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