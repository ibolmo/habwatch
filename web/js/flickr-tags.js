window.addEvent('domready', function(){
    $$('#flickr-tags > li').addEvent('click', function(){
        var map = $('map');
        if (!map) return;
        var el = this.href ? this : this.getElement('a');
        var matched = el.href.match(/\/tags.+$/i);
        map.set('src', 'http://www.flickr.com/photos/35147405@N02' + (matched && matched[0] || '') + '/map');
        return false;
    });
});