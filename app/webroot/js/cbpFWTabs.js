;( function( window ) {

	'use strict';

	function extend( a, b ) {
		for( var key in b ) {
			if( b.hasOwnProperty( key ) ) {
				a[key] = b[key];
			}
		}
		return a;
	}

	function CBPFWTabs( el, options ) {
		this.el = el;
		this.options = extend( {}, this.options );
		extend( this.options, options );
		this._init();
	}

	CBPFWTabs.prototype.options = {
		start : 0
	};

	CBPFWTabs.prototype._init = function() {
		// tabs elems
		this.tabs = [].slice.call( this.el.querySelectorAll( 'nav > ul > li.tab' ) );
		// spans elems
		this.spans = [].slice.call( this.el.querySelectorAll('nav > ul > li:not(.team) span.span') );
		// content items
		this.items = [].slice.call( this.el.querySelectorAll( '.content-wrap > section' ) );
		// pagination items
		this.next = this.el.querySelector( 'nav > ul > li.pagination.next' );
		this.back = this.el.querySelector( 'nav > ul > li.pagination.back' );
		// current index
		this.current = -1;
		// show current content item
		this._show();
		// init events
		this._initEvents();
	};

	CBPFWTabs.prototype._initEvents = function() {
		var self = this;
		this.tabs.forEach( function( tab, idx ) {
			tab.addEventListener( 'click', function( ev ) {
				ev.preventDefault();
				self._resetNames();
				self._show( idx );
				self._setName(idx);
			} );
		} );

		this.next.addEventListener('click', function(ev){
			ev.preventDefault;
			self._next();
		})

		this.back.addEventListener('click', function(ev){
			ev.preventDefault;
			self._back();
		})
	};

	CBPFWTabs.prototype._resetNames = function(){
		var self = this;
		if(this.current > 0){
			this.spans[this.current - 1].textContent = 'J'+(this.current)
		}
	};

	CBPFWTabs.prototype._setName = function(idx){
		var self = this;
		if(this.current > 0 && idx){
			this.spans[idx - 1].innerHTML = '<i class="fa fa-user fa-lg"></i> Jugador '+ (idx);
		}
	};

	CBPFWTabs.prototype._show = function( idx ) {
		if( this.current >= 0 ) {
			this.tabs[ this.current ].className = this.items[ this.current ].className = 'tab';
		}
		// change current
		this.current = idx != undefined ? idx : this.options.start >= 0 && this.options.start < this.items.length ? this.options.start : 0;
		this.tabs[ this.current ].className = 'tab-current';
		this.items[ this.current ].className = 'content-current';
	};

	CBPFWTabs.prototype._next = function(){
		if(this.current < this.items.length -1){
			var self = this;
			self._resetNames();
			self._show( this.current + 1 );
			self._setName( this.current );
		}
	}

	CBPFWTabs.prototype._back = function(){
		if(this.current > 0){
			var self = this;
			self._resetNames();
			self._show( this.current - 1 );
			self._setName( this.current );
		}
	}

	// add to global namespace
	window.CBPFWTabs = CBPFWTabs;



})( window );

Colors = {}

Colors.container = $('#colors');

$('.color-selector').click(function(){
	Colors.container.foundation('reveal','open');
	Colors.current = $(this);
})

Colors.colorSelector = $('div.cs-options ul li');

Colors.colorSelector.click(function(){
	Colors.current.find('svg g path.color-sample').attr('fill',$(this).attr('data-value'))
	Colors.current.find('input').val($(this).attr('data-value'))
	Colors.container.foundation('reveal','close');
})

window.Colors = Colors;

$('.fileinput-container').hover( function(){$('.actions').addClass('visible')}, function(){$('.actions').removeClass('visible')})