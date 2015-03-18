<div class="page-inner">
	<?= $this->Html->image('media/pages/earth.jpg', array('class' => 'img-responsive'));?>
</div>
<div class="container error-container">
	<h1>404</h1>
	<h2><?= __('Houston, we have a problem.') ?></h2>
	<p>
		<?= __('Actually, the page you are looking for does not exist.') ?>
	</p>
	<p>
		<?= $this->Html->link(__('Return home'), array('controller' => 'pages', 'action' => 'index')); ?>
		<br>
	</p>
</div>