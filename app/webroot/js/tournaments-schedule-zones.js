
var TournamentScheduleZones = {

	startUiNestable: function () {
		// activate Nestable for dd
			$('.dd').nestable({
				group: 1, //because otherwise, it won't work :|. It's like black magic.
				maxDepth: 1,
			})
	},


	init: function (){
		//TournamentScheduleZones.startUiNestable();
		
		[].forEach.call(document.querySelectorAll('.dd-item'), function(item){
			item.addEventListener('dragstart',function(ev){
				ev.dataTransfer.setData('el-id', ev.target.id);
				console.log('drag start')
			})
		});
		
		[].forEach.call(document.querySelectorAll('ol.dd-list'), function(list){
			
			list.addEventListener('drop',function(ev){
				ev.preventDefault();
   				console.log('drop?');
    			var id = ev.dataTransfer.getData('el-id');
   				ev.target.appendChild(document.getElementById(id));
   			})

			list.addEventListener('dragover',function(ev){ev.preventDefault();})
		});
	}

}
