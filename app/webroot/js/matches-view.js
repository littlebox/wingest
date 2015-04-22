MatchesView = {

	Players: {
			Local: {},
			Visitor: {},
	},

	handleNumberListeners: function(){

		[].forEach.call(document.querySelectorAll('.local-team.player-number input'),function(inp,key){
			inp.addEventListener('input',MatchesView.setPlayer.bind(inp,key))
		})
	},

	setPlayer: function(k,ev){
		console.log(ev.target.value)
		if(typeof(MatchesView.Players.Local[k]) === "undefined"){ MatchesView.Players.Local[k] = {}}
		if(typeof(MatchesView.Players.Local.select) === "undefined"){ MatchesView.Players.Local.select = document.createElement('select')}
		MatchesView.Players.Local[k].number = ev.target.value;
		MatchesView.Players.Local[k].name = ev.target.parentNode.parentNode.querySelector('.names').textContent.trim();
		
		var opt = document.createElement('option')
		opt.value = MatchesView.Players.Local[k].number
		opt.textContent = MatchesView.Players.Local[k].number+' - '+MatchesView.Players.Local[k].name
		MatchesView.Players.Local.select.appendChild(opt)

	},

	showSelect: function(){

		[].forEach.call(document.querySelectorAll('.goals-bookings input.nro'),(function(inp){
			
			inp.addEventListener('click',(function(){

				var select = MatchesView.Players.Local.select;

				//TODO: add eventlistener, then remove!!
				select.addEventListener('click',(function(ev){
					console.log('clickeo!');
					inp.value = select.options[select.selectedIndex].value;
					select.removeEventListener('click', arguments.callee);
					select.parentNode.removeChild(select)
				}))
				// select.textContent = 'asdfasd';
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