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
			// echo $this->Html->css('normalize');
			// echo $this->Html->css('component');
			echo $this->Html->css('thanks');
			// echo $this->Html->script('modernizr.custom.js');
		?>
	</head>
	<body>
		<div class="container">
			<div class="fs-image-thanks">
				<h1>Muchas gracias por tu preinscripción!</h1>
				<?php echo $this->Html->image('thanks.jpg')?>
			</div>
		</div>
		<div style="display:none"><?php echo $this->Session->flash(); ?></div>
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46727112-8', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>
