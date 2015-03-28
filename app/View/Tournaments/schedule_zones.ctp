<?php
	//Calculamos la cantidad de equipos por zona (cantidad de equipos dividido cantidad de zonas redondeado hacia arriba)
	$equiposPorZona = ceil(count($tournament['Team'])/count($tournament['Zone']));
	//Cantidad de equipos
	$cantidadDeZonas = count($tournament['Zone']);
	//Guardamos todos los equipos ya ubicados en zonas en un array para no mostrarlos en los equipos sin ubicar
	$equiposUbicados = [];
	foreach ($tournament['Zone'] as $zone) {
		foreach ($zone['Team'] as $team) {
			array_push($equiposUbicados, $team['id']);
		}
	}
?>

<div class="portlet light">
	<div class="portlet-body" id="schedule_zones">
		<div class="col-md-3 column">
			<div class="portlet box red-sunglo">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-shield"></i>Equipos sin Zona
					</div>
				</div>
				<div class="portlet-body">
					<div class="dd">
						<?php if (count($equiposUbicados) == count($tournament['Team'])): ?>
							<div class="dd-empty"></div>
						<?php else: ?>
							<ol class="dd-list">
								<?php foreach ($tournament['Team'] as $team): ?>
									<?php if (!in_array($team['id'], $equiposUbicados)): ?>
										<li class="dd-item" data-id="<?= $team['id']?>">
											<div class="dd-handle"><?= $team['name']?></div>
										</li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ol>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9 column">

			<?php foreach ($tournament['Zone'] as $zone): ?>

				<div class="col-md-4">
					<div class="portlet box green-haze">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-shield"></i>Zona <?= $zone['name']?>
							</div>
						</div>
						<div class="portlet-body" style="height:<?= ($equiposPorZona * 30 + ($equiposPorZona+1) * 5 + 10 + 8) ?>px;">
							<div class="dd" id="<?= $zone['id']?>">

								<?php if (count($zone['Team']) == 0): ?>
									<div class="dd-empty"></div>
								<?php else: ?>
									<ol class="dd-list">
										<?php foreach ($zone['Team'] as $team): ?>
											<li class="dd-item" data-id="<?= $team['id']?>">
												<div class="dd-handle"><?= $team['name']?></div>
											</li>
										<?php endforeach; ?>
									</ol>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

		<?php //Formulario oculto para poder setear el string JSON en el campo hidden y poder mandar por AJAX
		echo $this->Form->create('Tournament', array(
			'enctype' => 'multipart/form-data',
			'style' => 'display:none;',
			'id' => 'schedule-zones-form',
		));
		?>
		<?php
			echo $this->Form->hidden('json', array('id' => 'hidden-json'));
		?>
		<?= $this->Form->end(); ?>

		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<button type="button" onClick="sendScheduleZones();" id="send-shedule-zones" class="btn green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
				</div>
			</div>
		</div>

	</div>


</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/jquery-nestable/jquery.nestable');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-nestable/jquery.nestable');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('tournaments-schedule-zones.js');?>
	<script>
		jQuery(document).ready(function() {
			maxTeamsPerGroupArray = [];

			for (var i = 0; i < <?= $cantidadDeZonas ?>; i++) {
				maxTeamsPerGroupArray.push(<?= $equiposPorZona ?>);
			};

			TournamentScheduleZones.init();
		});
	</script>

	<script>
		function outputJsonZones(){
			zonesContainer = document.getElementById('schedule_zones');
			var saveString = "";
			saveString += '[';
			var lists = zonesContainer.getElementsByClassName('dd');
			for(var no=1;no<lists.length;no++){	// Looping through all <ul> except the one who contain all items
				saveString += '{"Zone":{"id":' + lists[no].id + '},"Team":{"Team":[';
				var elements = lists[no].getElementsByClassName('dd-item');
				for(var no2=0;no2<elements.length;no2++){
					saveString += elements[no2].dataset.id;
					if(no2<(elements.length-1)) saveString += ',';
				}
				saveString += ']}}';
				if(no<(lists.length-1)) saveString += ',';
			}
			saveString += ']';

			//console.log(saveString);
			return saveString;

		}

		function sendScheduleZones() {
			var button = $( '#send-shedule-zones' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = '<?= $this->Html->url(); ?>'+'.json';
			sheduleZonesJson = outputJsonZones();
			$('#hidden-json').val(sheduleZonesJson);

			var formData = $('#schedule-zones-form').serializeArray();

			$.ajax({
				type: 'put',
				cache: false,
				url: targeturl,
				data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					if (response.content) {
						//Show sweetalert
						swal({
							title: 'OK',
							text: response.content,
							type: "success",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
					if (response.error) {
						swal({
							title: 'ERROR',
							text: response.error,
							type: "error",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
				},
				error: function(e) {
					swal({
						title: 'ERROR',
						text: e.responseText.message,
						type: "error",
						confirmButtonText: "<?= __('Ok') ?>"
					});
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};
	</script>
<?php $this->end(); ?>