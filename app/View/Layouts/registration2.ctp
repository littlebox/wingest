<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Torneo wingest - Preinscripci&oacute;n</title>
		<meta name="description" content="Formulario de preinscripcion de Torneo Wingest" />
		<meta name="author" content="Littlebox" />
		<link rel="icon" type="image" href="img/twfavicon.png" />
		<?php
			echo $this->Html->css('normalize');
			echo $this->Html->css('demo');
			echo $this->Html->css('cs-select');
			echo $this->Html->css('component');
			echo $this->Html->css('cs-skin-boxes');
			echo $this->Html->script('modernizr.custom.js');
		?>
	</head>
	<body>
		<div class="container">

			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1>Torneo Wingest - Preinscripci&oacute;n</h1>
					<?php echo $this->Session->flash(); ?>
				</div>
				<?php echo $this->Form->create('Team',
				array('class' => 'fs-form fs-form-full', 'id'=>'myform',
					'inputDefaults' => array(
						'div' => false,
						'label' => array('class' => 'fs-field-label fs-anim-upper'),
						'class' => 'fs-anim-lower',
						'error' => array('attributes' => array('class' => 'error fs-anim-lower'))
					),
				));?>
					<ol class="fs-fields">
						<li>
							<?= $this->Form->input('name', array('placeholder' => 'Joa Sissones','required' => 'required'))?>
						</li>
						<li>
							<?= $this->Form->input('captain', array('placeholder' => 'Juan Perez','required' => 'required'))?>
						</li>
						<li>
							<?= $this->Form->input('captain_email', array('type'=>'email','placeholder' => 'juanperez@mail.com','required' => 'required', 'label' => array('class' => 'fs-field-label fs-anim-upper','data-info' => 'No te vamos a spamear, lo prometemos!')))?>
						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q3">Qu&eacute; torneo quer&eacute;s jugar?</label>
							<div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
								<span><input id="q3b" name="data[Team][tournament_id]" type="radio" value="1"/><label for="q3b" class="radio-conversion">TW F7 Varones</label></span>
								<span><input id="q3c" name="data[Team][tournament_id]" type="radio" value="2"/><label for="q3c" class="radio-social">TW F7 Mujeres Amateur</label></span>
								<span><input id="q3a" name="data[Team][tournament_id]" type="radio" value="3"/><label for="q3a" class="radio-mobile">TW F7 Mujeres Pro</label></span>
							</div>
						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper">Ten&eacute;s remeras del equipo?</label>
							<div class="clearfix fs-anim-lower shirts">
								<ul class="ac-custom ac-checkbox ac-checkmark shirts">
									<li><input id="cb6" name="data[Team][has_shirts]" type="checkbox" value=1><label for="cb6">Si</label></li>
									<li><input id="cb7" name="data[Team][has_shirts]" type="checkbox" value=0><label for="cb7">No</label></li>
								</ul>
							</div>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="data[Team][message]" data-info="Asi sabemos como ofrecerte la mejor atención :)">Dudas o comentarios que tengas...</label>
							<textarea class="fs-anim-lower" id="q4" name="data[Team][message]" placeholder="Escrib&iacute; ac&aacute;"></textarea>
						</li>
					</ol><!-- /fs-fields -->
					<button class="fs-submit" type="submit">Enviar</button>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->
		</div><!-- /container -->
		<div class="fs-littlebox">
			<a title="Littlebox" href="http://littlebox.com.ar" target="_blank">littlebox</a>
		</div>
		<?php
			echo $this->Html->script('classie');
			echo $this->Html->script('selectFx');
			echo $this->Html->script('svgcheckbx');
			echo $this->Html->script('fullscreenForm');
		?>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder.'+el.id).style.backgroundColor = val;
						}
					});
				} );

				fform = new FForm( formWrap, {
					onReview: function(){

					}
				} );
			})();
		</script>
	</body>
</html>