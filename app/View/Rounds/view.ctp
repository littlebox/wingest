<div class="rounds view">
<h2><?php echo __('Round'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($round['Round']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tournament'); ?></dt>
		<dd>
			<?php echo $this->Html->link($round['Tournament']['name'], array('controller' => 'tournaments', 'action' => 'view', $round['Tournament']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($round['Round']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Date'); ?></dt>
		<dd>
			<?php echo h($round['Round']['start_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Date'); ?></dt>
		<dd>
			<?php echo h($round['Round']['end_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Round'), array('action' => 'edit', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Round'), array('action' => 'delete', $round['Round']['id']), array(), __('Are you sure you want to delete # %s?', $round['Round']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rounds'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Round'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('controller' => 'tournaments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('controller' => 'tournaments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matches'), array('controller' => 'matches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Matches'); ?></h3>
	<?php if (!empty($round['Match'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Zone Id'); ?></th>
		<th><?php echo __('Playoff Id'); ?></th>
		<th><?php echo __('Match Type Id'); ?></th>
		<th><?php echo __('Team1 Id'); ?></th>
		<th><?php echo __('Team2 Id'); ?></th>
		<th><?php echo __('Round Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Time'); ?></th>
		<th><?php echo __('Field'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($round['Match'] as $match): ?>
		<tr>
			<td><?php echo $match['id']; ?></td>
			<td><?php echo $match['zone_id']; ?></td>
			<td><?php echo $match['playoff_id']; ?></td>
			<td><?php echo $match['match_type_id']; ?></td>
			<td><?php echo $match['team1_id']; ?></td>
			<td><?php echo $match['team2_id']; ?></td>
			<td><?php echo $match['round_id']; ?></td>
			<td><?php echo $match['date']; ?></td>
			<td><?php echo $match['time']; ?></td>
			<td><?php echo $match['field']; ?></td>
			<td><?php echo $match['created']; ?></td>
			<td><?php echo $match['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'matches', 'action' => 'view', $match['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'matches', 'action' => 'edit', $match['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'matches', 'action' => 'delete', $match['id']), array(), __('Are you sure you want to delete # %s?', $match['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
