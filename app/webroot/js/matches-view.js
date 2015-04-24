MatchesView = {

	Players: {
			Local: {},
			Visitor: {},
	},

	handleNumberListeners: function(){

		//List player input
		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Local'))
		});
		[].forEach.call(document.querySelectorAll('.visitor-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,inp.parentNode.parentNode.getAttribute('data-id'),'Visitor'))
		});

		//Goals and Bookings listeners
		[].forEach.call(document.querySelectorAll('.local-team .goals-bookings input.nro'), function(inp){
			inp.addEventListener('click', MatchesView.showSelect.bind(inp,'Local'))
		});

		[].forEach.call(document.querySelectorAll('.visitor-team .goals-bookings input.nro'), function(inp){
			inp.addEventListener('click', MatchesView.showSelect.bind(inp,'Visitor'))
		})
	},

	setPlayer: function(k,team,ev){

		//Create select if it doesn't exists
		if(typeof(MatchesView.Players[team].select) === "undefined"){
			MatchesView.Players[team].select = document.createElement('select');
		}

		if(typeof(MatchesView.Players[team].opts) === "undefined"){
			MatchesView.Players[team].opts = [];
		}

		var select = MatchesView.Players[team].select;

		//Create player if it doesn't exists
		if(typeof(MatchesView.Players[team][k]) === "undefined"){ MatchesView.Players[team][k] = {}}
		MatchesView.Players[team][k].number = ev.target.value;
		MatchesView.Players[team][k].name = ev.target.parentNode.parentNode.querySelector('.names').textContent.trim();

		var currrentOption = select.querySelector('.player-select-'+k);
		if(currrentOption != null ){
			currrentOption.parentNode.removeChild(currrentOption)
		}

		//Order players by shirt number and create opts in opts
		for (val in MatchesView.Players[team]){
			//If it's a player, not the select
			if( MatchesView.Players[team].hasOwnProperty(val) && typeof(MatchesView.Players[team][val].number) != "undefined" ){
				opt = document.createElement('option')
				opt.value = MatchesView.Players[team][val].number;
				opt.textContent = MatchesView.Players[team][val].number+' - '+MatchesView.Players[team][val].name;
				opt.setAttribute('class','player-select-'+val);
				MatchesView.Players[team].opts[MatchesView.Players[team][val].number] = opt
			}
		}
		console.log(MatchesView.Players[team].opts)

		//clear the select, and append option childs
		select.innerHTML = '';
		optFirst = document.createElement('option');
		optFirst.textContent = "Seleccionar jugador";
		select.appendChild(optFirst);

		MatchesView.Players[team].opts.forEach(function(opt){
			select.appendChild(opt);
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

	init: function(){
		MatchesView.handleNumberListeners();
		// MatchesView.showSelect();
	},
}