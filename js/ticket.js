import * as Checks from './modules/checks.js';
import * as Format from './modules/formatters.js';

window.addEventListener('load', () => {
	$('#tickets').DataTable({
		searching: false,
		paginate: false,
		ordering: false,
		ajax: {
			url: '../controllers/get_user_ticket.php',
			dataSrc: dt => {
				if (dt.error) {
					console.log(dt.error);
					return [];
				}

				if (!dt.success)
					return [];
				
				dt.success = [dt.success];
				
				dt.success.forEach(r =>
					r.options = `
						<i data-rid="${r.id}" class="material-icons btn-update">border_color</i>
						<i data-rid="${r.id}" class="material-icons btn-remove">do_not_disturb_alt</i>
						<i data-rid="${r.id}" class="material-icons btn-description">description</i>
					`);

				return dt.success;
			}
		},
		fnDrawCallback: () => {
			document.querySelectorAll('.btn-update')     .forEach(e => e.addEventListener('click', updateAction));
			document.querySelectorAll('.btn-remove')     .forEach(e => e.addEventListener('click', cancelAction));
			document.querySelectorAll('.btn-description').forEach(e => e.addEventListener('click', showAction));
		},
		columns: [
			{ data: 'tname'     },
			{ data: 'CURP'      },
			{ data: 'name'      },
			{ data: 'lpname'    },
			{ data: 'lmname'    },
			{ data: 'telephone' },
			{ data: 'celphone'  },
			{ data: 'mail'      },
			{ data: 'level'     },
			{ data: 'city'      },
			{ data: 'subject'   },
			{ data: 'status'   },
			{ data: 'options'   },
		],
		language: {
			"decimal":        "",
    		"emptyTable":     "Usted no cuenta con un turno.",
    		"info":           "",
    		"infoEmpty":      "",
    		"infoFiltered":   "",
    		"infoPostFix":    "",
    		"thousands":      ",",
    		"lengthMenu":     "",
    		"loadingRecords": "Cargando...",
    		"processing":     "Procesando...",
    		"zeroRecords":    "No se encontraron coincidencias",
    		"paginate": {
        		"first":      "Primero",
        		"last":       "Ultimo",
        		"next":       "Siguiente",
        		"previous":   "Anterior"
    		},
    		"aria": {
        		"sortAscending":  ": Activar para ordenar la columna de forma ascendente",
        		"sortDescending": ": Activar para ordenar la columna de forma descendente",
			},
		},
	});
 
	Format.to_name("#f-tname, #f-name, #f-flast-name, #f-slast-name");
	Format.to_phone("#f-tel, #f-cel");

	document.getElementById("data").addEventListener('submit', ev => {
		ev.preventDefault();
		
		let errs = "".concat(...[
			Checks.check("f-tname",      "Nombre del tramitador", Checks.is_blank),
			Checks.check("f-curp",       "CURP",                  Checks.is_blank, Checks.is_curp),
			Checks.check("f-name",       "Nombre(s)",             Checks.is_blank),
			Checks.check("f-flast-name", "Apellido paterno",      Checks.is_blank),
			Checks.check("f-slast-name", "Apellido materno",      Checks.is_blank),
			Checks.check("f-tel",        "Teléfono (con LADA)",   Checks.is_blank, Checks.is_phone),
			Checks.check("f-cel",        "Celular",               Checks.is_blank, Checks.is_phone),
			Checks.check("f-mail",       "Correo electrónico",    Checks.is_blank, Checks.is_email)
		]);

		if(errs) {
			alert(errs);
			return;
		}

		if(!confirmData('f-tname', 'f-curp', 'f-name', 'f-flast-name', 'f-slast-name', 'f-tel', 'f-cel', 'f-mail'))
			return;

		const id = document.getElementById('f-id').value;

		$.ajax({
			url: `../controllers/${(id) ? 'update' : 'add' }_ticket.php`,
			type: 'POST',
			async: true,
			data: {
				'f-id': id,
				'f-status': 'Sin Atender',
				...getData(),
			},
			success(res) {
				const r = JSON.parse(res);

				if (id) {
					reload();
					return;
				}

				document.getElementById('f-id').value = r.success.id;

				if (r.error)
					alert(r.error);

				const new_id = document.getElementById('f-id').value;
				const url    = `../controllers/get_pdf.php?f-id=${new_id}`
		
				window.open(url, "_blank");
				clearData();
			},
			error(xhr, status, error) {

				alert(error);
			}
		});
	});

	document.getElementById('btn-tfind').addEventListener('click', ev => {
		const tdata = document.getElementById('tb-tickets');

		if (tdata.classList.contains('hidden')) {
			tdata.classList.replace('hidden', 'show');
			ev.target.innerText = 'remove_circle';
			return;
		}

		tdata.classList.replace('show', 'hidden');
		ev.target.innerText = 'find_in_page';

		// clear all info
		document.getElementById('tbs-turn').value = '';
		document.getElementById('tbs-curp').value = '';

		$('#tickets').DataTable().ajax.url(`../controllers/get_user_ticket.php`).load();
		clearData();
	});

	document.getElementById('btn-tfinds').addEventListener('click', ev => {
		let errs = "".concat(...[
			Checks.check('tbs-turn', 'Turno', Checks.is_blank),
			Checks.check('tbs-curp', 'CURP',  Checks.is_blank, Checks.is_curp),
		]);

		if(errs) {
			alert(errs);
			return;
		}

		const id   = document.getElementById('tbs-turn').value;
		const curp = document.getElementById('tbs-curp').value;

		$('#tickets').DataTable().ajax.url(`../controllers/get_user_ticket.php?id=${id}&curp=${curp}`).load();
	});
});

