<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-blue-hoki">
			<i class="icon-share font-blue-hoki"></i>
			<span class="caption-subject bold uppercase"> <?= __('List') ?></span>
			<span class="caption-helper"><?= __('Teams') ?></span>
		</div>
		<div class="actions">
			<a href="#" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="" title=""></a>
		</div>

	</div>
	<div class="portlet-body">
		<div class="table-toolbar">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group">
						<?= $this->Html->link('<i class="fa fa-plus"></i> '.__('Add New'), array('action' => 'add'), array('class' => 'btn green-haze', 'escape' => false)); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="btn-group pull-right">
						<button disabled="disabled" class="btn dropdown-toggle" data-toggle="dropdown"><?= __('Tools') ?> <i class="fa fa-angle-down"></i>
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
		<table class="table table-striped table-bordered table-hover" id="teams_table">
			<thead>
				<th><?= __('') ?></th>
				<th><?= __('Nombre') ?></th>
				<th><?= __('Torneo') ?></th>
				<th><?= __('Primer Delegado') ?></th>
				<th><?= __('Segundo delegado') ?></th>
				<th><?= __('Email primer delegado') ?></th>
				<th><?= __('Email segundo delegado') ?></th>
				<th><?= __('Telefono primer delegado') ?></th>
				<th><?= __('Telefono segundo delegado') ?></th>
				<th><?= __('Facebook primer delegado') ?></th>
				<th><?= __('Facebook segundo delegado') ?></th>
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
	<?= $this->Html->script('teams-index-table');?>
	<script>
		var LocalVar = {};
		LocalVar.langFile = '<?= substr(Configure::read('Config.language'), 0, 2) ?>';
		LocalVar.dataTable = '';
		LocalVar.deleting = false;
		LocalVar.ajaxSource = ('<?= $this->Html->url(array('controller'=>'teams', 'action' => 'index', 'ext' => 'json')) ?>');
		LocalVar.teamEditUrl = ('<?= $this->Html->url(array('controller'=>'teams', 'action' => 'edit')) ?>');
		LocalVar.teamDeleterUrl = ('<?= $this->Html->url(array('controller'=>'teams', 'action' => 'delete')) ?>');
		LocalVar.teamViewUrl = ('<?= $this->Html->url(array('controller'=>'teams', 'action' => 'view')) ?>');
		LocalVar.teamEditText = ('<?= __("Edit") ?>');
		LocalVar.teamDeleteText = ('<?= __("Delete") ?>');
		LocalVar.teamViewText = ('<?= __("Details") ?>');
		LocalVar.teamViewPlayersUrl = ('<?= $this->Html->url(array('controller'=>'players', 'action' => 'index')) ?>');
		LocalVar.teamViewPlayersText = ('<?= __("Ver Jugadores") ?>');

		jQuery(document).ready(function() {
			TeamsIndexTable.init();
		});

		function confirmAlert(url){
			swal(
				{
					title: "<?= __('Are you sure?') ?>",
					text: "<?= __('You will not be able to recover this imaginary file!') ?>",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "<?= __('Yes, delete it!') ?>",
					closeOnConfirm: false
				},
				function(){
					if(!LocalVar.deleting){
						LocalVar.deleting = true;
						$.ajax({
							type: 'post',
							cache: false,
							url: url+'.json',
							beforeSend: function(xhr) {
								xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
								xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
							},
							success: function(response) {
								if (response.content) {
									swal({
										title: "<?= __('Deleted!') ?>",
										text: response.content,
										type: "success",
									},
									function(){
										LocalVar.dataTable.fnDraw();
									})
								}
								if (response.error) {
									swal("<?= __('Error') ?>", response.error, "error");
								}
							},
							error: function(e) {
								swal("<?= __('Error') ?>", "<?= __('User hasn\'t been deleted.') ?>", "error");
							},
							complete: function() {
								LocalVar.deleting = false;
							}
						});
					}



				});
		}

	</script>
<?php $this->end(); ?>