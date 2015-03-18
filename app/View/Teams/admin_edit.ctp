<div class="portlet light bordered form-fit">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-plus font-blue-hoki"></i>
			<span class="caption-subject font-blue-hoki bold uppercase"><?= __('Edit')?></span>
			<span class="caption-helper"><?= __('Equipos')?></span>
		</div>
	</div>
	<div class="portlet-body form">
		<!-- BEGIN FORM-->
		<?php echo $this->Form->create('Team', array(
			'enctype' => 'multipart/form-data',
			'inputDefaults' => array(
				'format' => array('before','label','between','input','error','after'),
				'autocomplete' => 'off',
				'div' => array(
					'class' => 'form-group',
				),
				'label' => array(
					'class' => 'control-label col-md-3'
				),
				'class' => 'form-control',
				'between' => '<div class="col-md-9">',
				'after' => '</div>',
				'error' => array('attributes' => array(
					'class' => 'help-block',
					'wrap' => 'span',
					))
			),
			'class' => 'form-horizontal form-bordered',
			'id' => 'team-form',
		)); ?>
			<div class="form-body">

				<?php
					echo $this->Form->input('name');
					echo $this->Form->input('tournament_id');
					echo $this->Form->input('password', array('required' => 'false'));
					echo $this->Form->input('password_confirm',array('required' => 'false','type' => 'password'));
				?>

				<div class="form-group">
					<label class="control-label col-md-3">Ver password</label>
					<div class="col-md-9">
						<input id="see-pass" type="checkbox" value="Ver password">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-md-3">Generar nuevo password</label>
					<div class="col-md-9">
						<input class="btn-default" id="create-pass" type="button" value="Generar password">
					</div>
				</div>

			<div class="form-actions">
				<div class="row">
					<div class="col-md-offset-10 col-md-2">
						<?php
							echo $this->Form->Button(__('Cancel'),array(
								'div' => false,
								'class' => 'btn default',
								'type' => 'button'
							));
							echo $this->Form->Button(__('Save'),array(
								'div' => false,
								'class' => 'btn green',
								'type' => 'submit'
							));
							echo $this->Form->end();
						?>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM-->
	</div>
</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-switch/css/bootstrap-switch.min');?>
	<?= $this->Html->css('/plugins/jquery-tags-input/jquery.tagsinput');?>
<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min');?>
	<?= $this->Html->script('/plugins/jquery-validation/js/additional-methods.min');?>
	<?= $this->Html->script('/plugins/jcrop/js/jquery.color.js');?>
<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('global-setups');?>
	<?php //echo $this->Html->script('users-admin-add-edit.js');?>
	<script>

		function randomString(length, chars) {
			var result = '';
			for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
			return result;
		}


		jQuery(document).ready(function() {
			// UserAdminAddEdit.init();
			$pass = $('#TeamPassword');
			$cpass = $('#TeamPasswordConfirm');
			$('#see-pass').change(function(){
				if($(this).is(':checked')){
					$pass.attr('type','text')
					$cpass.attr('type','text')
				}else{
					$pass.attr('type','password')
					$cpass.attr('type','password')
				}

			})

			$('#create-pass').click(function(){

				$newPass = randomString(8, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
				$pass.val($newPass);
				$cpass.val($newPass);

			})

		});
	</script>
<?php $this->end(); ?>