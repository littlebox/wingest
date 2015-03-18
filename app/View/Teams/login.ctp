<?php
	$inputFormOptions = array(
				'div' => array(
					'class' => 'form-group'
					),
				'label' => array(
					'class' => 'control-label visible-ie8 visible-ie9',
					),
				/* input */
				'class' => 'form-control form-control-solid placeholder-no-fix'
			);

	$this->assign('title',__('Login'));
?>

<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<?= $this->Form->create('Team', array('inputDefaults' => $inputFormOptions,'class' => 'login-form')); ?>
		<h3 class="form-title"><?= __("Ingresar");?></h3>

		<!-- BEGIN ERROR MESSAGE-->
		<?= $this->Session->flash()?>
		<!-- END ERROR MESSAGE-->

		<?= $this->Form->input('name', array('placeholder' => __('Nombre del equipo')));?>
		<?= $this->Form->input('password', array('placeholder' => __('Password')));?>


		<div class="form-actions" style="text-align:right;">
			<?= $this->Form->button(__('Login'), array('class' => 'btn btn-success uppercase'));?>
		</div>
	<?= $this->Form->end(); ?>
	<!-- END LOGIN FORM -->
</div>
<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('login');?>
	<script>
		jQuery(document).ready(function() {
			Login.init();
		});
	</script>
<?php $this->end(); ?>