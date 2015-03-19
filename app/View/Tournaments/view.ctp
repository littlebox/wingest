<div class="tournament-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i>
						<span class="caption-subject font-blue-madison bold uppercase">Torneo</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#tournament_data" data-toggle="tab">Datos del torneo</a>
						</li>
						<li>
							<a href="#tournament_groups" data-toggle="tab">Grupos del torneo</a>
						</li>
						<li>
							<a href="#tournament_playoffs" data-toggle="tab">Playoffs</a>
						</li>
						<li>
							<a href="#tournament_teams" data-toggle="tab">Equipos</a>
						</li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">

						<div class="tab-pane active" id="tournament_data">
							<dl>
								<dt><?php echo 'Nombre del equipo'; ?></dt>
								<dd>
									<?php echo h($tournament['Tournament']['name']); ?>
								</dd>
								<dt><?php echo 'Jugadores por equipo'; ?></dt>
								<dd>
									<?php echo h($tournament['Tournament']['players_per_team']); ?>
								</dd>
							</dl>
						</div>

						<div class="tab-pane" id="tournament_groups">
							<div class="table-scrollable">
								<?php if (!empty($tournament['Zone'])): ?>
									<table class="table table-striped table-bordered table-hover">
									<tr>
										<th><?php echo __('Nombre del grupo'); ?></th>
										<th><?php echo __('Created'); ?></th>
										<th><?php echo __('Modified'); ?></th>
										<th class="actions"><?php echo __('Actions'); ?></th>
									</tr>
									<?php foreach ($tournament['Zone'] as $zone): ?>
										<tr>
											<td><?php echo $zone['name']; ?></td>
											<td><?php echo $zone['created']; ?></td>
											<td><?php echo $zone['modified']; ?></td>
											<td class="actions">
												<?php echo $this->Html->link(__('Ver'), array('controller' => 'zones', 'action' => 'view', $zone['id'])); ?>
												<?php echo $this->Html->link(__('Editar'), array('controller' => 'zones', 'action' => 'edit', $zone['id'])); ?>
												<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'zones', 'action' => 'delete', $zone['id']), array(), __('Are you sure you want to delete # %s?', $zone['id'])); ?>
											</td>
										</tr>
									<?php endforeach; ?>
									</table>
								<?php else:?>
									Este torneo no tiene grupos asociados
								<?php endif; ?>
							</div>
						</div>

						<div class="tab-pane" id="tournament_playoffs">
							<div class="table-scrollable">
									<?php if (!empty($tournament['Playoff'])): ?>
									<table class="table table-striped table-bordered table-hover">
									<tr>
										<th><?php echo __('Name'); ?></th>
										<th><?php echo __('Created'); ?></th>
										<th><?php echo __('Modified'); ?></th>
										<th class="actions"><?php echo __('Actions'); ?></th>
									</tr>
									<?php foreach ($tournament['Playoff'] as $playoff): ?>
										<tr>
											<td><?php echo $playoff['name']; ?></td>
											<td><?php echo $playoff['created']; ?></td>
											<td><?php echo $playoff['modified']; ?></td>
											<td class="actions">
												<?php echo $this->Html->link(__('Ver'), array('controller' => 'playoffs', 'action' => 'view', $playoff['id'])); ?>
												<?php echo $this->Html->link(__('Editar'), array('controller' => 'playoffs', 'action' => 'edit', $playoff['id'])); ?>
												<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'playoffs', 'action' => 'delete', $playoff['id']), array(), __('Are you sure you want to delete # %s?', $playoff['id'])); ?>
											</td>
										</tr>
									<?php endforeach; ?>
									</table>
								<?php else:?>
									Este torneo no tiene playoffs asociados
								<?php endif; ?>
							</div>
						</div>

						<div class="tab-pane" id="tournament_teams">
							<div class="table-scrollable">
								<?php if (!empty($tournament['Team'])): ?>
								<table class="table table-striped table-bordered table-hover">
								<tr>
									<th><?php echo __('Name'); ?></th>
									<th><?php echo __('Captain'); ?></th>
									<th><?php echo __('Captain2'); ?></th>
									<th><?php echo __('Captain Email'); ?></th>
									<th><?php echo __('Captain2 Email'); ?></th>
									<th><?php echo __('Captain Phone'); ?></th>
									<th><?php echo __('Captain2 Phone'); ?></th>
									<th><?php echo __('Captain Facebook'); ?></th>
									<th><?php echo __('Captain2 Facebook'); ?></th>
									<th><?php echo __('Tournament Id'); ?></th>
									<th><?php echo __('Has Shirts'); ?></th>
									<th><?php echo __('Password'); ?></th>
									<th><?php echo __('Main Shirt Color'); ?></th>
									<th><?php echo __('Secondary Shirt Color'); ?></th>
									<th><?php echo __('Created'); ?></th>
									<th><?php echo __('Modified'); ?></th>
									<th class="actions"><?php echo __('Actions'); ?></th>
								</tr>
								<?php foreach ($tournament['Team'] as $team): ?>
									<tr>
										<td><?php echo $team['name']; ?></td>
										<td><?php echo $team['captain']; ?></td>
										<td><?php echo $team['captain2']; ?></td>
										<td><?php echo $team['captain_email']; ?></td>
										<td><?php echo $team['captain2_email']; ?></td>
										<td><?php echo $team['captain_phone']; ?></td>
										<td><?php echo $team['captain2_phone']; ?></td>
										<td><?php echo $team['captain_facebook']; ?></td>
										<td><?php echo $team['captain2_facebook']; ?></td>
										<td><?php echo $team['tournament_id']; ?></td>
										<td><?php echo $team['has_shirts']; ?></td>
										<td><?php echo $team['password']; ?></td>
										<td><?php echo $team['main_shirt_color']; ?></td>
										<td><?php echo $team['secondary_shirt_color']; ?></td>
										<td><?php echo $team['created']; ?></td>
										<td><?php echo $team['modified']; ?></td>
										<td class="actions">
											<?php echo $this->Html->link(__('Ver'), array('controller' => 'teams', 'action' => 'view', $team['id'])); ?>
											<?php echo $this->Html->link(__('Editar'), array('controller' => 'teams', 'action' => 'edit', $team['id'])); ?>
											<?php echo $this->Form->postLink(__('Borrar'), array('controller' => 'teams', 'action' => 'delete', $team['id']), array(), __('Are you sure you want to delete # %s?', $team['id'])); ?>
										</td>
									</tr>
								<?php endforeach; ?>
								</table>
								<?php else:?>
									No hay equipos en este torneo
								<?php endif; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END PROFILE CONTENT -->

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('profile');?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('image-crop.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/jquery.sparkline.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('users-view');?>
	<?= $this->Html->script('global-setups');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>

<?php $this->end(); ?>

<!-- Enlaces a acciones que deberiamos agregar para que quede mas funcional, pero ahora tengo sueño
<div class="tournaments view">
<h2><?php echo __('Tournament'); ?></h2>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tournament'), array('action' => 'edit', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tournament'), array('action' => 'delete', $tournament['Tournament']['id']), array(), __('Are you sure you want to delete # %s?', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Playoffs'), array('controller' => 'playoffs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Playoff'), array('controller' => 'playoffs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Zones'), array('controller' => 'zones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Zone'), array('controller' => 'zones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Playoffs'); ?></h3>


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Playoff'), array('controller' => 'playoffs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Teams'); ?></h3>


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Zones'); ?></h3>


	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Zone'), array('controller' => 'zones', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
-->