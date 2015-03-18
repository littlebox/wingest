<?php
	$data['cantEquiposTotal'] = $data['cantEquiposMasc']+$data['cantEquiposFemAm']+$data['cantEquiposFemPro'];
?>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="dashboard-stat red-soft">
		<div class="visual">
			<i class="fa fa-shield"></i>
		</div>
		<div class="details">
			<div class="number">
				<?= $data['cantEquiposTotal'] ?>
			</div>
			<div class="desc">
				Cantidad de equipos inscriptos
			</div>
		</div>
		<a class="more" href="<?= $this->Html->Url(array('controller' => 'Teams'))?>">
			Ver Todos <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="dashboard-stat blue">
		<div class="visual">
			<i class="fa fa-shield"></i>
		</div>
		<div class="details">
			<div class="number">
				<?= $data['cantEquiposMasc'] ?>
			</div>
			<div class="desc">
				Torneo Masculino
			</div>
		</div>
		<a class="more" href="<?= $this->Html->Url(array('controller' => 'Teams'))?>">
			Ver Todos <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="dashboard-stat red-intense">
		<div class="visual">
			<i class="fa fa-shield"></i>
		</div>
		<div class="details">
			<div class="number">
				<?= $data['cantEquiposFemAm'] ?>
			</div>
			<div class="desc">
				Torneo Femenino Amateur
			</div>
		</div>
		<a class="more" href="<?= $this->Html->Url(array('controller' => 'Teams'))?>">
			Ver Todos <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="dashboard-stat yellow">
		<div class="visual">
			<i class="fa fa-shield"></i>
		</div>
		<div class="details">
			<div class="number">
				<?= $data['cantEquiposFemPro'] ?>
			</div>
			<div class="desc">
				Torneo Femenino Pro
			</div>
		</div>
		<a class="more" href="<?= $this->Html->Url(array('controller' => 'Teams'))?>">
			Ver Todos <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<div class="dashboard-stat green">
		<div class="visual">
			<i class="fa fa-user"></i>
		</div>
		<div class="details">
			<div class="number">
				<?= $data['cantJugadores'] ?>
			</div>
			<div class="desc">
				Cantidad de jugadores inscriptos
			</div>
		</div>
		<a class="more" href="<?= $this->Html->Url(array('controller' => 'Players'))?>">
			Ver Todos <i class="m-icon-swapright m-icon-white"></i>
		</a>
	</div>
</div>