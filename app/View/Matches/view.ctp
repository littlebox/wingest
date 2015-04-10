<?php //debug($match)?>
<div class="spreadsheet">

	<div class="header">
		<div class="head-left">
			<div class="date-name">Fecha</div>
			<?php if(!empty($match['Match']['time'])):?>
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
					<div class="time"><?php echo(date('H:i',strtotime($match['Match']['time'].' +55 minutes')))?></div>
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

		<div class="flex fcolumn fend">
			<div class="flex">
				<div class="team-name"><?= $match['TeamLocal']['name']?></div>
				<div class="team-goals"><span>4</span></div>
			</div>

			<div class="flex fcenter">
				<div class="team-shirt">
					<div>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
						<g>
							<path class="color-sample" fill="<?= $match['TeamLocal']['main_shirt_color']?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
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
					<?php for($i=0,$n=$match['Zone']['Tournament']['players_per_team'];$i<$n;$i++):?>
						<div class="flex-row player right" style="width:100%">
							<?php if(isset($match['TeamLocal']['Player'][$i]) && $match['TeamLocal']['Player'][$i]['last_name'] != ''):?>
								<div class="names">
									<span class="last-name"><?= $match['TeamLocal']['Player'][$i]['last_name'];?></span>,&nbsp;<span class="first-name"><?= $match['TeamLocal']['Player'][$i]['name'];?></span></div>
								<div class="player-number"><input type="text" placeholder="NRO"></div>
							<?php endif;?>
						</div>
					<?php endfor;?>
				</div>
			</div>

		</div>

		<div class="flex fcolumn fstart">
			<div class="flex">
				<div class="team-goals"><span>4</span></div>
				<div class="team-name"><?= $match['TeamVisitor']['name']?></div>
			</div>

			<div class="flex fcenter">
				<div class="team-color-input"><input type="text" name="color" placeholder="color"></div>
				<div class="team-shirt">
					<div>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="60px" height="60px" viewBox="0 0 30 30" enable-background="new 0 0 30 30" xml:space="preserve">
						<g>
							<path class="color-sample" fill="<?= $match['TeamVisitor']['main_shirt_color']?>" d="M27.395,11.296h-4.271c-0.445,0-0.846,0.385-0.846,0.86v13.554H7.692V12.157
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
					<?php for($i=0,$n=$match['Zone']['Tournament']['players_per_team'];$i<$n;$i++):?>
						<div class="flex-row player left" style="width:100%">
							<?php if(isset($match['TeamVisitor']['Player'][$i]) && $match['TeamVisitor']['Player'][$i]['last_name'] != ''):?>
								<div class="player-number"><input type="text" placeholder="NRO"></div>
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

				<div class="flex fcenter hundredp">

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input class="nro" type="text" placeholder="NRO">
							<input class="goal" type="text">
							<input class="red" type="text">
							<input class="yellow" type="text">
						</div>
						<?php endfor;?>
					</div>

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input class="nro" type="text" placeholder="NRO">
							<input class="goal" type="text">
							<input class="red" type="text">
							<input class="yellow" type="text">
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

				<div class="flex fcenter hundredp">

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input class="nro" type="text" placeholder="NRO">
							<input class="goal" type="text">
							<input class="red" type="text">
							<input class="yellow" type="text">
						</div>
						<?php endfor;?>
					</div>

					<div class="goals-bookings flex fcolumn fcenter">
						<?php for($i=0;$i<5;$i++):?>
						<div>
							<input class="nro" type="text" placeholder="NRO">
							<input class="goal" type="text">
							<input class="red" type="text">
							<input class="yellow" type="text">
						</div>
						<?php endfor;?>
					</div>

				</div>

			</div>

		</div>

		<div class="referee flex fcolumn fcenter">
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
</div>
<?php
	echo $this->Html->css('matches-view');
?>