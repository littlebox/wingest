
var TournamentScheduleZones = {

	startUiSortable: function () {
		$( ".dd-list-teams" ).sortable({
			connectWith: ".dd-list",
			placeholder: "dd-placeholder",
			receive: function(ev,ui){
				TournamentScheduleZones.count(ui.sender,this)
			},
		}).disableSelection();

		$( ".dd-list-zone" ).sortable({
			connectWith: ".dd-list",
			placeholder: "dd-placeholder",
			receive: function(event, ui) {

				// if atempt to add more teams than permitted per zone, the drag and drop will be canceled
				if ($(this).children().length > equiposPorZona) {
					//ui.sender: will cancel the change.
					//Useful in the 'receive' callback.
					$(ui.sender).sortable('cancel');
				}else{
					TournamentScheduleZones.count(ui.sender,this);
					TournamentScheduleZones.disableMatchButtons();
				}

			}
		}).disableSelection();
	},

	//counts the number of teams in each list
	count: function(from,to){
		$(from).parent().parent().parent().find('.qty_teams').html($(from).get(0).childElementCount);
		$(to).parent().parent().parent().find('.qty_teams').html($(to).get(0).childElementCount)
	},

	disableMatchButtons: function(){
		$('#generate-zone-matches,#generate-playoff-matches').attr('disabled','disabled');
	},

	enableMatchButtons: function(){
		$('#generate-zone-matches,#generate-playoff-matches').removeAttr('disabled');
	},

	init: function (){
		TournamentScheduleZones.startUiSortable();
	}

}
