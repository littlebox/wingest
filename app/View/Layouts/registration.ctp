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
			echo $this->Html->css('demo');
			// echo $this->Html->css('cs-select');
			echo $this->Html->css('component');
			// echo $this->Html->css('cs-skin-boxes');
			echo $this->Html->script('modernizr.custom.js');
		?>
		<script type="text/javascript">
			var onloadCallback = function() {
				grecaptcha.render('recaptcha', {
				'sitekey' : '6LezRgETAAAAAOJ4A5B7QvaPu2PBwEvTAbHFsyrw'
				});
			};
		</script>
	</head>
	<body>
		<div class="container">

			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title">
					<h1>Torneo Wingest</h1>
					<h2>Preinscripci&oacute;n</h2>
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
							<?= $this->Form->input('name', array('placeholder' => 'Amigos FC','required' => 'required'))?>
						</li>
						<li>
							<?= $this->Form->input('captain', array('placeholder' => 'Javier Mascherano','required' => 'required' , 'label' => array('text' => 'Delegados', 'class' => 'fs-field-label fs-anim-upper')))?>
							<?= $this->Form->input('captain2', array('placeholder' => 'Sergio Romero', 'required' => 'required', 'label' => false))?>
						</li>
						<li>
							<?= $this->Form->input('captain_email', array('type'=>'email','placeholder' => 'javier@masche.com','required' => 'required', 'label' => array('text' => 'Email de los delegados','class' => 'fs-field-label fs-anim-upper','data-info' => 'No te vamos a spamear, lo prometemos :) ')))?>
							<?= $this->Form->input('captain2_email', array('type'=>'email','placeholder' => 'sergio@heroe.com','required' => 'required', 'label' => false ))?>
						</li>

						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q3">Numeros de tel&eacute;fono</label>
							<div class="fs-phone clearfix fs-anim-lower">
								<input name="data[Team][captain_phone]" class="col-md-10 fs-anim-lower" placeholder="2612345678" type="number" required="required">
								<input name="data[Team][captain2_phone]" class="col-md-10 fs-anim-lower" placeholder="2618765432" type="number" required="required">
							</div>
						</li>

						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" for="q3">Facebooks de los delegados</label>
							<div class="fs-facebook clearfix fs-anim-lower">
								<span class="col-md-2">facebook.com/</span><input name="data[Team][captain_facebook]" class="col-md-10 fs-anim-lower" placeholder="masche">
								<div class="clearfix"></div>
								<span class="facebook2 col-md-2">facebook.com/</span><input name="data[Team][captain2_facebook]" class="col-md-10 fs-anim-lower" placeholder="SergioRomero">
							</div>
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
						<li>
							<label class="fs-field-label fs-anim-upper" for="data[Team][message]" data-info="Es necesario, perdón :(">Completá el captcha</label>
							<div id="recaptcha" class="fs-anim-lower"></div>
						</li>
					</ol><!-- /fs-fields -->
					<button class="fs-submit" type="submit">Enviar</button>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->
		</div><!-- /container -->
		<div class="fs-reglamento">
			<a title="reglamento" target="_blank">Reglamento</a>
			<ul>
				<li><a href="/files/ReglamentoTWPreparacion.pdf" target="_blank" title="TW Masculino">TW Masculino</a></li>
				<li><a href="files/ReglamentoTWfemeninoAbril.pdf" target="_blank" title="TW Femenino">TW Femenino</a></li>
			</ul>
		</div>
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

				var ulregl = document.querySelector('.fs-reglamento ul')

				document.querySelector('.fs-reglamento').addEventListener('click',function(ev){classie.toggle(ulregl,'active')})

				fform = new FForm( formWrap);
			})();
		</script>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46727112-8', 'auto');
  ga('send', 'pageview');
</script>
	<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit'></script>
	</body>
</html>
