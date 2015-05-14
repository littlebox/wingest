<?php
	// debug($tournament);die();
?>
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-futbol-o"></i>
			<span class="caption-subject bold uppercase">
				<?= __('Schedule Matches') ?>
			</span>
		</div>
		<div class="actions">
			<button type="button" onClick="sendScheduleMatches();" id="send-schedule-matches" class="btn btn-circle green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
		</div>
	</div>
	<div class="portlet-body" id="schedule_matches">
		<div class="col-md-12 column">
			<?php foreach ($tournament['Zone'] as $zone): ?>
				<div class="portlet box yellow">
					<div class="portlet-title">
						<div class="caption">
							Zona <?= $zone['name'];?>
						</div>
					</div>
					<div class="portlet-body">
						<div class="flex-table">
							<?php
								$i = 0;
								foreach ($zone['Match'] as $k => $match):
									//Set team colors for the badge. This is pure aesthetics.
									//By the way, the badge is awful. We gotta make one prettier.
									if(!empty($match['TeamLocal']['main_shirt_color'])){
										$local_main_color = $match['TeamLocal']['main_shirt_color'];
									}else{
										$local_main_color = '#0F570F';
									}
									if(!empty($match['TeamLocal']['main_shirt_color'])){
										$local_sec_color = $match['TeamLocal']['secondary_shirt_color'];
									}else{
										$local_sec_color = '#FFDA00';
									}

									if(!empty($match['TeamVisitor']['main_shirt_color'])){
										$visitor_main_color = $match['TeamVisitor']['main_shirt_color'];
									}else{
										$visitor_main_color = '#0F570F';
									}
									if(!empty($match['TeamVisitor']['main_shirt_color'])){
										$visitor_sec_color = $match['TeamVisitor']['secondary_shirt_color'];
									}else{
										$visitor_sec_color = '#FFDA00';
									}

									if($i == 0):
							?>
								<div class="flex-row flex-thead">
									<div class="flex-td small"></div>
									<div class="flex-td"><?= __('Local Team') ?></div>
									<div class="flex-td"><?= __('Visitor Team') ?></div>
									<div class="flex-td"><?= __('Round') ?></div>
									<div class="flex-td"><?= __('Date') ?></div>
									<div class="flex-td"><?= __('Time') ?></div>
									<div class="flex-td"><?= __('Field') ?></div>
									<div class="flex-td"><?= __('Actions') ?></div>
									<div class="flex-td small"></div>
								</div>
							<?php endif;?>
								<div class="team-data flex-row" id="<?= $match['id'];?>">

									<div class="flex-td small"><?= $k+1?></div>
									<div class="flex-td">
										<span class="team-badge">
											<svg width="1em" height="1em" viewbox="0 0 100 100">
												<g transform="translate(0,-952.36223)">
													<path fill="<?php echo $local_main_color; ?>" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 0,952.36224 50,0 0,61.99996 0,38 -50,-38 z" />
													<path fill="<?php echo $local_sec_color; ?>" d="m 100,952.36224 -50,0 0,61.99996 0,38 50,-38 z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
												</g>
											</svg>
										</span>
										<?= $match['TeamLocal']['name'];?>
									</div>
									<div class="flex-td">
										<span class="team-badge">
											<svg width="1em" height="1em" viewbox="0 0 100 100">
												<g transform="translate(0,-952.36223)">
													<path fill="<?php echo $visitor_main_color; ?>" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 0,952.36224 50,0 0,61.99996 0,38 -50,-38 z" />
													<path fill="<?php echo $visitor_sec_color; ?>" d="m 100,952.36224 -50,0 0,61.99996 0,38 50,-38 z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
												</g>
											</svg>
										</span>
										<?= $match['TeamVisitor']['name'];?>
									</div>

									<div class="flex-td">
										<select id="team-form-round-selector-<?= $match['id']?>" class="team-form-round-selector" data-id="<?= $match['id'];?>">
											<option value="">Round...
											<?php foreach($tournament['RoundZone'] as $round):?>
												<option <?php echo(($match['round_id'] == $round['id'])? 'selected="selected"' : '')?> value="<?= $round['id'] ?>"><?= $round['name'] ?>
											<?php endforeach;?>
										</select>
									</div>

									<div class="flex-td">
										<div id="round-dates-selector-<?= $match['id']?>" class="round-dates-selector">
											<select>
												<?php if($match['round_id'] != 0):
													foreach($tournament['RoundDates'][$match['round_id']]['dates'] as $k => $date):?>
													<option><?= $date ?>
												<?php
													endforeach;endif;
												?>
											</select>
										</div>
									</div>
									<div class="flex-td"><input type="text" class="timepicker timepicker-24 team-form-time" placeholder="--:--" value="<?= $match['time'];?>"></div>
									<div class="flex-td">
										<!-- <input type="text" placeholder="Ej: Cancha 4" class="team-form-field" value="<?= $match['field'];?>"> -->
										<select class="team-form-field">
											<option value="">Cancha...</option>
											<?php for ($i=1; $i <= 10 ; $i++):?>
												<option value="<?=$i?>" <?php echo (($match['field'] == $i)? 'selected="selected"' : '') ?>>Cancha <?=$i?>
											<?php endfor;?>
										</select>
									</div>
									<div class="flex-td" style="text-align:center;">
										<a href="<?php echo $this->Html->url(array('controller' => 'Matches', 'action'=>'view', $match['id']))?>" class="btn btn-sm blue"><i class="fa fa-futbol-o"></i> <?= __('Planilla') ?></a>
									</div>
									<div class="flex-td small" style="text-align:center;">
										<input class="team-form-compute" type="checkbox" <?php if($match['compute']){echo 'checked';}?> title="Computar">
									</div>
								</div>
						<?php $i++;endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php foreach ($tournament['Playoff'] as $playoff): ?>
				<div class="portlet box red-sunglo">
					<div class="portlet-title">
						<div class="caption">
							<?= $playoff['name'];?>
						</div>
					</div>
					<div class="portlet-body">
						<div class="flex-table">
							<?php
								$i = 0;
								foreach ($playoff['Match'] as $match):
									//Set team colors for the badge. This is pure aesthetics.
									//By the way, the badge is awful. We gotta make one prettier.
									if(!empty($match['TeamLocal']['main_shirt_color'])){
										$local_main_color = $match['TeamLocal']['main_shirt_color'];
									}else{
										$local_main_color = '#0F570F';
									}
									if(!empty($match['TeamLocal']['main_shirt_color'])){
										$local_sec_color = $match['TeamLocal']['secondary_shirt_color'];
									}else{
										$local_sec_color = '#FFDA00';
									}

									if(!empty($match['TeamVisitor']['main_shirt_color'])){
										$visitor_main_color = $match['TeamVisitor']['main_shirt_color'];
									}else{
										$visitor_main_color = '#0F570F';
									}
									if(!empty($match['TeamVisitor']['main_shirt_color'])){
										$visitor_sec_color = $match['TeamVisitor']['secondary_shirt_color'];
									}else{
										$visitor_sec_color = '#FFDA00';
									}
									if($i == 0):
									?>
										<div class="flex-row flex-thead">
											<div class="flex-td small"></div>
											<div class="flex-td"><?= __('Local Team') ?></div>
											<div class="flex-td"><?= __('Visitor Team') ?></div>
											<div class="flex-td"><?= __('Date') ?></div>
											<div class="flex-td"><?= __('Time') ?></div>
											<div class="flex-td"><?= __('Field') ?></div>
											<div class="flex-td"><?= __('Actions') ?></div>
										</div>
									<?php endif;?>
								<div class="team-data flex-row" id="<?= $match['id'];?>">
									<div class="flex-td"><?= $i?></div>
									<div class="flex-td">
										<span class="team-badge">
											<svg width="1em" height="1em" viewbox="0 0 100 100">
												<g transform="translate(0,-952.36223)">
													<path fill="<?php echo $local_main_color; ?>" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 0,952.36224 50,0 0,61.99996 0,38 -50,-38 z" />
													<path fill="<?php echo $local_sec_color; ?>" d="m 100,952.36224 -50,0 0,61.99996 0,38 50,-38 z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
												</g>
											</svg>
										</span>
										<?= $match['TeamLocal']['name'];?>
									</div>
									<div class="flex-td">
										<span class="team-badge">
											<svg width="1em" height="1em" viewbox="0 0 100 100">
												<g transform="translate(0,-952.36223)">
													<path fill="<?php echo $visitor_main_color; ?>" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 0,952.36224 50,0 0,61.99996 0,38 -50,-38 z" />
													<path fill="<?php echo $visitor_sec_color; ?>" d="m 100,952.36224 -50,0 0,61.99996 0,38 50,-38 z" style="fill-opacity:1;fill-rule:evenodd;stroke:none;stroke-width:1;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" />
												</g>
											</svg>
										</span>
										<?= $match['TeamVisitor']['name'];?>
									</div>
									<div class="flex-td"><?php
										if(isset($match['date']) && $match['date'] != '0000-00-00'){
											$dbDateTime = DateTime::createFromFormat('Y-m-d', $match['date']);
											$espDateString = $dbDateTime->format('d/m/Y');
											// debug($match['date']);die();
										}else{
											$espDateString = '';
										}
									?>
										<input class="date-picker team-form-date" size="8" type="text" placeholder="--/--/----" value="<?= $espDateString;?>">
									</div>
									<div class="flex-td"><input type="text" class="timepicker timepicker-24 team-form-time" placeholder="--:--" value="<?= $match['time'];?>"></div>
									<div class="flex-td"><input type="text" placeholder="Ej: Cancha 4" class="team-form-field" value="<?= $match['field'];?>"></div>
									<div class="flex-td"><input disabled="disabled" value="<?= $match['MatchType']['name'];?>"></div>
									<div class="flex-td" style="text-align:center;">
										<a class="btn btn-sm blue"><i class="fa fa-futbol-o"></i> <?= __('Planilla') ?></a>
									</div>
								</div>
						<?php $i++;endforeach; ?>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

		<?php //Formulario oculto para poder setear el string JSON en el campo hidden y poder mandar por AJAX
		echo $this->Form->create('Tournament', array(
			'enctype' => 'multipart/form-data',
			'style' => 'display:none;',
			'id' => 'schedule-matches-form',
		));
		?>
		<?php
			echo $this->Form->hidden('json', array('id' => 'hidden-json'));
		?>
		<?= $this->Form->end(); ?>

		<div class="form-actions">
			<div class="row">
				<div class="col-md-offset-10 col-md-2">
					<!-- <button type="button" onClick="sendScheduleMatches();" id="send-shedule-matches" class="btn green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button> -->
				</div>
			</div>
		</div>

	</div>


