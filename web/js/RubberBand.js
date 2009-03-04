	
Element.Properties.placement = {
	set : function(options){
		this.store('placement', this.getCoordinates());
	},
	
	get : function(){
		return this.retrieve('placement');
	}
};
	
/*

Class: rubberbandSelect
	Click and drag to select element.  Hold 'ctrl' key to add items to current selection

UPDATED:
	supports dragging. rebuild function has been removed. work in progress. update following.
	Nathan White

Author: PK (real name??)
	- upgraded by Chris Esler http://www.chrisesler.com/mootools
	- minor changes by Nathan White http://www.nwhite.net/ (remove browser selection in background, fixed rebuild method)
License:
	MIT-style license.

Arguments:
	elements - a collection of elements to apply the rubberband selection
	options - an object. See options Below.

Options:
	triggers - a collection of elements to accept rubberband clicks
	onSelect - optionally you can alter the default select behaviour with this option
	onDeselect - optionally you can alter the default de-select behaviour with this option


Inspiration:
	http://forum.mootools.net/viewtopic.php?id=6367

	script on forum didn't work with Mootools 1.2b2. upgraded script to work with 1.2b2 

*/


var Rubberband = new Class({
	Implements : [Options, Events],
	
	options : {
		draggable : false,
		drag : {},
		triggers : [],
	},
	
	triggers : null,
	selected : [],
	index : [],
	box : null,
	elements : new Elements(),
	
	initialize : function(options){
		
		this.setOptions(options);
		
		this.triggers = this.options.triggers;
		
		this.box = new Element('div').setStyles({
		    'position': 'absolute',
		    'border': '1px dotted #999',
		    'display': 'none'
	    }).inject(document.body);
		
		this.overlay = new Element('div').setStyles({
		    'opacity': '.2',
		    'height': '100%',
		    'width': '100%',
		    'background-color': '#7389ae'
		}).inject(this.box);
		
		var start = this.start.bindWithEvent(this);
		var move = this.move.bindWithEvent(this);
		var end = this.end.bindWithEvent(this);
		
		this.options.trigger = (!this.options.trigger) ? document.body : $(this.options.trigger);
		
		this.options.trigger.addEvents({
			'mousedown' : start, 'mousemove' : move, 'mouseup' : end
		});
		
		document.body.onselectstart = function(e){ e = new Event(e).stop(); return false; };
		
		if(this.options.draggable)
			this.dragGroup = new Drag.Group({ 
				'drag' : this.options.drag,
				'filter' : function(item){ return item.retrieve('rubberbanded'); }
			});
		
		this.resetCoords();
	},
	
	add : function(el,obj){
		el.set('placement');
		el.addEvent('click', this.itemClick.bind(this));
		this.index.push(el);
		if(this.options.draggable) {
			this.dragGroup.add(el,obj).addEvent('complete', function(item){
			    item.set('placement');
		    });
		}
	},
	
	start : function(event){
		var greenlight = false;
		
		this.triggers.each(function(el){
			if(event.target == el) greenlight = true;
		},this);
		
		if(greenlight || event.target == document.body){
			this.bActive = true;
			if(this.options.draggable)
				this.dragGroup.options.active = true;
			this.setStartCoords(event.page);
		}
	},
	
	end : function(event){
		if(!this.bActive) return false;
		
		this.bActive = false;
		
		if(this.coords.w < 5 && this.coords.h < 5) this.index.each(this.checkNodes, this);
		
		if(this.options.draggable){
			if(this.selected.length) this.dragGroup.options.active = true;				
			else this.dragGroup.options.active = false;
		}
		
		this.resetCoords();

	},
	
	move: function(event){
		
		if(this.bActive && this.box.style.display == ''){
			this.setMoveCoords(event.page);
			
			this.selected.length = 0;
			this.index.each(this.checkNodes, this);
			
			var sel;
			if(document.selection && document.selection.empty){
				document.selection.empty() ;
			} else if(window.getSelection) {
				sel=window.getSelection();
				if(sel && sel.removeAllRanges) 
					sel.removeAllRanges() ;
			}	
		
		}
		
		
	},
	
	setStartCoords : function(coords){
		this.coords.start = coords;
		this.coords.w = 0; this.coords.h = 0;
		this.box.setStyles({
			'display' : '', 'top' : this.coords.start.y, 'left' : this.coords.start.x
		});
	},
	
	setMoveCoords : function(coords){
		this.coords.move = coords;
		this.coords.w = Math.abs(this.coords.start.x - this.coords.move.x);
		this.coords.h = Math.abs(this.coords.start.y - this.coords.move.y);
		this.coords.top = this.coords.start.y > this.coords.move.y ? this.coords.move.y : this.coords.start.y;
		this.coords.left = this.coords.start.x > this.coords.move.x ? this.coords.move.x : this.coords.start.x;
		this.coords.end = { 'x' : (this.coords.left + this.coords.w), 'y' : (this.coords.top + this.coords.h)};
		
		this.box.setStyles({
			'top' : this.coords.top,
			'left' : this.coords.left,
			'width' : this.coords.w,
			'height' : this.coords.h
		});
	},
	
	resetCoords : function(){
		this.coords = { start : {x : 0, y : 0}, move : {x : 0, y : 0}, end : {x: 0, y: 0}, w: 0, h: 0};
		this.box.setStyles({'display' : 'none', 'top' : 0, 'left' : 0, 'width' : 0, 'height' : 0});
	},
	
	checkNodes : function(el){
		var box = this.coords;
		var elb = el.get('placement');
		if(Math.min(box.end.x, elb.right) > Math.max(box.left, elb.left) && Math.max(box.top, elb.top) < Math.min(box.end.y, elb.bottom)){
			this.select(el);
			this.selected.push(el);
		}
	},   
	
	select: function(element){
		element.addClass('selected');
		element.store('rubberbanded',true);
	},
	
	deselect: function(element){
		element.removeClass('selected');
		element.store('rubberbanded',false);
	},
	
	itemClick : function(e){
		if(!e.shift) return;
		var el = e.target;
		if (!el.hasClass('selected')) this.select(el);
	    else this.deselect(el);
	}
	
});