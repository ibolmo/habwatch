window.addEvent('domready', function(){
    var base_url = 'http://www.flickr.com/photos/35147405@N02';
    
    new Element('li').adopt(new Element('a', {
        'href': base_url + '/map',
        'text': 'none'
    })).injectTop($('flickr-tags'));
    
    $$('#flickr-tags > li').addEvent('click', function(){
        var map = $('map');
        if (!map) return;
        var el = this.href ? this : this.getElement('a');
        var matched = el.href.match(/\/tags.+$/i);
        map.set('src', base_url + (matched && matched[0] || '') + '/map');
        return false;
    });
});