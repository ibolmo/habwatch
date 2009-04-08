var Thumbs = new Class({
	
	Implements: Options,
	
	options: {
		offset: 20,
	    squeezebox: {
	        handler: 'ajax',
	        url: '/photo/info',
	        overlayOpacity: 0.0
	    }
	},
	
	initialize: function(elements, options){
		this.setOptions(options);
		
		this.elements = $$(elements);
		if (!this.elements.length) return;
		
		this.configure();
		this.attach();
	},
	
	configure: function(){
		this.last = this.elements.getLast();
		var prev = null;
		this.elements.each(function(element){
		    SqueezeBox.assign(element, $merge(this.options.squeezebox, {url: this.options.squeezebox.url + '/' + element.id}));
		        
		    var parent = element.getParent('li');
		    if (prev) prev.setStyle('margin-bottom', -prev.retrieve('thumb:offset', Math.min(prev.getParent('li').offsetHeight, parent.offsetHeight) - this.options.offset));
		    prev = element;
		}, this);
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
		e.target.tween('margin-bottom', -e.target.retrieve('thumb:offset') || 0);
	},
	
	onClick: function(e){
		if (this.selected && this.selected != this.last) this.selected.addEvent('mouseleave', this.events.mouseleave).fireEvent('mouseleave', {target: this.selected});
		this.selected = e.target.removeEvent('mouseleave', this.events.mouseleave);
	}
	
})

window.addEvent('domready', function(){
	new Thumbs('#sidebar-recent .thumbnail');
});