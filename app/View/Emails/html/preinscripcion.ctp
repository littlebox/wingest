<h2>Datos ingresados</h2>
<ul>
	<li>Nombre del equipo: <?= $Team['name']?></li>
	<li>Nombre del primer delegado: <?= $Team['captain']?></li>
	<li>Nombre del segundo delegado: <?= $Team['captain2']?></li>
	<li>Email del primer delegado: <?= $Team['captain_email']?></li>
	<li>Email del segundo delegado: <?= $Team['captain2_email']?></li>
	<li>Telefono del primer delegado: <?= $Team['captain_phone']?></li>
	<li>Telefono del segundo delegado: <?= $Team['captain2_phone']?></li>
	<?php if(!empty($Team['captain_facebook'])):?>
		<li>Facebook del primer delegado: <a href="https://facebook.com/<?= $Team['captain_facebook']?>"><?= $Team['captain_facebook']?></a></li>
	<?php endif;?>
	<?php if(!empty($Team['captain2_facebook'])):?>
		<li>Facebook del primer delegado: <a href="https://facebook.com/<?= $Team['captain2_facebook']?>"><?= $Team['captain2_facebook']?></a></li>
	<?php endif;?>
	<li>Torneo:
		<select disabled>
			<option value=1 <?php echo ($Team['tournament_id'] == 1)?'selected':'' ?>>Masculino</option>
			<option value=2 <?php echo ($Team['tournament_id'] == 2)?'selected':'' ?>>Femenino Amateur</option>
			<option value=3 <?php echo ($Team['tournament_id'] == 3)?'selected':'' ?>>Femenino Pro</option>
		</select>
	</li>
	<li>Tienen remeras? <?php echo ($Team['has_shirts'] == 0)?'No. Gerardo vendeles!':'Si'?></li>
</ul>
<h2>Dudas o comentarios del delegado</h2>
<div><p><?= $Team['message']?></p></div>
