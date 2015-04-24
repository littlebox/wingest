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
			var shirtNumber = MatchesView.Players[team][k].number

			if(ev.target.parentNode.parentNode.querySelector('.names').textContent.trim() != ''){
				var name = ev.target.parentNode.parentNode.querySelector('.names').textContent.trim()
				name = name.replace(/\w+/,function(l){return l.toUpperCase()}) //All last name, before coma
				name = name.replace(/,\s+\w/,function(l){return l.toUpperCase()}) //First letter of name, after coma and space
			}
			MatchesView.Players[team][k].name = name;

			var opt = document.createElement('option')
			opt.value = shirtNumber;
			opt.textContent = shirtNumber+' - '+name;
			opt.setAttribute('class','player-select-'+k);

			//verify there isn't a duplicate number opts[shirtnumber]
			if(typeof(opts[shirtNumber]) != "undefined"){
				//defined before, add duplicate
				MatchesView.handleDuplicates(this,document.querySelector('input.player-number-'+opts[shirtNumber].className.split('-')[2]))
			}else{
				//not duplicate
				MatchesView.handleDuplicates(this);
				opts[shirtNumber] = opt
			}

			//add to options

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

	handleDuplicates: function(inp1,inp2){
		var val1 = inp1.value;
		if(typeof(this.duplicates) == "undefined"){this.duplicates = {}}

		if(arguments.length > 1){
			var val2 = inp2.value;
			if(val1 == val2){

				inp1.classList.add('duplicate');
				inp2.classList.add('duplicate');

				if(typeof(this.duplicates[inp1.id]) == "undefined"){this.duplicates[inp1.id] = {id: inp1.id}}
				if(typeof(this.duplicates[inp2.id]) == "undefined"){this.duplicates[inp2.id] = {id: inp2.id}}
				if(typeof(this.duplicates[inp1.id].avec) == "undefined"){this.duplicates[inp1.id].avec = []}
				if(typeof(this.duplicates[inp2.id].avec) == "undefined"){this.duplicates[inp2.id].avec = []}

				if(this.duplicates[inp1.id].avec.indexOf(this.duplicates[inp2.id]) == -1){
					this.duplicates[inp1.id].avec.push(this.duplicates[inp2.id]);
				}
				if(this.duplicates[inp2.id].avec.indexOf(this.duplicates[inp1.id]) == -1){
					this.duplicates[inp2.id].avec.push(this.duplicates[inp1.id]);
				}

				add.bind(this,inp1,inp2)

				function add(i1,i2){
					if(this.duplicates[i1].avec.indexOf(this.duplicates[i2]) == -1){
						this.duplicates[i1].avec.push(this.duplicates[i2]);
						if(this.duplicates[i2].avec.length > 1){
							this.duplicates[i2].avec.forEach(function(i){
								add(i1,i);
							})
						}
					}
					if(this.duplicates[i2].avec.indexOf(this.duplicates[i1]) == -1){
						this.duplicates[i2].avec.push(this.duplicates[i1]);
						if(this.duplicates[i1].avec.length > 1){
							this.duplicates[i1].avec.forEach(function(i){
								add(i,i);
							})
						}
					}
				}

			}
		}else{
			if(typeof(this.duplicates[inp1.id]) != "undefined"){
				inp1.classList.remove('duplicate');
				console.log(this.duplicates[inp1.id].avec.length)
				this.duplicates[inp1.id] = undefined;
			}
		}
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