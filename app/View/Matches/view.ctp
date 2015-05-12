<?php
	// debug($match);
?>

<div class="portlet light">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-futbol-o"></i>
			<span class="caption-subject bold uppercase">
				<?= __('Spreadsheet') ?>
			</span>
		</div>
		<div class="actions">
			<button type="button" onClick="sendViewMatches();" id="send-view-matches" class="btn btn-circle green-haze ladda-button" data-style="zoom-out" type="submit"><span class="ladda-label"><?= __('Save') ?></span></button>
		</div>
	</div>
</div>

<div class="spreadsheet">

	<div class="header">
		<div class="head-left">
			<div class="date-name">Fecha</div>
			<?php if(!empty($match['Match']['date'])):?>
			<div class="date"><?= date('j/n/Y',strtotime($match['Match']['date']))?></div>
			<?php else:?>
			<div class="date">Fecha no asignada!</div>
			<?php endif;?>
		</div>
		<div class="head-center zone-name"><?= __('GRUPO ').$match['Zone']['name']; ?></div>
		<div class="head-right">
			<div class="field"><?php echo(!empty($match['Match']['field'])? 'Cancha '.$match['Match']['field'] : 'Cancha no asignada!');?></div>

			<?php if(!empty($match['Match']['time'])):?>
			<div class="time"><?php echo(date('H:i',strtotime($match['Match']['time'])));?></div>
			<div class="time-label">hora real de comienzo</div>
			<div class="time-details flex">
				<div class="flex fcolumn" style="flex: 1">
					<div class="time"><?php echo(date('H:i',strtotime($match['Match']['time'].' +10 minutes')))?></div>
					<div class="time"><?php echo(date('H:i',strtotime($match['Match']['time'].' +65 minutes')))?></div>
				</div>
				<div class="flex fcolumn fend" style="flex: 3">
					<div>inicio máximo</div>
					<div>fin máximo</div>
				</div>
			</div>
			<?php else:?>
			<div class="time">Hora no asignada!</div>
			<?php endif;?>

		</div>
	</div>

	<div class="players-list flex fcenter" style="width:80%;">

		<div class="flex fcolumn fend local">
			<div class="flex">
				<div class="team-name"><?= $match['TeamLocal']['name']?></div>
				<div class="team-goals"><span></span></div>
			</div>

			<div class="flex fcenter">
				<div class="team-shirt">
					<div>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
						<g>
							<path class="color-sample" stroke="#000" stroke-width="1px" fill="<?= $match['TeamLocal']['main_shirt_color']?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
								c0-0.476-0.368-0.86-0.845-0.86h-4.24L1.408,6.733l9.436-2.444c0.338,0.753,0.875,1.368,1.629,1.844
								c0.753,0.477,1.598,0.707,2.535,0.707c0.922,0,1.752-0.23,2.506-0.707c0.754-0.476,1.307-1.09,1.645-1.844l9.436,2.444
								L27.395,11.296z"/>
						</g>
						</svg>
					</div>
				</div>

				<div class="team-color-input"><input type="text" name="color" placeholder="color"></div>
			</div>

			<div class="flex fcolumn" style="width:100%">
				<div class="flex-table">
					<?php for($i=0,$n=$match['Zone']['Tournament']['players_per_team'];$i<$n;$i++):
						$playerId = $match['TeamLocal']['Player'][$i]['id'];
						$shirtNumber = isset($match['PlayersShirtNumber'][$playerId])? $match['PlayersShirtNumber'][$playerId]['shirt_number'] : '';
						$playerShirtNumberId = isset($match['PlayersShirtNumber'][$playerId])? $match['PlayersShirtNumber'][$playerId]['id'] : '';
					?>
						<div class="flex-row player right" style="width:100%" data-id="<?= $playerId ?>" data-playerShirtNumber-id="<?= $playerShirtNumberId ?>">
							<?php if(isset($match['TeamLocal']['Player'][$i]) && $match['TeamLocal']['Player'][$i]['last_name'] != ''):?>
								<div class="names">
									<span class="last-name"><?= $match['TeamLocal']['Player'][$i]['last_name'];?></span>,&nbsp;<span class="first-name"><?= $match['TeamLocal']['Player'][$i]['name'];?></span>
								</div>
							<?php endif;?>
							<div class="local-team player-number">
								<input title="<?= __('Número de camiseta')?>" value="<?= $shirtNumber ?>" id="player-<?=$i?>-number" class="player-number-<?= $match['TeamLocal']['Player'][$i]['id'] ?>" type="text" placeholder="">
							</div>
						</div>
					<?php endfor;?>
				</div>
			</div>

		</div>

		<div class="flex fcolumn fstart visitor">
			<div class="flex">
				<div class="team-goals"><span></span></div>
				<div class="team-name"><?= $match['TeamVisitor']['name']?></div>
			</div>

			<div class="flex fcenter">
				<div class="team-color-input"><input type="text" name="color" placeholder="color"></div>
				<div class="team-shirt">
					<div>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
						<g>
							<path class="color-sample" stroke="#000" stroke-width="1px" fill="<?= $match['TeamVisitor']['main_shirt_color']?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
								c0-0.476-0.368-0.86-0.845-0.86h-4.24L1.408,6.733l9.436-2.444c0.338,0.753,0.875,1.368,1.629,1.844
								c0.753,0.477,1.598,0.707,2.535,0.707c0.922,0,1.752-0.23,2.506-0.707c0.754-0.476,1.307-1.09,1.645-1.844l9.436,2.444
								L27.395,11.296z"/>
						</g>
						</svg>
					</div>
				</div>
			</div>

			<div class="flex fcolumn" style="width:100%">
				<div class="flex-table">
					<?php for($i=0,$n=$match['Zone']['Tournament']['players_per_team'];$i<$n;$i++):
						$playerId = $match['TeamVisitor']['Player'][$i]['id'];
						$shirtNumber = isset($match['PlayersShirtNumber'][$playerId])? $match['PlayersShirtNumber'][$playerId]['shirt_number'] : '';
						$playerShirtNumberId = isset($match['PlayersShirtNumber'][$playerId])? $match['PlayersShirtNumber'][$playerId]['id'] : '';
					?>
						<div class="flex-row player left" style="width:100%" data-id="<?= $playerId ?>" data-playerShirtNumber-id="<?= $playerShirtNumberId ?>">
							<div class="visitor-team player-number"><input title="<?= __('Número de camiseta')?>" id="player-<?=$i?>-number" value="<?= $shirtNumber ?>" class="player-number-<?= $match['TeamVisitor']['Player'][$i]['id'] ?>" type="text" placeholder=""></div>
							<?php if(isset($match['TeamVisitor']['Player'][$i]) && $match['TeamVisitor']['Player'][$i]['last_name'] != ''):?>
								<div class="names">
									<span class="last-name"><?= $match['TeamVisitor']['Player'][$i]['last_name'];?></span>,&nbsp;<span class="first-name"><?= $match['TeamVisitor']['Player'][$i]['name'];?></span>
								</div>
							<?php endif;?>
						</div>
					<?php endfor;?>
				</div>
			</div>

		</div>

	</div>

	<div>
		<div class="flex fstart">

			<div class="flex fcolumn fend hundredp">
				<div class="flex-table hundredp">
					<div class="dt-fields flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
						<div>
							<input class="signature" type="text" placeholder="firma">
						</div>
					</div>

					<div class="dt-fields flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
						<div>
							<input class="signature" type="text" placeholder="firma">
						</div>
					</div>
				</div>

				<div class="flex local-team fcenter hundredp">

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input title="<?= __('Número de camiseta')?>" readonly="readonly" class="nro" type="text" placeholder="">
							<input title="<?= __('Cantidad de goles')?>" class="goal" type="text">
							<input title="<?= __('Cantidad de tarjetas amarillas')?>" readonly="readonly" class="yellow" type="text">
							<input title="<?= __('Cantidad de tarjetas rojas')?>" readonly="readonly" class="red" type="text">
						</div>
						<?php endfor;?>
					</div>

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input title="<?= __('Número de camiseta')?>" readonly="readonly" class="nro" type="text" placeholder="">
							<input title="<?= __('Cantidad de goles')?>" class="goal" type="text">
							<input title="<?= __('Cantidad de tarjetas amarillas')?>" readonly="readonly" class="yellow" type="text">
							<input title="<?= __('Cantidad de tarjetas rojas')?>" readonly="readonly" class="red" type="text">
						</div>
						<?php endfor;?>
					</div>

				</div>

			</div>

			<div class="flex fcolumn fstart hundredp">
				<div class="flex-table hundredp">
					<div class="dt-fields flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
						<div>
							<input class="signature" type="text" placeholder="firma">
						</div>
					</div>

					<div class="dt-fields flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
						<div>
							<input class="signature" type="text" placeholder="firma">
						</div>
					</div>
				</div>

				<div class="flex visitor-team fcenter hundredp">

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input title="<?= __('Número de camiseta')?>" readonly="readonly" class="nro" type="text" placeholder="">
							<input title="<?= __('Cantidad de goles')?>" class="goal" type="text">
							<input title="<?= __('Cantidad de tarjetas amarillas')?>" readonly="readonly" class="yellow" type="text">
							<input title="<?= __('Cantidad de tarjetas rojas')?>" readonly="readonly" class="red" type="text">
						</div>
						<?php endfor;?>
					</div>

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input title="<?= __('Número de camiseta')?>" readonly="readonly" class="nro" type="text" placeholder="">
							<input title="<?= __('Cantidad de goles')?>" class="goal" type="text">
							<input title="<?= __('Cantidad de tarjetas amarillas')?>" readonly="readonly" class="yellow" type="text">
							<input title="<?= __('Cantidad de tarjetas rojas')?>" readonly="readonly" class="red" type="text">
						</div>
						<?php endfor;?>
					</div>

				</div>

			</div>

		</div>

		<div class="referee flex fcolumn fcenter">
			<div class="own-goal-button-container">
				<input title="<?= __('Seleccionar para agregar goles en contra')?>" type="checkbox" class="own-goal-button"><br>Gol en contra
			</div>
			<div class="referee-name">árbitro</div>
			<div><input type="text"></div>
		</div>

		<div class="flex fstart">
			<div class="referee-score flex fcenter hundredp">
				<div class="flex fcenter"><div>01</div></div>
				<div class="flex fcenter"><div>02</div></div>
				<div class="flex fcenter"><div>03</div></div>
				<div class="flex fcenter"><div>04</div></div>
				<div class="flex fcenter"><div>05</div></div>
			</div>
			<div class="referee-score flex fcenter hundredp">
				<div class="flex fcenter"><div>01</div></div>
				<div class="flex fcenter"><div>02</div></div>
				<div class="flex fcenter"><div>03</div></div>
				<div class="flex fcenter"><div>04</div></div>
				<div class="flex fcenter"><div>05</div></div>
			</div>
		</div>

		<div class="flex fcenter hundredp">
			<div class="signatures flex fcolumn">
				<input type="text" class="signature">
				<div class="signature-label">firma capitán</div>
			</div>

			<div class="signatures flex fcolumn">
				<input type="text" class="signature">
				<div class="signature-label">firma planillero</div>
			</div>

			<div class="signatures flex fcolumn">
				<input type="text" class="signature">
				<div class="signature-label">firma árbitro</div>
			</div>

			<div class="signatures flex fcolumn">
				<input type="text" class="signature">
				<div class="signature-label">firma capitán</div>
			</div>
		</div>

		<div class="flex fspacearound">
			<div class="frow flex fstart">
				<div>observaciones:</div>
			</div>
			<div class="frow flex fend">
				<div class="logo"></div>
			</div>
		</div>

	</div>

	<form id="formSendMatch">
		<input type="hidden" name="jsonData">
	</form>

