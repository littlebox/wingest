<?php //debug($match)?>
<div class="spreadsheet">

	<div class="header">
		<div class="head-left">
			<div>Fecha 1</div>
			<div>22/02/15</div>
		</div>
		<div class="head-center zone-name"><?= __('GRUPO ').$match['Zone']['name']; ?></div>
		<div class="head-right">
			<div>Cancha 2</div>
			<div>13:30</div>
		</div>
	</div>

	<div class="flex fcenter" style="width:80%;">

		<div class="flex fcolumn fend">
			<div class="flex">
				<div class="team-name"><?= $match['TeamLocal']['name']?></div>
				<div class="team-goals"><span>4</span></div>
			</div>

			<div class="flex">
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
								<div class="last-name"><span><?= $match['TeamLocal']['Player'][$i]['last_name'];?></span>,&nbsp;<span class="first-name"><?= $match['TeamLocal']['Player'][$i]['name'];?></span></div>
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

			<div class="flex">
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
								<div class="last-name"><span><?= $match['TeamVisitor']['Player'][$i]['last_name'];?></span>,&nbsp;<span class="first-name"><?= $match['TeamVisitor']['Player'][$i]['name'];?></span></div>
							<?php endif;?>
						</div>
					<?php endfor;?>
				</div>
			</div>

		</div>

	</div>

	<div>
		<div class="flex fcenter">

			<div class="flex fcolumn fend" style="width:100%">
				<div class="flex-table" style="width:100%">
					<div class="flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
					</div>

					<div class="flex-row flex " style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
					</div>

				</div>
			</div>

			<div class="flex fcolumn fstart" style="width:100%">
				<div class="flex-table" style="width:100%">

					<div class="flex-row flex" style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
					</div>

					<div class="flex-row flex" style="justify-content:space-around">
						<div>
							<label>DT:</label>
							<input type="text">
						</div>
						<div>
							<label>DNI:</label>
							<input type="text">
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</div>
<?php
	echo $this->Html->css('matches-view');
?>