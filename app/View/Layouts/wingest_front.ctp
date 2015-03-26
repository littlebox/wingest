<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang=<?= Configure::read('Config.language') ?>>
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<title><?= $this->fetch('title'); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<link rel="icon" type="image" href="/img/twfavicon.png" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<?php
		echo $this->Html->css('/plugins/font-awesome/css/font-awesome.min');
		echo $this->Html->css('/front/app.css');
	?>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES -->
	<?php
	?>
	<!-- END THEME STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<?php echo $this->fetch('pageStyles'); ?>
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>

	<div class="row">

	<div id="logo" class="column small-12 medium-6">
		<h1>Torneo Wingest</h1>
	</div>

	<div id="mystats" class="column small-12 medium-6">
		<p>stats</p>
	</div>
	</div>

	<div class="row">
		<div id="menu" class="column small-12 medium-6">
			<p>Menu?</p>
		</div>

		<div id="social" class="column small-12 medium-6">
			<div class="column small-8">Twitter</div>
			<div class="column small-4">Facebook</div>
		</div>

	</div>

	<div id="container">
		<?php echo $this->fetch('content');?>
	</div>

<!-- BEGIN PAGE PLUGINS -->
<?php echo $this->fetch('pagePlugins'); ?>
<!-- END PAGE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
	echo $this->Html->script('/front/assets/jquery/dist/jquery.min.js');
	echo $this->Html->script('/front/assets/foundation/js/foundation.min.js');
	echo $this->Html->script('/front/assets/foundation/js/foundation/foundation.equalizer.js');
	echo $this->Html->script('/front/app.js');
?>
<script>
	jQuery(document).ready(function() {
		$(document).foundation()
		// Wingest.init();
	});
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js"></script>

<?php echo $this->fetch('pageScripts'); ?>

<!-- END PAGE LEVEL SCRIPTS -->
<!-- END JAVASCRIPTS -->
</body>