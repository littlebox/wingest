<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<!-- BEGIN SIDEBAR MENU -->

		<?php

			/* TODO:
				-check permissions,
				-check first and last item and put classes,
			*/

			$menu = array(
				array(
					'title'=>'Inicio',
					'href' =>array('controller'=>'pages','action'=>'home'),
					'icon'=>'screen-desktop'
				),
				// array(
				// 	'title'=>'Mensajes',
				// 	'href'=> array('controller'=>'users','action'=>'index'),
				// 	'icon'=>'envelope',
				// 	),
				// array(
				// 	'title'=>'Estadisticas',
				// 	'href'=>array('controller'=>'pages', 'action' => 'test'),
				// 	'icon'=>'bar-chart',
				// 	),
				array(
					'title'=>'Equipos',
					'href'=>array('controller'=>'teams', 'action' => 'index'),
					'icon'=>'shield',
				),
				array(
					'title'=>'Jugadores',
					'href'=>array('controller'=>'players', 'action' => 'index'),
					'icon'=>'users',
					'submenu' => array(
						array(
							'title'=>__('Ver jugadores'),
							'href'=>array('controller'=>'players', 'action' => 'index'),
							'icon'=>'users',
						),
					)
				),
				array(
					'title'=>'Torneos',
					'href'=>array('controller'=>'tournaments', 'action' => 'index'),
					'icon'=>'trophy',
				),

				//Admin Menu
				// array(
				// 	'title'=>'Usuarios',
				// 	'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
				// 	'icon'=>'users',
				// 	'submenu' => array(
				// 		array(
				// 			'title'=>__('View users'),
				// 			'href'=>array('controller'=>'users', 'action' => 'index', 'admin' => true),
				// 			'icon'=>'users',
				// 		),
				// 		array(
				// 			'title'=>__('Add user'),
				// 			'href'=>array('controller'=>'users', 'action' => 'add', 'admin' => true),
				// 			'icon'=>'users',
				// 		),
				// 	)
				// ),
				// array(
				// 	'title'=>'Sitio',
				// 	'href'=>array('controller'=>'pages', 'action' => 'site_options', 'admin' => true),
				// 	'icon'=>'equalizer',
				// ),
				// array(
				// 	'title'=>'Estadisticas del Sitio',
				// 	'href'=>array('controller'=>'pages', 'action' => 'site_stats', 'admin' => true),
				// 	'icon'=>'bar-chart',
				// ),

			);
		?>

		<ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">

			<?php

				$this->Menu->showMenu($menu);

			?>

		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
</div>
<!-- END SIDEBAR -->