</div>

<?php $this->append('pageStyles'); ?>
	<?= $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');?>
	<?= $this->Html->css('/plugins/sweetalert/lib/sweet-alert');?>
	<?= $this->Html->css('schedule-matches.css');?>
	<?= $this->Html->css('/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min');?>
	<?= $this->Html->css('/plugins/bootstrap-datepicker/css/datepicker3');?>

<?php $this->end(); ?>

<?php $this->append('pagePlugins'); ?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');?>
	<?= $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');?>
	<?= $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');?>
	<?= $this->Html->script('/plugins/bootstrap-daterangepicker/moment.min');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/bootstrap-datepicker');?>
	<?= $this->Html->script('/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es');?>
	<?= $this->Html->script('/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min');?>


<?php $this->end(); ?>

<?php $this->append('pageScripts'); ?>
	<?= $this->Html->script('tournaments-schedule-matches.js');?>
	<script>
		jQuery(document).ready(function() {
			TournamentScheduleMatches.init();
		});

		LocalVar = {};
		LocalVar.RoundDates = <?= json_encode($tournament['RoundDates'])?>

		function outputJsonZones(){
			teamForms = document.getElementsByClassName('team-data');
			var saveString = "";
			saveString += '[';
			//var lists = teamForms.getElementsByClassName('dd');
			for(var i=0; i<teamForms.length; i++){	// Looping through all <ul> except the one who contain all items
				id = teamForms[i].id;

				// dateArray = teamForms[i].getElementsByClassName('team-form-date')[0].value.split('/')

				dateArray = ($('#round-dates-selector-'+id+' select').val() != null) ? $('#round-dates-selector-'+id+' select').val().split('/') : '';

				//verify if is a valid date, or set 0
				if(!isNaN(Date.parse(dateArray[1]+'/'+dateArray[0]+'/'+dateArray[2]))){
					date = dateArray[2]+'-'+dateArray[1]+'-'+dateArray[0]
				}else{
					date = '0000-00-00';
				}

				round = ($('#team-form-round-selector-'+id).val() != null) ? $('#team-form-round-selector-'+id).val().split('/') : '';

				time = teamForms[i].getElementsByClassName('team-form-time')[0].value;
				field = teamForms[i].getElementsByClassName('team-form-field')[0].value;
				compute = teamForms[i].getElementsByClassName('team-form-compute')[0].checked
				saveString += '{"Match":{"id":' + id + ', "compute":' + compute + ', "date":"' + date + '", "time":"' + time + '", "field":"' + field + '", "round_id":"'+ round +'"}}';
				if(i<(teamForms.length-1)) saveString += ',';
			}
			saveString += ']';

			console.log(saveString);
			return saveString;

		}

		function sendScheduleMatches() {
			var button = $( '#send-schedule-matches' ).ladda();
			button.ladda( 'start' ); //Show loader in button

			var targeturl = '<?= $this->Html->url(); ?>'+'.json';
			sheduleZonesJson = outputJsonZones();
			$('#hidden-json').val(sheduleZonesJson);

			var formData = $('#schedule-matches-form').serializeArray();

			$.ajax({
				type: 'put',
				cache: false,
				url: targeturl,
				data: formData,
				dataType: 'json',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
					xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); //Porque algunos navegadores no lo setean y no se reconoce la petición como ajax
				},
				success: function(response) {
					if (response.content) {
						//Show sweetalert
						swal({
							title: 'OK',
							text: response.content,
							type: "success",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
					if (response.error) {
						swal({
							title: 'ERROR',
							text: response.error,
							type: "error",
							confirmButtonText: "<?= __('Ok') ?>"
						});
					}
				},
				error: function(e) {
					swal({
						title: 'ERROR',
						text: e.responseText.message,
						type: "error",
						confirmButtonText: "<?= __('Ok') ?>"
					});
				},
				complete: function(){
					button.ladda( 'stop' ); //Hide loader in button
				}
			});
		};
	</script>
<?php $this->end(); ?>




