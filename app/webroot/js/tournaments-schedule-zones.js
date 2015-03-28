
var TournamentScheduleZones = {

	startUiNestable: function () {
		// activate Nestable for list 1
		[].forEach.call(document.querySelectorAll('.sortable-list'),function(sl){
			$(sl).nestable({
				group: 1,
				maxDepth: 1,
			})
		})
	},


	init: function (){
		TournamentScheduleZones.startUiNestable();
	}

}
