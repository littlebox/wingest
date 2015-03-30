
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

			document.getElementById('sortRandom').addEventListener('click',TournamentScheduleZones.drdrZone.sortRandom)

		},

		onDragStart: function(ev){
			ev.dataTransfer.setData('idElement', ev.target.id); //set data to transfer, in this case, id of team
			ev.dataTransfer.setData('idParent', ev.target.parentNode.parentNode.id); //set data to transfer, in this case, id of team
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

			if(idParent != '' && document.getElementById(idParent).childElementCount <= 1){
				document.getElementById(idParent).children[0].innerHTML = TournamentScheduleZones.drdrZone.divEmpty;
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
		
		sortRandom: function(){

			var zones = document.querySelectorAll('ol.zone');
			var qtyZones = zones.length - 1;
			var k = 0;

			var items = [].slice.call(document.querySelectorAll('.dd-item'),0);

			for (var i = items.length - 1; i > 0; i--) {
		        var j = Math.floor(Math.random() * (i + 1));
		        
		        var temp = items[i];
		        items[i] = items[j];
		        items[j] = temp;

		        zones[k].appendChild(items[i]);
				(k != qtyZones) ? k++ : k=0;

		    }

			if(document.querySelectorAll('.dd-empty').length != 0){
				[].forEach.call(document.querySelectorAll('.dd-empty'),function(dd){
					dd.parentNode.removeChild(dd);
				})
			}

			TournamentScheduleZones.drdrZone.countTeams();
		},

		divEmpty: '<div class="dd-empty"></div>',

	},

	init: function (){
		//TournamentScheduleZones.startUiNestable();
		
		TournamentScheduleZones.drdrZone.setHandlers();
		
	}

}
