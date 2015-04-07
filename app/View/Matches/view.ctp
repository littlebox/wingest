<?php debug($match)?>
<div class="spreadsheet">
	<div class="header">
		<div class="head-left">
			<div>Fecha 1</div>
			<div>22/02/15</div>
		</div>
		<div class="head-center zone-name"><?= __('GRUPO ').$match['Zone']['name']; ?></div>
		<div class="head-right">
			<div>Cancha 2</div>
			<div>13:30</div>
		</div>
	</div>
	<div class="flex-table">
		<div class="flex-row"></div>
	</div>
</div>
<?php
	echo $this->Html->css('matches-view');
?>