const confirmData = (...ids) => {
	let data = '';
	
	ids.forEach(id => {
		let e = document.getElementById(id);

		data += `${e.previousElementSibling.textContent} ${e.value}\n`;
	});

	return confirm('¿Está seguro que desea enviar los siguientes datos?\n' + data);
}

const getData = () => {
	const obj = {};
	
	[
		'f-tname',
		'f-curp',
		'f-name',
		'f-flast-name',
		'f-slast-name',
		'f-tel',
		'f-cel',
		'f-mail',
	]
	.forEach(id =>
		obj[id] = document.getElementById(id).value);

	[
		'f-level',
		'f-city',
		'f-subj',
	]
	.forEach(name =>
		obj[name] = document.querySelector(`[name=${name}]`).value);
	
	return obj;
}

const clearData = () => {
	[
		'f-id',
		'f-tname',
		'f-curp',
		'f-name',
		'f-flast-name',
		'f-slast-name',
		'f-tel',
		'f-cel',
		'f-mail',
	]
	.forEach(id => document.getElementById(id).value = '');
};

const reload = () => {
	reloadTable();
	clearData();
};

const reloadTable = () => {
	$('#tickets').DataTable().ajax.reload();
};

const updateAction = ev => {
	$.ajax({
		url: '../controllers/get_tickets.php',
		type: 'GET',
		async: true,
		data: {
			id: ev.target.dataset.rid,
		},
		success(res) {
			const r = JSON.parse(res);

			if (r.error) {
				alert('option update is not available');
				return;
			}

			// fill data
			document.getElementById('f-id').value         = r.success.id;
			document.getElementById('f-tname').value      = r.success.tname;
			document.getElementById('f-curp').value       = r.success.CURP;
			document.getElementById('f-name').value       = r.success.name;
			document.getElementById('f-flast-name').value = r.success.lpname;
			document.getElementById('f-slast-name').value = r.success.lmname;
			document.getElementById('f-tel').value        = r.success.telephone;
			document.getElementById('f-cel').value        = r.success.celphone;
			document.getElementById('f-mail').value       = r.success.mail;

			document.querySelector('[name="f-level"]').value = r.success.level;
			document.querySelector('[name="f-city"]').value  = r.success.city;
			document.querySelector('[name="f-subj"]').value  = r.success.subject;
		},
		error(xhr, status, error) {
			alert(error);
		}
	});
};

const cancelAction = ev => {
	$.ajax({
		url: '../controllers/update_status_ticket.php',
		type: 'POST',
		async: true,
		data: {
			id: ev.target.dataset.rid,
			status: 'Cancelado',
		},
		success(res) {
			const r = JSON.parse(res);

			if (r.error)
				alert(r.error);

			reload();
		},
		error(xhr, status, error) {
			alert(error);
		}
	});
};

const showAction = ev => {
	window.open(`../controllers/get_pdf.php?f-id=${ev.target.dataset.rid}`, "_blank");
};