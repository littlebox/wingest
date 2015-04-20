<?php
	// debug($rounds);die();
?>
<div class="col-md-12 column">
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-calendar"></i>
				<span class="caption-subject bold uppercase">
					<?= __('Schedule Rounds') ?>
				</span>
			</div>
			<div class="actions">
				<button type="button" onClick="sendScheduleRounds();" id="send-schedule-rounds" class="btn btn-circle green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
			</div>
		</div>
		<form id="schedule-rounds-form">
		<div class="portlet-body" id="schedule_rounds">
			<div class="portlet box yellow">
				<div class="portlet-title">
					<div class="caption">
						<?= __('Fechas de grupo');?>
					</div>
				</div>
				<div class="portlet-body">
					<div class="flex-table">
						<?php $i=0; foreach($rounds['not_playoff'] as $round): if($i == 0):?>
						<div class="flex-row flex-thead">
							<div class="flex-td small"></div>
							<div class="flex-td"><?= __('Round') ?></div>
							<div class="flex-td"><?= __('Start Date') ?></div>
							<div class="flex-td"><?= __('End Date') ?></div>
						</div>
						<?php endif;?>
							<div class="round-data flex-row" id="<?= $round['RoundZone']['id'];?>">
								<div class="flex-td small"><?= $i+1?></div>
								<div class="flex-td center"><?= $round['RoundZone']['name'];?></div>
								<div class="flex-td center"><?php
									if(isset($round['RoundZone']['start_date']) && $round['RoundZone']['start_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['RoundZone']['start_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input name="data[<?= $round['RoundZone']['id']?>][Round][start_date]" class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>
								<div class="flex-td center"><?php
									if(isset($round['RoundZone']['end_date']) && $round['RoundZone']['end_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['RoundZone']['end_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input name="data[<?= $round['RoundZone']['id']?>][Round][end_date]" class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>
								<input type="hidden" name="data[<?= $round['RoundZone']['id']?>][Round][id]" value="<?= $round['RoundZone']['id']?>">
							</div>
						<?php $i++;endforeach;?>

					</div>
				</div>
			</div>

			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						<?= __('Fechas de playoffs');?>
					</div>
				</div>
				<div class="portlet-body">
					<div class="flex-table">
						<?php $i=0; foreach($rounds['playoff'] as $round): if($i == 0):?>
						<div class="flex-row flex-thead">
							<div class="flex-td small"></div>
							<div class="flex-td"><?= __('Round') ?></div>
							<div class="flex-td"><?= __('Start Date') ?></div>
							<div class="flex-td"><?= __('End Date') ?></div>
						</div>
						<?php endif;?>
							<div class="round-data flex-row" id="<?= $round['RoundPlayoff']['id'];?>">
								<div class="flex-td small"><?= $i+1?></div>
								<div class="flex-td center"><?= $round['RoundPlayoff']['name'];?></div>
								<div class="flex-td center"><?php
									if(isset($round['RoundPlayoff']['start_date']) && $round['RoundPlayoff']['start_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['RoundPlayoff']['start_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input name="data[<?= $round['RoundPlayoff']['id']?>][Round][start_date]" class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>
								<div class="flex-td center"><?php
									if(isset($round['RoundPlayoff']['end_date']) && $round['RoundPlayoff']['end_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['RoundPlayoff']['end_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input name="data[<?= $round['RoundPlayoff']['id']?>][Round][end_date]" class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>
								<input type="hidden" name="data[<?= $round['RoundPlayoff']['id']?>][Round][id]" value="<?= $round['RoundPlayoff']['id']?>">
							</div>
						<?php $i++;endforeach;?>

					</div>
				</div>
			</div>
		</div>
		</form>
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('schedule-rounds.css');?>
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
	<?= $this->Html->script('tournaments-schedule-rounds.js');?>
	<script>
		jQuery(document).ready(function() {
			TournamentScheduleRounds.init();
		});

		function sendScheduleRounds() {
			var button = $( '#send-schedule-rounds' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = '<?= $this->Html->url(); ?>'+'.json';

			var formData = $('#schedule-rounds-form').serializeArray();

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