var Rater = new Class({
    
    initialize: function(){
        this.status = new Element('p').addClass('invisible').injectBefore($('tagger'));
        
        this.photos = $$('.photo_box img');
        this.photos.each(function(photo){
            var parent = photo.getParent();
            var request = new Request.JSON({
                url: 'tag/submit',
                onRequest: this.onRequest.bind(this),
                onError: this.onError.bind(this),
                onSuccess: this.onSuccess.bind(this)
            });
            var currentRating = parent.getElement('.current-rating');
            var stars = parent.getElements('a').addEvent('click', function(event){
                var rating = this.get('text');
                request.post({
                    photo_id: photo.id,
                    star: rating
                });
                currentRating.setStyle('width', (rating / stars.length * 100).round() + '%');
                return false;
            });
        }, this);        
    },
    
    onRequest: function(){
        this.status.set('text', 'Submitting').removeClass('invisible');
    },
    
    onError: function(){
        this.status.set('text', 'Error');
    },
    
    onSuccess: function(){
        this.status.set('text', 'Success').addClass.delay(1000, this.status, 'invisible');
    },

});

window.addEvent('domready', function(){
    new Rater();
        
    $$('.toggle').addEvent('click', function(){
        var target = $(this.get('rel'));
        if (!target) return false;
        this.set('html', (this.get('html').trim() == '+') ? '-' : '+');
        target.toggleClass('invisible');
    }).fireEvent('click');
});