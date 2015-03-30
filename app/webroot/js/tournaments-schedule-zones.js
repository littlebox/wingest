
var TournamentScheduleZones = {

	startUiSortable: function () {
		$( ".dd-list-teams" ).sortable({
			connectWith: ".dd-list",
			placeholder: "dd-placeholder"
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
				}
			}
		}).disableSelection();
	},



	init: function (){
		TournamentScheduleZones.startUiSortable();
	}

}
