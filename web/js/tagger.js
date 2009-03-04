var Tagger = new Class({
        
    Extends: Rubberband,
        
    initialize: function(options){
        this.container = $('tagger');
        this.list = $('tagger-selected');
        
        this.parent({ triggers: [this.container] });
        this.selectables = this.container.getElements('.inline img').map(this.add.bind(this));
        
        new Element('p').adopt(
            new Element('a', {
                'class': 'button',
                'href': 'javascript:void(0)',
                'html': 'Submit',
                'events': {
                    'click': this.onSubmit.bind(this)
                }
            }),
            new Element('a', {
                'class': 'button',
                'href': 'javascript:void(0)',
                'html': 'Reset',
                'events': {
                    'click': this.onReset.bind(this)
                }
            })
        ).injectBefore(this.list)
    },
    
    add: function(el, obj){
        this.parent(el, obj);
		return el;
    },
    
    select: function(el){
        if (el.retrieve('rubberbanded')) return;
        this.parent(el);
        
        var img = (el.get('tag') != 'img') ? el.getElement('img') : el;
        img.getParent('div.inline').addClass('green');
        
        el.store('selected', new Element('li').adopt(
            img.clone().set({
                'class': 'thumbnail',
                'styles': {
                    'height': ''
                }  
            })
        ).inject(this.list));
    },
    
    deselect: function(el){
        this.parent(el);
        el.getParent('div.inline').removeClass('green');
        var input = el.retrieve('selected');
        if (input) input.destroy();
    },
    
    onSubmit: function(){
        this.request = this.request || new Request({
            
        });
    },
    
    onReset: function(){
        this.selectables.each(this.deselect.bind(this));
    }
     
});
    
window.addEvent('domready', function(){
    new Tagger();
        
    $$('.toggle').addEvent('click', function(){
        var target = $(this.get('rel'));
        if (!target) return false;
        this.set('html', (this.get('html').trim() == '+') ? '-' : '+');
        target.toggleClass('invisible');
    }).fireEvent('click');
});