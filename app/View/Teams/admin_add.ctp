<div class="teams form">
<?php echo $this->Form->create('Team'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Team'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('captain');
		echo $this->Form->input('captain_email');
		echo $this->Form->input('tournament_id');
		echo $this->Form->input('has_shirts');
		echo $this->Form->input('colores');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?></li>
	</ul>
</div>
