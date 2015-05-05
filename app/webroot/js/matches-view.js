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
			opt.setAttribute('data-player-id',k);

			MatchesView.handleDuplicates()

			//if doesn't exists, add to array
			if(typeof(opts[shirtNumber])== "undefined" ){
				opts[shirtNumber] = opt;
			}

			//clear the select, and append option childs
			select.innerHTML = '';
			optFirsts = document.createElement('option');
			optFirsts.textContent = "Seleccionar jugador";
			select.appendChild(optFirsts);
			optFirsts = document.createElement('option');
			optFirsts.textContent = "Borrar";
			optFirsts.value = '';
			select.appendChild(optFirsts);

			opts.forEach(function(opt){
				select.appendChild(opt);
			})

		}else{
			ev.target.value = '';
		}

	},

	handleDuplicates: function(){

		var dupl = [];

		[].forEach.call(document.querySelectorAll('div.player div.local-team input'),function(inp,k){
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

		dupv = [];
		[].forEach.call(document.querySelectorAll('div.player div.visitor-team input'),function(inp,k){
			if(inp.value != ""){
				if(typeof(dupv[inp.value]) == "undefined") dupv[inp.value] = []
				dupv[inp.value].push(inp);
				if(dupv[inp.value].length > 1){
					dupv[inp.value].forEach(function(inp){
						inp.classList.add('duplicate')
					})
				}else{
					dupv[inp.value][0].classList.remove('duplicate');
				}
			}
		})

	},

	showSelect: function(team,ev){

		if(typeof(MatchesView.Players[team].select) != "undefined"){

			[].forEach.call(this.offsetParent.querySelectorAll('select'),function(sel){
				sel.parentNode.removeChild(sel)
			});

			var isOwnGoal = MatchesView.isOwnGoal;

			if(isOwnGoal){
				team = (team == 'Local') ? 'Visitor' : 'Local';
			}

			var select = MatchesView.Players[team].select.cloneNode(true);
			var removed = false;

			select.addEventListener('change',(function change(ev){
				var opt = select.options[select.selectedIndex]


				this.value = opt.value;

				this.parentNode.setAttribute('data-player-id',opt.getAttribute('data-player-id'))

				setGoalClass(this,isOwnGoal);

				if(typeof(select.parentNode) != "undefined" && !removed){
					removed = true;
					select.dispatchEvent(eventRemove);
				}
			}).bind(this))

			select.addEventListener('blur', function blur(){
				if(!removed){
					removed = true;
					select.dispatchEvent(eventRemove);
				}
			})

			setGoalClass = function(inp,isOwnGoal){
				if(isOwnGoal){
					inp.parentNode.classList.add('own-goal');
					inp.parentNode.classList.remove('normal-goal');
					[].forEach.call(inp.parentNode.querySelectorAll('.red,.yellow'), function(el){
						el.setAttribute('disabled','disabled');
						el.value = '';
					})
				}else{
					inp.parentNode.classList.add('normal-goal');
					inp.parentNode.classList.remove('own-goal');
					[].forEach.call(inp.parentNode.querySelectorAll('.red,.yellow'), function(el){
						el.removeAttribute('disabled');
					})
				}
			}

			var eventRemove = new Event('remove')

			select.addEventListener('remove', function remove(ev){
				if(typeof(this.parentNode) != "undefined"){

					[].forEach.call(this.offsetParent.querySelectorAll('select'),function(sel){
						sel.parentNode.removeChild(sel)
					});

				}
			})

			this.offsetParent.appendChild(select);
			select.style.position = "absolute";
			select.style.top = this.offsetTop+this.offsetHeight+'px';
			select.style.left = this.offsetLeft+'px';

		}

	},

	handleGoalListeners: function(){
		[].forEach.call(document.querySelectorAll('.goals-bookings div input.goal'),function(inp,key){
			// inp.addEventListener('input',MatchesView.addGoal.bind(inp));
		});
	},

	setGoals: function(){

		/* reset goals and bookings in players */
		for(k in MatchesView.Players.Local){
			if(MatchesView.Players.Local.hasOwnProperty(k)){
				var player = MatchesView.Players.Local[k];
				player.goals = {normalGoals: 0, ownGoals:0};
				player.bookings = {yellow: 0, red:0};
			}
		}
		for(k in MatchesView.Players.Visitor){
			if(MatchesView.Players.Visitor.hasOwnProperty(k)){
				var player = MatchesView.Players.Visitor[k];
				player.goals = {normalGoals: 0, ownGoals:0};
				player.bookings = {yellow: 0, red:0};
			}
		}

		[].forEach.call(document.querySelectorAll('.goals-bookings div'),function(div,key){
			if(div.getAttribute('data-player-id') != null){
				addGoal(div,div.classList.contains('normal-goal'))
			}

			function addGoal(div,isNormalGoal){
				var playerId = div.getAttribute('data-player-id');
				/*XOR for isLocal and isNormalGoal
				divIsLocal | isNormalGoal | Team
				     0     |      0       |   L
				     0     |      1       |   V
				     1     |      0       |   V
				     1     |      1       |   L
				*/
				var team = !( div.parentNode.parentNode.classList.contains('local-team') ^ isNormalGoal ) ? 'Local' : 'Visitor';

				MatchesView.Players[team][playerId]['goals'][ (isNormalGoal) ? 'normalGoals' : 'ownGoals' ] += Math.ceil(div.querySelector('input.goal').value);

				MatchesView.Players[team][playerId]['bookings']['yellow'] += Math.ceil(div.querySelector('input.yellow').value);
				MatchesView.Players[team][playerId]['bookings']['red'] += Math.ceil(div.querySelector('input.red').value);
			}
		});
	},

	handleBookingListeners: function(){
		[].forEach.call(document.querySelectorAll('.goals-bookings input.red'),function(inp,key){
			inp.addEventListener('click',MatchesView.cicleBooking.bind(inp,1))
		});
		[].forEach.call(document.querySelectorAll('.goals-bookings input.yellow'),function(inp,key){
			inp.addEventListener('click',MatchesView.cicleBooking.bind(inp,2))
		});
	},

	cicleBooking: function(maxVal){
		if(this.value == '' ){
			this.value = 1;
		}else if(this.value == maxVal){
			this.value = '';
		}else{
			this.value = 1 + parseInt(this.value);
		}
	},

	handleOwnGoalListeners: function(){
		document.querySelector('.own-goal-button').addEventListener('click', MatchesView.ownGoalMode)
	},

	ownGoalMode: function(ev){
		MatchesView.isOwnGoal = ev.target.classList.toggle('pressed');
	},

	isOwnGoal: false,

	save: function(){
		this.setGoals();
	},

	initialize: function(){
		//set players with values saved before
		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			MatchesView.setPlayer.call(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Local',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id'),{target:{value:inp.value}})
		});
		[].forEach.call(document.querySelectorAll('.visitor-team.player-number input'),function(inp,key){
			MatchesView.setPlayer.call(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Visitor',inp.parentNode.parentNode.getAttribute('data-playerShirtNumber-id'),{target:{value:inp.value}})
		});

		//set goals and bookings
		for(i in MatchesView.data.goalsByPlayer){
			if(MatchesView.data.goalsByPlayer.hasOwnProperty(i)){
				console.log(MatchesView.data.goalsByPlayer[i])
			}
		}
	},

	addListeners: function(){
		MatchesView.handleNumberListeners();
		MatchesView.handleGoalListeners();
		MatchesView.handleBookingListeners();
		MatchesView.handleOwnGoalListeners();
	},

	init: function(){
		MatchesView.addListeners()
		MatchesView.initialize();
	},
}