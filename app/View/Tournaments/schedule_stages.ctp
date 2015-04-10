<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Add')?></span>
			<span class="caption-helper"><?= __('Tournaments')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Tournament', array(
			'enctype' => 'multipart/form-data',
			'inputDefaults' => array(
				'format' => array('before','label','between','input','error','after'),
				'autocomplete' => 'off',
				'div' => array(
					'class' => 'form-group',
				),
				'label' => array(
					'class' => 'control-label col-md-3'
				),
				'class' => 'form-control',
				'between' => '<div class="col-md-9">',
				'after' => '</div>',
				'error' => array('attributes' => array(
					'class' => 'help-block',
					'wrap' => 'span',
					))
			),
			'class' => 'form-horizontal form-bordered',
			'id' => 'tournament-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name',array('readonly' => 'readonly', 'disabled' => 'disabled', 'label' => array('class' => 'control-label col-md-3', 'text' => __('Tournament Name'))));
					echo $this->Form->input('number_of_teams',array('type'=> 'number'));
					echo $this->Form->input('number_of_zones',array('type'=> 'select'));
					echo $this->Form->input('zone_home_and_away_matches',array('type'=> 'checkbox'));
					echo $this->Form->input('number_of_playoffs',array('disabled' => 'disabled','type'=> 'select','options' => array('Seleccionar...', 1, 2, 3, 4, 5)));
					//echo $this->Form->input('qualifying_teams_per_group',array('type'=> 'select'));
					echo $this->Form->input('actual_number_of_zones', array('type' => 'hidden'));
					echo $this->Form->input('actual_number_of_playoffs', array('type' => 'hidden'));
					echo $this->Form->input('playoffs_number_changed', array('type' => 'hidden'));
				?>

				<div class="form-group">
					<div class="col-md-12">
						<div class="playoff-portlet-container">
							<?php
								if(isset($this->request->data['Playoff'])){
									foreach($this->request->data['Playoff'] as $k=>$playoff):?>

									<div id="cup<?= $k ?>" class="portlet box red-soft">
										<div class="portlet-title">
											<div class="caption">
												<i class="fa fa-lg fa-trophy"></i><input name="data[Playoff][<?= $k ?>][name]" class="portlet-title-input form-playoff-name" type="text" placeholder="Nombre Torneo <?= $k ?>" value="<?= $playoff['name'] ?>">
											</div>
										</div>
										<div class="portlet-body form">

											<div class="playoffField">
												<div class="form-group">
													<label class="control-label col-md-6"><?= __('Equipos que clasifican') ?></label>
													<div class="col-md-6">
														<?php
															printf('<input type="hidden" name="data[Playoff][%u][id]" value="%u">',$k,$playoff['id']);
															printf('<select name="data[Playoff][%u][number_of_teams]" class="form-control form-playoff-number-of-teams">',$k);
															for($i=2;$i<$this->request->data['Tournament']['number_of_teams'];$i = $i*2){
																if($i != $playoff['number_of_teams']){
																	printf('<option value="%u">%u</option>',$i,$i);
																}else{
																	printf('<option selected="selected" value="%u">%u</option>',$i,$i);
																}
															}
															echo '</select>';
														?>
													</div>

												</div>
											</div>

											<div class="form-group">
												<label for="" class="control-label col-md-6">Home and away matches</label>
												<div class="col-md-6">
													<?php printf('<input name="data[Playoff][%u][home_and_away_matches]" value="0" type="hidden">',$k);?>
													<?php if(!$playoff['home_and_away_matches']){
														printf('<input name="data[Playoff][%u][home_and_away_matches]" type="checkbox">',$k);
													}else{
														printf('<input checked="checked" name="data[Playoff][%u][home_and_away_matches]" type="checkbox">',$k);
													}
													?>
												</div>
											</div>

										</div>
									</div>

									<?php endforeach;
								}
							?>
						</div>
					</div>
				</div>

			</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<?php
							echo $this->Form->Button(__('Cancel'),array(
								'div' => false,
								'class' => 'btn default',
								'type' => 'button'
							));
							echo $this->Form->Button(__('Save'),array(
								'div' => false,
								'class' => 'btn green',
								'type' => 'submit'
							));

						?>
					</div>
				</div>
			</div>
		<?= $this->Form->end(); ?>
		<!-- END FORM-->
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('tournaments-schedule-stages.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?= $this->Html->script('tournaments-schedule-stages.js');?>
	<script>
		Localvar = {}
		Localvar.playoffNumberChanged = false;
		jQuery(document).ready(function() {
			TournamentScheduleStages.init();
		});
	</script>
<?php $this->end(); ?>