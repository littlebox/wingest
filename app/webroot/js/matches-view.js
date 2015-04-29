MatchesView = {

	Players: {
			Local: {},
			Visitor: {},
	},

	handleNumberListeners: function(){

		//List player input
		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Local',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id')))
		});
		[].forEach.call(document.querySelectorAll('.visitor-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Visitor',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id')))
		});

		//Goals and Bookings listeners
		[].forEach.call(document.querySelectorAll('.local-team .goals-bookings input.nro'), function(inp){
			inp.addEventListener('click', MatchesView.showSelect.bind(inp,'Local'))
		});

		[].forEach.call(document.querySelectorAll('.visitor-team .goals-bookings input.nro'), function(inp){
			inp.addEventListener('click', MatchesView.showSelect.bind(inp,'Visitor'))
		})
	},

	setPlayer: function(k,team,playerShirtNumberId,ev){

		if(!isNaN(ev.target.value) && ev.target.value > 0){

			//Create select if it doesn't exists
			if(typeof(MatchesView.Players[team].select) === "undefined"){
				MatchesView.Players[team].select = document.createElement('select');
			}

			//Create options array
			if(typeof(MatchesView.Players[team].opts) === "undefined"){
				MatchesView.Players[team].opts = [];
			}

			var select = MatchesView.Players[team].select;
			var opts = MatchesView.Players[team].opts;

			//Create player if it doesn't exists
			if(typeof(MatchesView.Players[team][k]) === "undefined"){
				MatchesView.Players[team][k] = {}
			}else{
				//Player exists, remove old option from select and array
				if(select.querySelector('.player-select-'+k) != null){
					select.removeChild(select.querySelector('.player-select-'+k))
				}
				opts.some(function(opt,i){
					if(opt.className == 'player-select-'+k){
						opts.splice(i,1);
						return true;
					}
				})
			}

			MatchesView.Players[team][k].number = ev.target.value;
			MatchesView.Players[team][k].playerShirtNumberId = playerShirtNumberId;
			var shirtNumber = MatchesView.Players[team][k].number

			if(this.parentNode.parentNode.querySelector('.names') != null && this.parentNode.parentNode.querySelector('.names').textContent.trim() != ''){
				var name = this.parentNode.parentNode.querySelector('.names').textContent.trim()
				name = name.replace(/\w+/,function(l){return l.toUpperCase()}) //All last name, before coma
				name = name.replace(/,\s+\w/,function(l){return l.toUpperCase()}) //First letter of name, after coma and space
			}else{
				name = '';
			}
			MatchesView.Players[team][k].name = name;

			var opt = document.createElement('option')
			opt.value = shirtNumber;
			opt.textContent = shirtNumber+' - '+name;
			opt.setAttribute('class','player-select-'+k);

			MatchesView.handleDuplicates()

			//if doesn't exists, add to array
			if(typeof(opts[shirtNumber])== "undefined" ){
				opts[shirtNumber] = opt;
			}

			//clear the select, and append option childs
			select.innerHTML = '';
			optFirst = document.createElement('option');
			optFirst.textContent = "Seleccionar jugador";
			select.appendChild(optFirst);

			opts.forEach(function(opt){
				select.appendChild(opt);
			})

		}else{
			ev.target.value = '';
		}

	},

	handleDuplicates: function(){

		var dupl = [];

		[].forEach.call(document.querySelectorAll('div.local-team input'),function(inp,k){
			if(inp.value != ""){
				if(typeof(dupl[inp.value]) == "undefined") dupl[inp.value] = []
				dupl[inp.value].push(inp);
				if(dupl[inp.value].length > 1){
					dupl[inp.value].forEach(function(inp){
						inp.classList.add('duplicate')
					})
				}else{
					dupl[inp.value][0].classList.remove('duplicate');
				}
			}
		})

	},

	showSelect: function(team,ev){

		if(typeof(MatchesView.Players[team].select) != "undefined"){

			var select = MatchesView.Players[team].select.cloneNode(true);

			//TODO: add eventlistener, then remove!!
			select.addEventListener('change',(function(ev){
				this.value = select.options[select.selectedIndex].value;
				select.removeEventListener('click', arguments.callee);
				if(typeof(select.parentNode) != "undefined"){
					select.dispatchEvent(eventRemove);
				}
			}).bind(this))

			select.addEventListener('blur', function blur(){
				select.dispatchEvent(eventRemove)
			})

			var eventRemove = new Event('remove')

			select.addEventListener('remove', function(ev){
				if(typeof(this.parentNode) != "undefined"){
					this.parentNode.removeChild(this)
				}
			})

			this.offsetParent.appendChild(select);
			select.style.position = "absolute";
			select.style.top = this.offsetTop+this.offsetHeight+'px';
			select.style.left = this.offsetLeft+'px';

		}

	},

	initialize: function(){
		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			MatchesView.setPlayer.call(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Local',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id'),{target:{value:inp.value}})
		});
		[].forEach.call(document.querySelectorAll('.visitor-team.player-number input'),function(inp,key){
			MatchesView.setPlayer.call(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Visitor',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id'),{target:{value:inp.value}})
		});
	},

	init: function(){
		MatchesView.handleNumberListeners();
		MatchesView.initialize();
		// MatchesView.showSelect();
	},
}