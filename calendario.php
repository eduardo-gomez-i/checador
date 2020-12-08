<?php
$titulo_pagina = "Trabajador Horarios | Checador Universal";
include 'header.html';
include 'sidebar.php';

require_once('conex.php');

$sql = "SELECT id, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();


?>
<link href="css/sliden-button.css" rel="stylesheet">

<!-- FullCalendar -->
<link href='css/fullcalendar.css' rel='stylesheet' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------- FIN ESTILO BUSQUEDA -------------->
<!-- Main Content -->
<div id="content">

	<?php include 'topbar.php'; ?>

	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Horario Trabajador</h1>


		<!-- Lista de Trabajadores -->
		<div class="row alta_row">

			<div class="card shadow mb-4">
				<!-- Card Header - Accordion -->
				<a href="#LISTA" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
					<h6 class="m-0 font-weight-bold text-primary">Trabajador</h6>
				</a>
				<!-- Card Content - Collapse -->
				<div class="collapse show" id="LISTA">
					<div class="card-body">

						<!--Ejemplo tabla con DataTables-->
						<div class="container">
							<div id="calendar" class="col-centered">
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Lista de Trabajadores -->


		</div>
		<!--////////////////////////////////////// -->

	</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Titulo</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
						</div>
					</div>
					<div class="form-group">
						<label for="color" class="col-sm-2 control-label">Color</label>
						<div class="col-sm-10">
							<select name="color" class="form-control" id="color">
								<option value="">Seleccionar</option>
								<option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
								<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
								<option style="color:#008000;" value="#008000">&#9724; Verde</option>
								<option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
								<option style="color:#000;" value="#000">&#9724; Negro</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
						<div class="col-sm-10">
							<input type="text" name="start" class="form-control" id="start" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="end" class="col-sm-2 control-label">Fecha Final</label>
						<div class="col-sm-10">
							<input type="text" name="end" class="form-control" id="end" readonly>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Titulo</label>
						<div class="col-sm-10">
							<input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
						</div>
					</div>
					<div class="form-group">
						<label for="color" class="col-sm-2 control-label">Color</label>
						<div class="col-sm-10">
							<select name="color" class="form-control" id="color">
								<option value="">Seleccionar</option>
								<option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
								<option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
								<option style="color:#008000;" value="#008000">&#9724; Verde</option>
								<option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
								<option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
								<option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
								<option style="color:#000;" value="#000">&#9724; Negro</option>

							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<div class="checkbox">
								<label class="text-danger"><input type="checkbox" name="delete"> Eliminar Evento</label>
							</div>
						</div>
					</div>

					<input type="hidden" name="id" class="form-control" id="id">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php include 'footer.php'; ?>

<!-- FullCalendar -->
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar/fullcalendar.min.js'></script>
<script src='js/fullcalendar/fullcalendar.js'></script>
<script src='js/fullcalendar/locale/es.js'></script>

<script>
	$(document).ready(function() {

		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
		var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

		$('#calendar').fullCalendar({
			header: {
				language: 'es',
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay',

			},
			defaultDate: yyyy + "-" + mm + "-" + dd,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {

				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
				<?php foreach ($events as $event) :

					$start = explode(" ", $event['start']);
					$end = explode(" ", $event['end']);
					if ($start[1] == '00:00:00') {
						$start = $start[0];
					} else {
						$start = $event['start'];
					}
					if ($end[1] == '00:00:00') {
						$end = $end[0];
					} else {
						$end = $event['end'];
					}
				?> {
						id: '<?php echo $event['id']; ?>',
						title: '<?php echo $event['title']; ?>',
						start: '<?php echo $start; ?>',
						end: '<?php echo $end; ?>',
						color: '<?php echo $event['color']; ?>',
					},
				<?php endforeach; ?>
			]
		});

		function edit(event) {
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if (event.end) {
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			} else {
				end = start;
			}

			id = event.id;

			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;

			$.ajax({
				url: 'editEventDate.php',
				type: "POST",
				data: {
					Event: Event
				},
				success: function(rep) {
					if (rep == 'OK') {
						alert('Evento se ha guardado correctamente');
					} else {
						alert('No se pudo guardar. Inténtalo de nuevo.');
					}
				}
			});
		}

	});
</script>