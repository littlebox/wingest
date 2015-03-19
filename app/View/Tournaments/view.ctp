<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Add')?></span>
			<span class="caption-helper"><?= __('Users')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('User', array(
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
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('full_name');
					echo $this->Form->input('email');
					echo $this->Form->input('password');
					echo $this->Form->input('password_confirm', array('type' => 'password'));
					echo $this->Form->input('group_id');
				?>

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
							));
							echo $this->Form->end();
						?>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/select2/select2');?>
	<?= $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');?>
	<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput');?>
	<?= $this->Html->css('/plugins/jcrop/css/jquery.Jcrop.min');?>
	<?= $this->Html->css('image-crop.css');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/select2/select2.min');?>
	<?= $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.Jcrop.min.js');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<!-- <?= $this->Html->script('users-add.js');?> -->
<?php $this->end(); ?>

<div class="tournaments view">
<h2><?php echo __('Tournament'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
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
	<?php if (!empty($tournament['Playoff'])): ?>
	<table class="table-scrollable" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tournament['Playoff'] as $playoff): ?>
		<tr>
			<td><?php echo $playoff['id']; ?></td>
			<td><?php echo $playoff['tournament_id']; ?></td>
			<td><?php echo $playoff['name']; ?></td>
			<td><?php echo $playoff['created']; ?></td>
			<td><?php echo $playoff['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'playoffs', 'action' => 'view', $playoff['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'playoffs', 'action' => 'edit', $playoff['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'playoffs', 'action' => 'delete', $playoff['id']), array(), __('Are you sure you want to delete # %s?', $playoff['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Playoff'), array('controller' => 'playoffs', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Teams'); ?></h3>
	<?php if (!empty($tournament['Team'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
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
			<td><?php echo $team['id']; ?></td>
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
				<?php echo $this->Html->link(__('View'), array('controller' => 'teams', 'action' => 'view', $team['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'teams', 'action' => 'edit', $team['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'teams', 'action' => 'delete', $team['id']), array(), __('Are you sure you want to delete # %s?', $team['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Zones'); ?></h3>
	<?php if (!empty($tournament['Zone'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tournament['Zone'] as $zone): ?>
		<tr>
			<td><?php echo $zone['id']; ?></td>
			<td><?php echo $zone['name']; ?></td>
			<td><?php echo $zone['tournament_id']; ?></td>
			<td><?php echo $zone['created']; ?></td>
			<td><?php echo $zone['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'zones', 'action' => 'view', $zone['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'zones', 'action' => 'edit', $zone['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'zones', 'action' => 'delete', $zone['id']), array(), __('Are you sure you want to delete # %s?', $zone['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Zone'), array('controller' => 'zones', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
