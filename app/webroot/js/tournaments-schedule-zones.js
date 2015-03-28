
var TournamentScheduleZones = {

	startUiNestable: function () {
		$('.dd').nestable({
			group: 1,
			maxDepth: 1
		});
	},


	init: function (){
		TournamentScheduleZones.startUiNestable();
	}

}
