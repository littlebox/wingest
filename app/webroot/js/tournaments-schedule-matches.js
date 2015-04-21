
var TournamentScheduleMatches = {

	handleDatePickers: function () {

		if (jQuery().datepicker) {
			$('.date-picker').datepicker({
				rtl: Metrobox.isRTL(),
				language: 'es',
				format: 'dd/mm/yyyy',
				orientation: "left",
				autoclose: true
			});
			//$('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
		}
		/* Workaround to restrict daterange past date select: http://stackoverflow.com/questions/11933173/how-to-restrict-the-selectable-date-ranges-in-bootstrap-datepicker */
	},

	handleTimePickers: function () {

		if (jQuery().timepicker) {

			$('.timepicker-24').timepicker({
				autoclose: true,
				minuteStep: 5,
				showSeconds: false,
				showMeridian: false,
				defaultTime: false
			});

			// handle input group button click
			$('.timepicker').parent('.input-group').on('click', '.input-group-btn', function(e){
				e.preventDefault();
				$(this).parent('.input-group').find('.timepicker').timepicker('showWidget');
			});
		}
	},

	setSelectsOnRoundChange: function(){
		$('.team-form-round-selector').on('change',function(ev){
			val = $(this).val();
			id = $(this).data('id');

			if(LocalVar.RoundDates[val].select == undefined){
				var select = document.createElement('select')
				for(var i = 0, n = LocalVar.RoundDates[val].dates.length; i < n; i++ ){
					var opt = document.createElement('option');
					select.appendChild(opt)
					opt.setAttribute('value',LocalVar.RoundDates[val].dates[i]);
					opt.textContent = LocalVar.RoundDates[val].dates[i];
					LocalVar.RoundDates[val].select = select;
				}
			}

			$('#round-dates-selector-'+id).html(LocalVar.RoundDates[val].select);
		})
	},

	init: function (){
		TournamentScheduleMatches.handleDatePickers();
		TournamentScheduleMatches.handleTimePickers();
		TournamentScheduleMatches.setSelectsOnRoundChange();
	}

}
