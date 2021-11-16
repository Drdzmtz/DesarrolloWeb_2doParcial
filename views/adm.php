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
	<link rel="stylesheet" href="../css/adm.css">

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
	
	<script type="module" src="../js/adm.js" defer></script>
</head>
<body class="p-3 mb-2 bg-secondary bg-gradient">

	<div class="title_views">
		<h1>Turnos</h1>
	</div>

	<div class="container-fluid text-center text-dark">
		<h6> En esta pantalla puedes editar el estatus de los tickets, no es posible borrarlos para mantener un buen historial. </h6>
	</div>

	<!-- Tickets -->
	<div class="tb-tickets p-3 mb-2 text-black">
		<div class="tb-filters">
			<label>Filtros rápidos</label>
			<i id="ftr-all"                           class="btn-tb material-icons selected">format_list_bulleted</i>
			<i id="ftr-sa"  data-status="Sin atender" class="btn-tb material-icons">next_week</i>
			<i id="ftr-at"  data-status="Atendido"    class="btn-tb material-icons">done_all</i>
			<i id="ftr-cc"  data-status="Cancelado"   class="btn-tb material-icons">do_not_disturb_alt</i>
		</div>

		<table id="tickets" class="cell-border compact stripe display">
			<thead>
				<tr>
					<th>Turno</th>
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