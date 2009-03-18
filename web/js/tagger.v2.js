var Tagger = new Class({
    
    

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