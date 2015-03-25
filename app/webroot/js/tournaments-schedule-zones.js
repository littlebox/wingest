var TournamentScheduleZones = {

	//Validations
	setDragDropSettings: function(){
		/* VARIABLES YOU COULD MODIFY */
		boxSizeArray = maxTeamsPerGroupArray;	// Array indicating how many items there is rooom for in the right column ULs
		verticalSpaceBetweenListItems = 3;	// Pixels space between one <li> and next
												// Same value or higher as margin bottom in CSS for #dhtmlgoodies_dragDropContainer ul li,#dragContent li
		indicateDestionationByUseOfArrow = false;	// Display arrow to indicate where object will be dropped(false = use rectangle)
		cloneSourceItems = false;	// Items picked from main container will be cloned(i.e. "copy" instead of "cut").
		cloneAllowDuplicates = false;	// Allow multiple instances of an item inside a small box(example: drag Student 1 to team A twice
	},


	init: function (){
		TournamentScheduleZones.setDragDropSettings();
		initDragDropScript();
	}

}
