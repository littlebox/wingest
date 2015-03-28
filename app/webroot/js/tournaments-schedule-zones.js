
var TournamentScheduleZones = {

	drdrZone: {

		setHandlers: function(){

			//Set listeners for drag an drop events
			[].forEach.call(document.querySelectorAll('.dd-item'), function(item){
				item.addEventListener('dragstart', TournamentScheduleZones.drdrZone.onDragStart);
				item.addEventListener('drop',function(){return true;})
			});
			
			[].forEach.call(document.querySelectorAll('ol.dd-list'), function(list){				
				list.addEventListener('drop',TournamentScheduleZones.drdrZone.onDropList)
				list.addEventListener('dragover',TournamentScheduleZones.drdrZone.onDragOver)
			});

		},

		onDragStart: function(ev){
			ev.dataTransfer.setData('idElement', ev.target.id); //set data to transfer, in this case, id of team
			ev.dataTransfer.setData('idParent', ev.target.parentNode.id); //set data to transfer, in this case, id of team
		},

		onDropList: function(ev){
			ev.preventDefault();
			var id = ev.dataTransfer.getData('idElement');
			var idParent = ev.dataTransfer.getData('idParent');
			
			var parentClass = (ev.target.children[0])?ev.target.children[0].className:''
			
			//if the target was the empty div 
			//remove it and append to parent list
			if(ev.target.className == 'dd-empty'){
				parent = ev.target.parentNode;
				parent.removeChild(ev.target);
				parent.appendChild(document.getElementById(id))
			
			}else if(ev.target.tagName == 'OL' && parentClass != 'dd-empty'){
				//if target is ol, append to it
				ev.target.appendChild(document.getElementById(id));
			}else if(ev.target.tagName == 'OL' && parentClass == 'dd-empty'){
				//if target is ol and has empty div, remove it and append li
				ev.target.removeChild(ev.target.children[0]);
				ev.target.appendChild(document.getElementById(id));
			}else if(ev.target.className == 'dd-handle'){
				ev.target.parentNode.parentNode.appendChild(document.getElementById(id));
			}

			if(document.getElementById(idParent).childElementCount == 0){
				document.getElementById(idParent).innerHTML = TournamentScheduleZones.drdrZone.divEmpty;
			}

			//FIX TEAM COUNT PER ZONE!
			TournamentScheduleZones.drdrZone.countTeams();

		},
		
		onDragOver: function(ev){
			ev.preventDefault();
		},

		countTeams: function(){
			[].forEach.call(document.querySelectorAll('ol.zone.dd-list'), function(list){
				list.parentNode.parentNode.parentNode.querySelector('.qty_teams').innerHTML = list.querySelectorAll('li').length
			})
		},
		
		divEmpty: '<div class="dd-empty"></div>',

	},

	init: function (){
		//TournamentScheduleZones.startUiNestable();
		
		TournamentScheduleZones.drdrZone.setHandlers();
		
	}

}
