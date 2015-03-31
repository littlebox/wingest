<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-futbol-o font-purple-plum"></i>
			<span class="caption-subject bold font-purple-plum uppercase">
				<?= __('Schedule Matches') ?>
			</span>
		</div>
		<div class="actions">
			<button type="button" onClick="sendScheduleZones();" id="send-shedule-zones" class="btn btn-circle green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
		</div>
	</div>
	<div class="portlet-body" id="schedule_zones">
		<div class="col-md-12 column">
			<?php foreach ($tournament['Zone'] as $zone): ?>
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							Zona <?= $zone['name'];?>
						</div>
					</div>
					<div class="portlet-body">
						<div style="display:flex;">
						<?php foreach ($zone['Match'] as $match): ?>
							<div class="col-md-3 column">
								<div class="portlet box green-haze">
									<div class="portlet-title">
										<div class="caption">
											<?= $match['TeamLocal']['name'];?> Vs. <?= $match['TeamVisitor']['name'];?>
										</div>
									</div>
									<div class="portlet-body">
										<form action="#" class="form-horizontal form-bordered form-row-stripped">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3"><?= __('Date') ?></label>
													<div class="col-md-9">
														<?php
															$dbDateTime = DateTime::createFromFormat('Y-m-d', $match['date']);
															$espDateString = $dbDateTime->format('d/m/Y');
														?>
														<input class="form-control date-picker" size="16" type="text" value="<?= $espDateString;?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3"><?= __('Time') ?></label>
													<div class="col-md-9">
														<input type="text" class="form-control timepicker timepicker-24" value="<?= $match['time'];?>">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3"><?= __('Field') ?></label>
													<div class="col-md-9">
														<input type="text" placeholder="Ej: Cancha 4" class="form-control" value="<?= $match['field'];?>">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php foreach ($tournament['Playoff'] as $playoff): ?>
				<div class="portlet box red-sunglo">
					<div class="portlet-title">
						<div class="caption">
							Zona <?= $playoff['name'];?>
						</div>
					</div>
					<div class="portlet-body">
						<div style="display:flex;">
						<?php foreach ($playoff['Match'] as $match): ?>
							<div class="col-md-3 column">
								<div class="portlet box green-haze">
									<div class="portlet-title">
										<div class="caption">
											<?= $match['TeamLocal']['name'];?> Vs. <?= $match['TeamVisitor']['name'];?>
										</div>
									</div>
									<div class="portlet-body">
										<form action="#" class="form-horizontal form-bordered form-row-stripped">
											<div class="form-body">
												<div class="form-group">
													<label class="control-label col-md-3"><?= __('Date') ?></label>
													<div class="col-md-9">
														<?php
															$dbDateTime = DateTime::createFromFormat('Y-m-d', $match['date']);
															$espDateString = $dbDateTime->format('d/m/Y');
														?>
														<input class="form-control date-picker" size="16" type="text" value="<?= $match['date'];?>">
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3"><?= __('Time') ?></label>
													<div class="col-md-9">
														<input type="text" class="form-control timepicker timepicker-24" value="<?= $match['time'];?>">
													</div>
												</div>
												<div class="form-group last">
													<label class="control-label col-md-3"><?= __('Field') ?></label>
													<div class="col-md-9">
														<input type="text" placeholder="Ej: Cancha 4" class="form-control" value="<?= $match['field'];?>">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
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
					<!-- <button type="button" onClick="sendScheduleZones();" id="send-shedule-zones" class="btn green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button> -->
				</div>
			</div>
		</div>

	</div>


</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/jquery-nestable/jquery.nestable');?>
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>

<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/bootstrap-daterangepicker/moment.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>


<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('tournaments-schedule-matches.js');?>
	<script>
		jQuery(document).ready(function() {
			TournamentScheduleMatches.init();
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




