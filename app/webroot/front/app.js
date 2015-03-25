Wingest = {

	sliders: [],

	sections: [],

	createSlider: function(obj) {

		var slider = {

			obj: obj,

			curpos: 0, //current position

			control: {},

			controlSkeleton: '<div class=\"controls\"><div class=\"positions\"><div></div></div><div class=\"control-back\"><div class=\"control\"></div></div></div>',

			controlSelectorSkeleton: '<div class=\"selector\"><a href=\"#\"></a></div></div>',

			controlShadow: '<div class="shadow-side"></div>',

			controlWidth: {},

			slides: {},

			slideWidth: {},

			shadow: {},

			curposBeginning: false,
			curposEnding: false,

			initSlider: function(){

				o = $(this.obj);
				p = o.parent();
				
				this.slides = o.find('.slide').length;


				//add html for controls and shadow
				o.prepend(this.controlShadow);
				p.append(this.controlSkeleton);
				o.append(this.controlShadow);
				//append as many controls as slides are inside
				for(i=0;i < this.slides; i++){
					p.find('.positions').append(this.controlSelectorSkeleton);
				}

				//set variables in object
				this.shadow = o.find('.shadow-side')[0]
				this.control = p.find('.controls .control');
				this.controlWidth = p.find('.controls .control').width();
				this.slideWidth = o.find('.slide').width();
				
				//set width (this should be another function to call on window resize)
				p.find('.positions')[0].style.width = (this.slides*20 + 40)+'px';
				if(p.find('.controls').length != 0){
					p.find('.controls')[0].style.left = (this.slideWidth - p.find('.positions').width()) + 'px';
				}

				o.attr('data-index', Wingest.sliders.length)

				this.setHandlers();
			
			},

			tstart:0, //touch start time
			tend:0, //touch end time

			xstartx:0, //touch x start
			xend:0, //touch x end
			delta:0, //touch x end

			setHandlers: function(){
				this.obj.addEventListener('touchstart',this.touchstart.bind(null,this));
				this.obj.addEventListener('touchmove',this.touchmove.bind(null,this));
				this.obj.addEventListener('touchend',this.touchend.bind(null,this));

				if(this.control[0]){
					this.control[0].addEventListener('click',this.click.bind(null,this))
				}

			},

			click: function(sl,ev){

				console.log('click')
				sl.moveTo(2,1)

			},

			touchstart: function(sl,ev){

				sl.xstart = sl.xend = ev.touches[0].pageX;
				sl.ystart = sl.yend = ev.touches[0].pageY;
				sl.tstart = new Date();

			},

			touchmove: function(sl,ev){

				sl.xend = ev.touches[0].pageX;
				sl.yend = ev.touches[0].pageY;

				sl.delta = Number(((sl.xend - sl.xstart)/sl.slideWidth).toPrecision(4));

				sl.deltaY = Number(((sl.yend - sl.ystart)/130).toPrecision(4));

				if((sl.beginning && sl.delta < 0) || (sl.ending && sl.delta > 0)){

					if(Math.abs(sl.delta) > 0.07 && sl.deltaY < 0.5){
						TweenLite.to(sl.obj,0,{x: (-sl.curpos*sl.slideWidth)+(sl.xend-sl.xstart)})
						TweenLite.to(sl.control,0,{x:(sl.controlWidth*sl.curpos)-(sl.delta*sl.controlWidth)})
					}

				}else{

					// console.log(sl.delta);

					(sl.beginning)? sl.shadow.className = sl.shadow.className + ' active':null;


				}

			},

			touchend: function(sl,ev){

				sl.tend = new Date();

				sl.shadow.className = 'shadow-side'

				interval = sl.tend - sl.tstart
				speed = (sl.xend - sl.xstart)/(sl.tend - sl.tstart)

				//~ console.log('translation:%d',sl.xend - sl.xstart);
				//~ console.log('interval:%d',interval);
				//~ console.log('delta:%f',sl.delta);
				//~ console.log('speed:%f',speed);
				//~ console.log('t:%f',0.4/speed);
				//~ console.log('curpos:%f',sl.curpos);

				if( Math.abs(sl.delta) > 0.05 && Math.abs(sl.delta) < 0.6 && Math.abs(speed) > 0.2 ){ //Movimiento rapido
					(sl.delta < 0) ? sl.moveForward(0.4/speed) : sl.moveBackward(0.4/speed);
					//~ console.log('rapido');
				}else if( Math.abs(sl.delta) > 0.6 ){ //Movimiento largo
					//~ console.log('largo');
					(sl.delta < 0) ? sl.moveForward(0.4/speed) : sl.moveBackward(0.4/speed);
				}else{ //Movimiento corto
					//~ console.log('corto');
					sl.moveTo(sl.curpos,0.4/speed);
				}

				(sl.curpos === 0) ? sl.beginning = true : sl.beginning = false;
				(sl.curpos === sl.slides) ? sl.ending = true : sl.ending = false;

				// console.log(sl)

			},

			moveForward: function(t){

				if(this.curpos != this.slides - 1){
					this.curpos++;
					}
				TweenLite.to(this.obj,Math.abs(t),{x:-this.slideWidth*this.curpos, ease:Power4.easeOut})
				TweenLite.to(this.control,Math.abs(t),{x:this.controlWidth*this.curpos, ease:Power4.easeOut})
				},

			moveBackward: function(t){

				if(this.curpos != 0){
					this.curpos--;
					}
				TweenLite.to(this.obj,Math.abs(t),{x:-this.slideWidth*this.curpos, ease:Power4.easeOut})
				TweenLite.to(this.control,Math.abs(t),{x:this.controlWidth*this.curpos, ease:Power4.easeOut})

				},

			moveTo: function(pos,t){
				TweenLite.to(this.obj,Math.abs(t),{x:-this.slideWidth*pos, ease:Power4.easeOut})
				TweenLite.to(this.control,Math.abs(t),{x:this.controlWidth*pos, ease:Power4.easeOut})
				}
		}

		slider.initSlider();
		return slider;

	},

	init: function(){
		Wingest.setSliders();

		//Set history object when the page is loaded
		window.history.replaceState({'url':location.pathname},'Title',location.pathname)
		
		//When the history changes
		window.addEventListener('popstate', Wingest.historyChange);
		// Wingest.loadSection();
	},

	historyChange: function(){
		console.log(history.state);
		Wingest.loadSection(history.state.url)
	},

	loadSection: function(url){
		xhr = new XMLHttpRequest();

		xhr.open('GET',url);

		xhr.setRequestHeader("X-Request-With","XMLHttpRequest");

		xhr.send()

		sectionLoaded = function(){
			$('#container').html(xhr.response);
			history.pushState({'url':url},'Title',url)
		}

		xhr.addEventListener('load',sectionLoaded)


	},

	setSliders: function(section){

		$('section .slider').each(function(k,v){
			var $v = $(v)
			
			//set width equals to elements inside
			v.style.width = $v.find('.slide').length * 100 +'%'

			var slider = new Wingest.createSlider(v);

			Wingest.sliders.push(slider);

			// window.addEventListener('resize',function(ev){
			// 	for(i=0;i<sliders.length;i++){
			// 		sliders[i].setWidth();
			// 		sliders[i].moveTo(sliders[i].curpos,0)
			// 		}
			// 	})

		})
	}
};

Wingest.init();
sl = Wingest.sliders[0];