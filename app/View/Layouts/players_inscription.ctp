<?php
	// debug($datos);die();
	$cant = array(0,12,14,14);
	$cantjugadores = $cant[$datos['Team']['tournament_id']];

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Torneo wingest - Preinscripci&oacute;n</title>
		<meta name="description" content="Formulario de preinscripcion de Torneo Wingest" />
		<meta name="author" content="Littlebox" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<link rel="icon" type="image" href="img/twfavicon.png" />
		<?php
			echo $this->Html->css('normalize');
			echo $this->Html->css('foundation.min');
			echo $this->Html->css('demotabs');
			echo $this->Html->css('tabs');
			echo $this->Html->css('tabstyles');
			echo $this->Html->css('responsive-form');
			// echo $this->Html->css('cs-select');
			// echo $this->Html->css('component');
			// echo $this->Html->css('cs-skin-boxes');
			echo $this->Html->script('modernizr.custom.js');
			echo $this->Html->script('jquery');
			echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');
		?>
	</head>
	<body>

		<div class="container">

		<?= $this->Form->create('Team', array('class' => 'cbp-mc-form' , 'enctype' => 'multipart/form-data' ,'inputDefaults' => array(
			'label' => false,
			'div' => false,
		))); ?>
			<section>
				<div class="tabs tabs-style-flip">
					<nav>
						<ul>

							<li class="pagination back show-for-small-only">
								<a href="#back">
									<span><i class="fa fa-arrow-left fa-lg"></i></span>
								</a>
							</li>

							<li class="tab team">
								<a href="#section-flip-0">
									<span class="span span-0"><i class="fa fa-shield fa-lg"></i> Equipo</span>
								</a>
							</li>

							<?php for($i = 1; $i <= $cantjugadores; $i++): ?>
								<li class="tab">
									<a href="#section-flip-<?= $i;?>">
										<span class="span span-<?= $i;?>">J<?= $i;?></span>
									</a>
								</li>
							<?php endfor;?>

							<li class="pagination next show-for-small-only">
								<a href="#next">
									<span><i class="fa fa-arrow-right fa-lg"></i></span>
								</a>
							</li>

						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-flip-0">

							<div>

								<div class="fileinput-wrapper small-12 medium-6 column">

									<div>

										<div class="fileinput-container">

											<div class="fileinput fileinput-new" data-provides="fileinput">

												<div class="actions">

													<div>
														<div class="delete" data-dismiss="fileinput"><span class="fa fa-trash"></span> BORRAR</div>
													</div>

													<div>
														<div class="change" data-trigger="fileinput"><span class="fa fa-repeat"></span> CAMBIAR</div>
													</div>

												</div>

												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 400px; height: 400px;">
													<?php if(is_file( WWW_ROOT.'img'.DS.'media'.DS.'profile'.DS.$_SESSION['data']['Team']['name'].'.jpg' )):?>
														<img src="/img/media/profile/<?= $_SESSION['data']['Team']['name'].'.jpg' ?>" style="width:400px">
													<?php else:?>
														<img src="/img/logotwform.jpg">
													<?php endif;?>
												</div>

												<div>
													<span class="btn btn-default btn-file">
														<input type="file" name="data[Team][escudo]">
													</span>
													<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Borrar</a>
												</div>

											</div>

										</div>

									</div>

								</div>

								<div class="small-12 medium-6 column">

									<div class="teamname">
										<h1><?= $datos['Team']['name']?></h1>
									</div>

									<div class="colors-container">

										<div class="colors">

											<?php
												if( $datos['Team']['main_shirt_color'] != ''){
													$colortit = $datos['Team']['main_shirt_color'];
												}else{
													$colortit = '#fff';
												}
												if( $datos['Team']['main_shirt_color'] != ''){
													$colorsec = $datos['Team']['secondary_shirt_color'];
												}else{
													$colorsec = '#fff';
												}
											?>

											<div id="color-primario" class="color-selector">
												<div class="color-container">

													<div>
														<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
															width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
														<g>
															<path class="color-sample" fill="<?php echo $colortit; ?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
																c0-0.476-0.368-0.86-0.845-0.86h-4.24L1.408,6.733l9.436-2.444c0.338,0.753,0.875,1.368,1.629,1.844
																c0.753,0.477,1.598,0.707,2.535,0.707c0.922,0,1.752-0.23,2.506-0.707c0.754-0.476,1.307-1.09,1.645-1.844l9.436,2.444
																L27.395,11.296z"/>
														</g>
														</svg>

														<span>Color principal de camiseta</span>
														<input type="hidden" name="data[Team][main_shirt_color]" value="<?= $datos['Team']['main_shirt_color'] ?>">

													</div>
												</div>

											</div>

											<div id="color-secundario" class="color-selector">
												<div class="color-container">
													<div>
														<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
															width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
														<g>
															<path class="color-sample" fill="<?php echo $colorsec; ?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
																c0-0.476-0.368-0.86-0.845-0.86h-4.24L1.408,6.733l9.436-2.444c0.338,0.753,0.875,1.368,1.629,1.844
																c0.753,0.477,1.598,0.707,2.535,0.707c0.922,0,1.752-0.23,2.506-0.707c0.754-0.476,1.307-1.09,1.645-1.844l9.436,2.444
																L27.395,11.296z"/>
														</g>
														</svg>
														<span>Color secundario de camiseta</span>
														<input type="hidden" name="data[Team][secondary_shirt_color]" value="<?= $datos['Team']['secondary_shirt_color'] ?>">
													</div>
												</div>
											</div>


											<div id="colors" class="cs-select cs-skin-boxes cs-active reveal-modal full" data-reveal>

												<div class="cs-options">
													<ul>
														<li class="color-8E1827" data-option="" data-value="#8E1827"></li>
														<li class="color-D32E2E" data-option="" data-value="#D32E2E"></li>
														<li class="color-D64526" data-option="" data-value="#D64526"></li>
														<li class="color-EC7023" data-option="" data-value="#EC7023"></li>
														<li class="color-F9BF2B" data-option="" data-value="#F9BF2B"></li>
														<li class="color-FDF59F" data-option="" data-value="#FDF59F"></li>
														<li class="color-692C90" data-option="" data-value="#692C90"></li>
														<li class="color-9A519F" data-option="" data-value="#9A519F"></li>
														<li class="color-C389BC" data-option="" data-value="#C389BC"></li>
														<li class="color-F27FAA" data-option="" data-value="#F27FAA"></li>
														<li class="color-33429A" data-option="" data-value="#33429A"></li>
														<li class="color-478FCC" data-option="" data-value="#478FCC"></li>
														<li class="color-9CD9E5" data-option="" data-value="#9CD9E5"></li>
														<li class="color-004D40" data-option="" data-value="#004D40"></li>
														<li class="color-03897B" data-option="" data-value="#03897B"></li>
														<li class="color-378E43" data-option="" data-value="#378E43"></li>
														<li class="color-8EC63E" data-option="" data-value="#8EC63E"></li>
														<li class="color-000000" data-option="" data-value="#000000"></li>
														<li class="color-BDBCBC" data-option="" data-value="#BDBCBC"></li>
														<li class="color-FFFFFF" data-option="" data-value="#FFFFFF"></li>
													</ul>
												</div>

												<a class="close-reveal-modal">&#215;</a>
											</div>

										<div>

									</div>

								</div>

							</div>

						</section>

						<?php for($i = 1; $i <= $cantjugadores; $i++): ?>
						<section id="section-flip-<?= $i;?>">

							<?php
								$datos['Player'][$i]['name'] = ( isset($datos['Player'][$i]['name']) )? $datos['Player'][$i]['name'] :'';
								$datos['Player'][$i]['last_name'] = ( isset($datos['Player'][$i]['last_name']) )? $datos['Player'][$i]['last_name'] :'';
								$datos['Player'][$i]['nickname'] = ( isset($datos['Player'][$i]['nickname']) )? $datos['Player'][$i]['nickname'] :'';
								$datos['Player'][$i]['position'] = ( isset($datos['Player'][$i]['position']) )? $datos['Player'][$i]['position'] :'';
								$datos['Player'][$i]['email'] = ( isset($datos['Player'][$i]['email']) )? $datos['Player'][$i]['email'] :'';
								$datos['Player'][$i]['birthday'] = ( isset($datos['Player'][$i]['birthday']) )? $datos['Player'][$i]['birthday'] :'';
								$datos['Player'][$i]['phone'] = ( isset($datos['Player'][$i]['phone']) )? $datos['Player'][$i]['phone'] :'';
								$datos['Player'][$i]['dni'] = ( isset($datos['Player'][$i]['dni']) )? $datos['Player'][$i]['dni'] :'';
								$datos['Player'][$i]['facebook'] = ( isset($datos['Player'][$i]['facebook']) )? $datos['Player'][$i]['facebook'] :'';
							?>

							<div class="small-12 row">

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[nombre]">Nombre</label>
									<?= $this->Form->input("Player.".$i.".name", array(
										'value' => $datos['Player'][$i]['name'],
										'placeholder' => 'Javier',
									));?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[last_name]">Apellido</label>
									<?= $this->Form->input("Player.".$i.".last_name", array(
										'value' => $datos['Player'][$i]['last_name'],
										'placeholder' => 'Mascherano',
									));?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[dni]">dni</label>
									<?= $this->Form->input("Player.".$i.".dni", array(
										'value' => $datos['Player'][$i]['dni'],
										'placeholder' => '35111111',
										'type' => 'text',
									));?>
								</div>

							</div>

							<div class="small-12 row">

								<div class="small-12 large-4 columns">
									<label>Posición preferida</label>
									<?php
										$posiciones = array('arq' => 'Arquero', 'def' => 'Defensor', 'med' => 'Mediocampista' ,'del' => 'Delantero');
										echo $this->Form->select("Player.".$i.".position", $posiciones, array('value' => $datos['Player'][$i]['position'], 'empty' => 'Seleccionar'));
									?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[email]">email</label>
									<?= $this->Form->input("Player.".$i.".email", array(
										'value' => $datos['Player'][$i]['email'],
										'placeholder' => 'masche05@barcelona.com',
									));?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[birthday]">Fecha de nacimiento</label>
									<input type="date" id="Player<?= $i?>birthday" name="data[Player][<?= $i?>][birthday]" value="<?= $datos['Player'][$i]['birthday']?>" placeholder="2015-03-13">
								</div>

							</div>

							<div class="small-12 row">

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[phone]">celular</label>
									<?= $this->Form->input("Player.".$i.".phone", array(
										'value' => $datos['Player'][$i]['phone'],
										'placeholder' => '2615111111',
									));?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[nickname]">apodo</label>
									<?= $this->Form->input("Player.".$i.".nickname", array(
										'value' => $datos['Player'][$i]['nickname'],
										'placeholder' => 'Jefecito',
									));?>
								</div>

								<div class="small-12 large-4 columns">
									<label for="data[Player]<?= $i?>[facebook]">facebook</label>
									<?= $this->Form->input("Player.".$i.".facebook", array(
										'value' => $datos['Player'][$i]['facebook'],
										'placeholder' => 'masche05',
									));?>
								</div>

							</div>


						</section>
						<?php endfor;?>
					</div><!-- /content -->
				</div><!-- /tabs -->
				<div class="cbp-mc-submit-wrap">
					<input class="cbp-mc-submit" type="submit" value="Guardar Datos" />
					<a class="cbp-mc-submit" href="<?= $this->Html->url(array('action' => 'logout'))?>">Cerrar Sesión</a>
				</div>
			</section>

		</form>
		<?php
			echo $this->Html->css('/plugins/bootstrap-fileinput/bootstrap-fileinput');
			echo $this->Html->script('foundation.min.js');
			echo $this->Html->script('foundation.reveal.js');
			echo $this->Html->script('/plugins/bootstrap-fileinput/bootstrap-fileinput');
			echo $this->Html->script('classie');
			echo $this->Html->script('cbpFWTabs');
		?>
		<script type="text/javascript">
			(function() {
				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					tabs = new CBPFWTabs( el );
				});
			})();
		</script>
	</body>
</html>
