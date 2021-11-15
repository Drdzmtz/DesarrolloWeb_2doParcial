import * as Checks from './modules/checks.js';
import * as Format from './modules/formatters.js';

window.addEventListener('load', () => {
	$('#tickets').DataTable({
		searching: true,
		ajax: {
			url: '../controllers/get_tickets.php',
			dataSrc: dt => {
				if (dt.error) {
					console.log(dt.error);
					return [];
				}
				
				dt.success.forEach(r =>
					r.options = `
						<i data-rid="${r.id}" class="material-icons btn-update">border_color</i>
						<i data-rid="${r.id}" class="material-icons btn-remove">delete</i>
					`);

				return dt.success;
			}
		},
		fnDrawCallback: () => {
			document.querySelectorAll('.btn-update').forEach(e => e.addEventListener('click', updateAction));
			document.querySelectorAll('.btn-remove').forEach(e => e.addEventListener('click', removeAction));
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
			{ data: 'options'   },
		]
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

		if(!confirm_data('f-tname', 'f-curp', 'f-name', 'f-flast-name', 'f-slast-name', 'f-tel', 'f-cel', 'f-mail'))
			return;

		const id = document.getElementById('f-id').value;

		$.ajax({
			url: `../controllers/${(id) ? 'update' : 'add' }_ticket.php`,
			type: 'POST',
			async: true,
			data: {
				'f-id': id,
				...get_data()
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
	});

	document.getElementById('btn-add').addEventListener('click', ev => {
		const edata = document.getElementById('data');

		if (edata.className === 'hidden') {
			edata.className = 'show';
			ev.target.innerText = 'remove_circle';
			return;
		}

		edata.className = 'hidden';
		ev.target.innerText = 'add_circle';

		clearData();
	});
});

const confirm_data = (...ids) => {
	let data = '';
	
	ids.forEach(id => {
		let e = document.getElementById(id);

		data += `${e.previousElementSibling.textContent} ${e.value}\n`;
	});

	return confirm('¿Está seguro que desea enviar los siguientes datos?\n' + data);
}

const get_data = () => {
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
	$('#tickets').DataTable().ajax.reload();

	// close panel info
	const dataPanel = document.getElementById('data');
	if (dataPanel.className === 'show')
		document.getElementById('btn-add').click();

	// clear values
	clearData();
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

			// open panel info
			if (document.getElementById('data').className === 'hidden')
				document.getElementById('btn-add').click();
			else
				clearData();

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

const removeAction = ev => {
	$.ajax({
		url: '../controllers/del_ticket.php',
		type: 'POST',
		async: true,
		data: {
			id: ev.target.dataset.rid,
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