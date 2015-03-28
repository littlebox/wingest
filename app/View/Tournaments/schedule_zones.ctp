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
					<div class="dd sortable-list">
						<ol class="dd-list">
							<?php foreach ($tournament['Team'] as $team): ?>
								<?php if (!in_array($team['id'], $equiposUbicados)): ?>
									<li draggable="true" class="dd-item" id="<?= $team['id']?>"><div class="dd-handle"><?= $team['name']?></div></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9 column" style="display:flex; flex-wrap:wrap;">

			<?php foreach ($tournament['Zone'] as $zone): ?>

				<div  style="flex:1 0 200px; margin:0 1em 1em 0">
					<div class="portlet box green-haze">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-shield"></i><?= $zone['name']?>
							</div>
						</div>
						<div class="portlet-body">
							<div class="dd sortable-list">
								<ol class="dd-list" id="<?= $zone['id']?>">
									<?php if(!empty($zone['Team'])):
										foreach ($zone['Team'] as $team): ?>
											<li class="dd-item" data-id="<?= $team['id']?>">
												<div class="dd-handle"><?= $team['name']?></div>
											</li>
										<?php endforeach;
									else:?>
										<div class="dd-empty"></div>
									<?php endif;?>
								</ol>
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
					<button type="button" onClick="sendScheduleZones();" id="send-shedule-zones" class="btn green ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
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
		function sendScheduleZones() {
			var button = $( '#send-shedule-zones' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = '<?= $this->Html->url(); ?>'+'.json';
			sheduleZonesJson = saveDragDropNodes();
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