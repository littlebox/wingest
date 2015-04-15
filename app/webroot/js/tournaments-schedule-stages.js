var TournamentScheduleStages = {

	//Validations
	validateTournament: function(){
		var thisForm = $('#tournament-form');

		thisForm.validate({
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			rules: {
				'data[Tournament][number_of_teams]': {
					required: true
				},
				'data[Tournament][number_of_zones]': {
					required: true
				},
				'data[Tournament][qualifying_teams_per_group]': {
					required: true
				}
			},

			invalidHandler: function(event, validator) { //display error alert on form submit
				//$('.alert-danger', $('.login-form')).show();
			},

			highlight: function(element) { // hightlight error inputs
				$(element)
					.closest('.form-group').addClass('has-error'); // set error class to the control group
			},

			success: function(label) {
				label.closest('.form-group').removeClass('has-error');
				label.remove();
			},

			errorPlacement: function(error, element) {
				if (element.attr('id') == 'profile_picture') {
					error.insertAfter('.fileinput.fileinput-exists');
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {
				var	msg;
				var	showAlert = false;
				var	emptyPlayoffName = false;
				var totalCountTeamsPerPlayoff = 0;
				var totalCountTeamsPerPlayoffIsGreaterThanTeamsPerTournament = false;

				//This is because we want to know if the Gera changed the number of playoffs associated to the tournament,
				//then we set it in a hidden field on form for read on server side.
				$('#TournamentPlayoffsNumberChanged').val(Localvar.playoffNumberChanged.toString());

				$('.form-playoff-name').each(function(k,v){
					if($(v).val() == ''){
						emptyPlayoffName = true;
						msg = 'Hay torneos sin nombre'
					}
				})

				$('.form-playoff-number-of-teams').each(function(k,v){
					totalCountTeamsPerPlayoff += parseInt($(v).val());
				})

				if( totalCountTeamsPerPlayoff > parseInt($('#TournamentNumberOfTeams').val())){
					totalCountTeamsPerPlayoffIsGreaterThanTeamsPerTournament = true;
					msg = 'Hay mas equipos que clasifican que equipos inscriptos!!!'
				}

				if(emptyPlayoffName || totalCountTeamsPerPlayoffIsGreaterThanTeamsPerTournament){
					swal({
						title: 'Gera, sos boludo?',
						text: msg,
						type: 'warning',
						showCancelButton: false,
						confirmButtonText: "Si",
					})
					return false;
				}

				if(($('#TournamentNumberOfZones').val() != $('#TournamentActualNumberOfZones').val() && $('#TournamentActualNumberOfZones').val() != 0) && ($('#TournamentNumberOfPlayoffs').val() != $('#TournamentActualNumberOfPlayoffs').val() && $('#TournamentActualNumberOfPlayoffs').val() != 0)){
					showAlert = true;
					msg = 'las zonas y los playoffs';
				}else if($('#TournamentNumberOfZones').val() != $('#TournamentActualNumberOfZones').val() && $('#TournamentActualNumberOfZones').val() != 0){
					showAlert = true;
					msg = 'las zonas';
				}else if(($('#TournamentNumberOfPlayoffs').val() != $('#TournamentActualNumberOfPlayoffs').val() || Localvar.playoffNumberChanged) && $('#TournamentActualNumberOfPlayoffs').val() != 0){
					showAlert = true;
					msg = 'los playoffs';
				}


				if(showAlert){
					swal({
						title: '\'Tas seguro Gera?',
						text: 'Mirá que se van a borrar '+msg+' que creaste antes en este torneo!',
						type: 'warning',
						showCancelButton: true,
						confirmButtonText: "Si",
					},
					function(){form.submit();})
				}else{form.submit()}
			}
		});

		//Make for submitable by press enter
		thisForm.find('input').keypress(function(e) {
			if (e.which == 13) {
				if (thisForm.validate().form()) {
					thisForm.submit();
				}
				return false;
			}
		});
	},


	init: function (){
		TournamentScheduleStages.validateTournament();
		TournamentScheduleStages.addHandlers();
	},

	addHandlers: function(){

		var canteq;
		var cantgr;

		scanteq = document.getElementById('TournamentNumberOfTeams');
		scantgr = document.getElementById('TournamentNumberOfZones');
		//scantcl = document.getElementById('TournamentQualifyingTeamsPerGroup');
		scantpl = document.getElementById('TournamentNumberOfPlayoffs');

		scanteq.addEventListener('input',function(){
			canteq = $(scanteq).val() ;
			cantgrupos(canteq)
		})

		scantgr.addEventListener('input',function(){
			cantgr = scantgr.querySelectorAll('option')[scantgr.selectedIndex].getAttribute('value') ;
			//cantequiposclasifican(canteq,cantgr)
		})

		scantpl.addEventListener('input',function(){
			cantpl = scantpl.querySelectorAll('option')[scantpl.selectedIndex].getAttribute('value') ;
			schedulePlayoffs(cantpl)
		})

		$(document).ready(function(){
			if(canteq = $(scanteq).val()){
				cantgrupos(canteq);
				if(savednumberofzones = $('#TournamentActualNumberOfZones').val()){
					$('#TournamentNumberOfZones').val(savednumberofzones);
				}
			}
		});

		//funciones
		cantgrupos = function(canteq){
			scantgr.innerHTML = '';
			entro = false;

			for(i=2;i<canteq;i++){
				if(canteq % i == 0){
					entro = true;
					option = document.createElement('option');
					option.setAttribute('value', i);
					option.textContent = i+' grupos de '+ canteq/i +' equipos';
					if((canteq/i)%2 != 0){
						option.textContent += ' (equipos con fecha libre!)'
					}
					scantgr.appendChild(option)
				}
			}

			if(!entro){
				option = document.createElement('option');
				option.textContent = 'Numeros primos NO. No puedo armar grupos asi. La concha de la lora!';
				scantgr.appendChild(option)
			}

			scantpl.removeAttribute('disabled')

		};

		schedulePlayoffs = function(cantpl){

			Localvar.playoffNumberChanged = true;

			playoffContainer = document.querySelector('.playoff-portlet-container');

			playoffContainer.innerHTML = '';

			portletHtml = function(i){
				var s;
				s = '<div id="cup'+i+'" class="portlet box red-soft"><div class="portlet-title"><div class="caption"><i class="fa fa-lg fa-trophy"></i><input name="data[Playoff]['+i+'][name]" class="portlet-title-input form-playoff-name" type="text" placeholder="(Nombre del torneo)"></div></div><div class="portlet-body form"></div></div>';
				return s;
			}

			numberTeamsPlayoffsSlider = function(j){
				var s;
				s='<select class="form-control form-playoff-number-of-teams" name="data[Playoff]['+j+'][number_of_teams]">';
				for(var i=2;i<canteq;i = i*2){
					s += '<option value="'+i+'">'+i+'</option>';
				}
				s += '</select>';
				return s;
			}

			for(var i = 0; i < cantpl; i++){
				playoffContainer.innerHTML += portletHtml(i);

				select = numberTeamsPlayoffsSlider(i);

				playoffContainer.querySelector('#cup'+i+' .portlet-body').innerHTML = '<div class="playoffField"><div class="form-group"><label class="control-label col-md-6">Equipos que clasifican</label><div class="col-md-6">'+select+'</div></div></div><div class="form-group"><label for="" class="control-label col-md-6">Home and away matches</label><div class="col-md-6"><input name="data[Playoff]['+i+'][home_and_away_matches]" value=0 type="hidden"><input class="form-playoff-home-and-away-matches" name="data[Playoff]['+i+'][home_and_away_matches]" type="checkbox"></div></div>'

			}

		},


		//if change the number of teams that qualify in any cup,
		$('.form-playoff-number-of-teams, .form-playoff-home-and-away-matches').on('change', function(){
			Localvar.playoffNumberChanged = true;
		})

		$('').on('change', function(){
			Localvar.playoffNumberChanged = true;
		})


		function factorial(num){
			var rval=1;
			for (var i = 2; i <= num; i++)
				rval = rval * i;
			return rval;
		}

	}

}
