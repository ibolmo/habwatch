window.addEvent('domready', function(){
    var base_url = 'http://www.flickr.com/photos/35147405@N02';
    
    new Element('li').adopt(new Element('a', {
        'href': base_url + '/map',
        'text': 'none'
    })).injectTop($('flickr-tags'));
    
    $$('#flickr-tags a').addEvent('click', function(e){
        var map = $('map')
        if (!map || !(map = map.retrieve('map'))) return;
        e.stop();
        map.filterBy('tag', this.get('text'));
    });
});