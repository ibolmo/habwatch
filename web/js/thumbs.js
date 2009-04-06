var Thumbs = new Class({
	
	Implements: Options,
	
	options: {
		offset: null
	},
	
	initialize: function(elements, options){
		this.setOptions(options);
		
		this.configure(elements);
		this.attach();
	},
	
	configure: function(elements){
		this.elements = $$(elements);
		this.last = this.elements.getLast();
		this.offset = $defined(this.options.offset) ? this.options.offset : this.elements[0].offsetHeight * 0.8;
		this.elements.erase(this.last).setStyle('margin-bottom', -this.offset);
	},
	
	attach: function(){
		this.events = this.events || {
			mouseenter: this.onMouseEnter.bind(this),
			mouseleave: this.onMouseLeave.bind(this),
			click: this.onClick.bind(this)
		};
		
		this.elements.addEvents(this.events);
		this.last.addEvent('click', this.events.click);
	},
	
	detach: function(){
		if (!this.events) return;
		this.elements.removeEvents(this.events);
		this.last.removeEvent('click', this.events.click);
	},
	
	onMouseEnter: function(e){
		e.target.tween('margin-bottom', 0);
	},
	
	onMouseLeave: function(e){
		e.target.tween('margin-bottom', -this.offset);
	},
	
	onClick: function(e){
		if (this.selected && this.selected != this.last) this.selected.addEvent('mouseleave', this.events.mouseleave).fireEvent('mouseleave', {target: this.selected});
		this.selected = e.target.removeEvent('mouseleave', this.events.mouseleave);
	}
	
})

window.addEvent('domready', function(){
	new Thumbs('#sidebar-recent .thumbnail');
});