<?php
	// debug($rounds);die();
?>

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
	<div class="portlet-body" id="schedule_rounds">
		<div class="col-md-12 column">
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
							<div class="round-data flex-row" id="<?= $round['Round']['id'];?>">
								<div class="flex-td small"><?= $i?></div>
								<div class="flex-td center"><?= $round['Round']['name'];?></div>
								<div class="flex-td center"><?php
									if(isset($round['Round']['start_date']) && $round['Round']['start_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['Round']['start_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>
								<div class="flex-td center"><?php
									if(isset($round['Round']['end_date']) && $round['Round']['end_date'] != '0000-00-00'){
										$dbDateTime = DateTime::createFromFormat('Y-m-d', $round['Round']['end_date']);
										$espDateString = $dbDateTime->format('d/m/Y');
									}else{
										$espDateString = '';
									}
								?>
									<input class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
								</div>

							</div>
						<?php $i++;endforeach;?>

					</div>
				</div>
			</div>
		</div>
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