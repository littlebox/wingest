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
				form.submit();
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
		scantcl = document.getElementById('TournamentQualifyingTeamsPerGroup');

		scanteq.addEventListener('change',function(){
			canteq = $(scanteq).val() ;
			cantgrupos(canteq)
		})

		scantgr.addEventListener('change',function(){
			cantgr = scantgr.querySelectorAll('option')[scantgr.selectedIndex].getAttribute('value') ;
			cantequiposclasifican(canteq,cantgr)
		})

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
		}

		cantequiposclasifican = function(canteq,cantgr){
			scantcl.innerHTML = '';

			for( i=1; i < canteq/cantgr; i++){ // recorro los equipos desde 1 hasta todos menos uno
				canteqcl = cantgr * i; // cant de eq que clasifican

				option = document.createElement('option');
				option.setAttribute('value', i);
				option.textContent = i;

				if((canteqcl & (canteqcl - 1)) == 0){ //comprueba si es potencia de 2. Lo vienen usando asi desde que se invento la computadora
					scantcl.appendChild(option)
				}else{
					option.textContent += ' - Clasifican los mejores '+ (i+1) +'º?'
					scantcl.appendChild(option)
				}

			}

		}


		function factorial(num){
			var rval=1;
			for (var i = 2; i <= num; i++)
				rval = rval * i;
			return rval;
		}

	}

}
