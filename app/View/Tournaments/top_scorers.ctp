<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-blue-hoki">
			<i class="icon-rocket font-blue-hoki"></i>
			<span class="caption-subject bold uppercase"> <?= __('Top Scorers') ?></span>
		</div>
		<div class="actions">
			<a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
		</div>

	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
				</div>
				<div class="col-md-6">
					<div class="btn-group pull-right">
						<button class="btn dropdown-toggle" data-toggle="dropdown"><?= __('Tools') ?> <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="#">
								<?= __('Print') ?> </a>
							</li>
							<li>
								<a href="#">
								<?= __('Save as PDF') ?> </a>
							</li>
							<li>
								<a href="#">
								<?= __('Export to Excel') ?> </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<table class="table table-striped table-bordered table-hover" id="topScorers_table">
			<thead>
				<th><?= __('Name') ?></th>
				<th><?= __('Team') ?></th>
				<th><?= __('Goals') ?></th>
				<th><?= __('Matches Played') ?></th>
				<th><?= __('Actions') ?></th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/datatables/media/js/jquery.dataTables.min');?>
	<?= $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('top-scorers-table');?>
	<script>
		var LocalVar = {};
		LocalVar.langFile = '<?= substr(Configure::read('Config.language'), 0, 2) ?>';
		LocalVar.dataTable = '';
		LocalVar.deleting = false;
		LocalVar.ajaxSource = ('<?= $this->Html->url(array('controller'=>'tournaments', 'action' => 'top_scorers', 'ext' => 'json', $tournamentId)) ?>');
		LocalVar.topScorerViewrUrl = ('<?= $this->Html->url(array('controller'=>'players', 'action' => 'view')) ?>');
		LocalVar.topScorerViewText = ('<?= __("Details") ?>');

		jQuery(document).ready(function() {
			TopScorersIndexTable.init();
		});

	</script>
<?php $this->end(); ?>