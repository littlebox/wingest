<div class="rounds form">
<?php echo $this->Form->create('Round'); ?>
	<fieldset>
		<legend><?php echo __('Edit Round'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('tournament_id');
		echo $this->Form->input('name');
		echo $this->Form->input('start_date');
		echo $this->Form->input('end_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Round.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Round.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matches'), array('controller' => 'matches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
	</ul>
</div>
