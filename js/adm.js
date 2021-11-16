
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
				
				dt.success.forEach(r => {
					if (r.status !== 'Sin atender') {
						r.options = '-';
						return;
					}

					r.options = `
						<i data-rid="${r.id}" data-status="Atendido"  class="material-icons btn-update">check_circle</i>
						<i data-rid="${r.id}" data-status="Cancelado" class="material-icons btn-remove">cancel</i>
					`
				});

				return dt.success;
			}
		},
		fnDrawCallback: () => {
			document.querySelectorAll('.btn-update').forEach(e => e.addEventListener('click', changeStatusAction));
			document.querySelectorAll('.btn-remove').forEach(e => e.addEventListener('click', changeStatusAction));
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
			{ data: 'status'    },
			{ data: 'options'   },
		],
		language: {
			"decimal":        "",
    		"emptyTable":     "No se encontraron datos en esta tabla",
    		"info":           "Mostrando _START_ a _END_ de _TOTAL_ entradas",
    		"infoEmpty":      "Mostrando 0 a 0 de 0 entradas",
    		"infoFiltered":   "(filtered from _MAX_ total entries)",
    		"infoPostFix":    "",
    		"thousands":      ",",
    		"lengthMenu":     "Mostrando _MENU_ entradas",
    		"loadingRecords": "Cargando...",
    		"processing":     "Procesando...",
    		"search":         "Buscar:",
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
		responsive: true,
	});
});

const reload = () =>
	$('#tickets').DataTable().ajax.reload();

const changeStatusAction = ev => {
	$.ajax({
		url: '../controllers/update_status_ticket.php',
		type: 'POST',
		async: true,
		data: {
			id:     ev.target.dataset.rid,
			status: ev.target.dataset.status,
		},
		success(res) {
			const r = JSON.parse(res);

			if (r.error) {
				alert('option update is not available');
				return;
			}

			reload();
		},
		error(xhr, status, error) {
			alert(error);
		}
	});
};