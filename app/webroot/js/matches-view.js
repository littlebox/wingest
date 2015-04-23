MatchesView = {

	Players: {
			Local: {},
			Visitor: {},
	},

	handleNumberListeners: function(){

		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,inp.parentNode.parentNode.getAttribute('data-id')))
		})
	},

	setPlayer: function(k,ev){

		//Create select if it doesn't exists
		if(typeof(MatchesView.Players.Local.select) === "undefined"){
			MatchesView.Players.Local.select = document.createElement('select');
			var opt = document.createElement('option');
			opt.textContent = 'Seleccione jugador...';
			MatchesView.Players.Local.select.appendChild(opt);
		}

		var select = MatchesView.Players.Local.select;

		//Create player if it doesn't exists
		if(typeof(MatchesView.Players.Local[k]) === "undefined"){ MatchesView.Players.Local[k] = {}}
		MatchesView.Players.Local[k].number = ev.target.value;
		MatchesView.Players.Local[k].name = ev.target.parentNode.parentNode.querySelector('.names').textContent.trim();

		var currrentOption = select.querySelector('.player-select-'+k);
		if(currrentOption != null ){
			currrentOption.parentNode.removeChild(currrentOption)
		}

		//Order players by shirt number and create opts in opts
		var opts = [];
		for (val in MatchesView.Players.Local){
			//If it's a player, not the select
			if( MatchesView.Players.Local.hasOwnProperty(val) && typeof(MatchesView.Players.Local[val].number) != "undefined" ){
				opt = document.createElement('option')
				opt.value = MatchesView.Players.Local[val].number;
				opt.textContent = MatchesView.Players.Local[val].number+' - '+MatchesView.Players.Local[val].name;
				opt.setAttribute('class','player-select-'+val);
				opts[MatchesView.Players.Local[val].number] = opt
			}
		}
		console.log(opts)

		select.innerHTML = '';
		opts.forEach(function(opt){
			select.appendChild(opt)
		})



	},

	showSelect: function(){

		[].forEach.call(document.querySelectorAll('.goals-bookings input.nro'),(function(inp){

			inp.addEventListener('click',(function(){

				var select = MatchesView.Players.Local.select.cloneNode(true);

				//TODO: add eventlistener, then remove!!
				select.addEventListener('change',(function(ev){
					inp.value = select.options[select.selectedIndex].value;
					select.removeEventListener('click', arguments.callee);
					if(typeof(select.parentNode) != "undefined"){
						select.parentNode.removeChild(select)
					}
				}))

				select.addEventListener('blur', function(){
					if(typeof(select.parentNode) != "undefined"){
						select.parentNode.removeChild(select)
					}
				})

				inp.offsetParent.appendChild(select);
				select.style.position = "absolute";
				select.style.top = inp.offsetTop+inp.offsetHeight+'px';
				select.style.left = inp.offsetLeft+'px';

			}).bind(inp))

		}))

	},

	init: function(){
		MatchesView.handleNumberListeners();
		MatchesView.showSelect();
	},
}