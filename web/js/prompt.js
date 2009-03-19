window.addEvent('domready', function(){    
    var intro = $('introduction');
    if (intro) SqueezeBox.fromElement(intro, {
        onOpen: function(sbox){
            intro.removeClass('invisible');
        },
        onClose: function(){
            intro.addClass('invisible');
        },
        handler: 'adopt'
    });
    
});