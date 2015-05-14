<?php
	// debug($tournaments);
?>
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-trophy"></i>
			<span class="caption-subject bold uppercase">
				<?= __('Clasification') ?>
			</span>
		</div>
		<div class="actions">
		</div>
	</div>
	<div class="portlet-body" id="tournament-clasification">
		<div class="col-md-12 column">
			<?php foreach ($tournaments as $tournament): ?>
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							Zona <?= $tournament['Zone']['name']?>
						</div>
					</div>
					<div class="portlet-body">
						<div class="flex-table">
							<?php
								$teams = $positionTables[$tournament['Zone']['id']];
							?>
							<div class="flex-row flex-thead">
								<div class="flex-td small">P</div>
								<div class="flex-td"><?= __('Team') ?></div>
								<div class="flex-td"><?= __('Points') ?></div>
								<div class="flex-td"><?= __('Played Matches') ?></div>
								<div class="flex-td"><?= __('Won Matches') ?></div>
								<div class="flex-td"><?= __('Draw Matches') ?></div>
								<div class="flex-td"><?= __('Lost Matches') ?></div>
								<div class="flex-td"><?= __('GF') ?></div>
								<div class="flex-td"><?= __('GC') ?></div>
							</div>

							<?php $i=0;foreach($teams as &$team):?>
							<div class="team-data flex-row">
								<div class="flex-td small"><?=++$i?></div>
								<div class="flex-td"><?= $team['Team']['name'] ?></div>
								<div class="flex-td"><?= $team['Team']['totalPoints'] ?></div>
								<div class="flex-td"><?= $team['Team']['playedMatches'] ?></div>
								<div class="flex-td"><?= $team['Team']['wonMatches'] ?></div>
								<div class="flex-td"><?= $team['Team']['drawMatches'] ?></div>
								<div class="flex-td"><?= $team['Team']['lostMatches'] ?></div>
								<div class="flex-td"><?= $team['Team']['goalsFavor'] ?></div>
								<div class="flex-td"><?= $team['Team']['goalsAgainst'] ?></div>
							</div>
							<?php endforeach;?>
						</div>
					</div>
				</div>
			<?php endforeach;?>
		</div>
		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<!-- <button type="button" onClick="sendScheduleMatches();" id="send-shedule-matches" class="btn green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button> -->
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('tournament-clasification.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>