</div>

<?php
	$this->append('pageStyles');
		echo $this->Html->css('matches-view');
		echo $this->Html->css('/plugins/bootstrap-buttons-loader/dist/ladda-themeless.min');
		echo $this->Html->css('/plugins/sweetalert/lib/sweet-alert');
	$this->end();

	$this->append('pagePlugins');
		echo $this->Html->script('/plugins/bootstrap-buttons-loader/dist/spin.min');
		echo $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.min');
		echo $this->Html->script('/plugins/bootstrap-buttons-loader/dist/ladda.jquery.min');
		echo $this->Html->script('/plugins/sweetalert/lib/sweet-alert.min');
		echo $this->Html->script('matches-view');
	$this->end();
?>

<?php $this->append('pageScripts'); ?>
<script type="text/javascript">

	/*jQuery(document).ready(function() {
		MatchesView.init();
	});*/

	document.addEventListener('DOMContentLoaded',function() {
		MatchesView.data = {
			'goalsByPlayer': <?= json_encode($match['GoalsByPlayer']);?>,
			'bookingsByPlayer': <?= json_encode($match['BookingsByPlayer']);?>,
		};
		MatchesView.init();
	});

	function sendViewMatches() {
		var button = $( '#send-view-matches' ).ladda();
		button.ladda( 'start' ); //Show loader in button

		var targeturl = '<?= $this->Html->url(); ?>'+'.json';
		var matchId = '<?= $match["Match"]["id"]?>';

		MatchesView.save();

		var playersNumber = [];
		var goal = [];
		var booking = [];

		setJSONPlayer = function(player){
			playersNumber.push({
				'player_id':k,
				'shirt_number':player.number,
				'match_id':matchId,
				'id': player.playerShirtNumberId,
			})
			if(player.goals.ownGoals != 0){
				for(var i = 1, n = player.goals.ownGoals; i <= n; i++){
					goal.push({
						'player_id': k,
						'own_goal': true,
					})
				}
			}
			if(player.goals.normalGoals != 0){
				for(var i = 1, n = player.goals.normalGoals; i <= n; i++){
					goal.push({
						'player_id': k,
						'own_goal': false,
					})
				}
			}

			if(player.bookings.yellow != 0){
				for(var i = 1, n = player.bookings.yellow; i <= n; i++){
					booking.push({
						'player_id': k,
						'booking_type_id': 1, //Booking type yellow
					})
				}
			}

			if(player.bookings.red != 0){
				for(var i = 1, n = player.bookings.red; i <= n; i++){
					booking.push({
						'player_id': k,
						'booking_type_id': 2, //Booking type red
					})
				}
			}
		}

		for(k in MatchesView.Players.Local){
			if(MatchesView.Players.Local.hasOwnProperty(k) && typeof(MatchesView.Players.Local[k].number) != "undefined"){
				setJSONPlayer(MatchesView.Players.Local[k])
			}
		}

		for(k in MatchesView.Players.Visitor){
			if(MatchesView.Players.Visitor.hasOwnProperty(k) && typeof(MatchesView.Players.Visitor[k].number) != "undefined"){
				setJSONPlayer(MatchesView.Players.Visitor[k])
			}
		}

		var goals_team1 = parseInt(document.querySelector('div.local div.team-goals span').textContent)
		var goals_team2 = parseInt(document.querySelector('div.visitor div.team-goals span').textContent)

		document.querySelector('input[name="jsonData"]').value = JSON.stringify({'Match':{'id': matchId, 'goals_team1':goals_team1, 'goals_team2':goals_team2}, 'PlayersShirtNumber': playersNumber, 'Goal': goal, 'Booking':booking});

		$.ajax({
			type: 'put',
			cache: false,
			url: targeturl,
			data: $('form#formSendMatch').serializeArray(),
			dataType: 'json' ,
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
<?php $this->end();?>