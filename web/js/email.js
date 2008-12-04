window.addEvent('domready', function(){
	$$('.email').addEvents({
		mouseenter: function(){
			this.set('href', 'mailto:' + this.get('alt'));
		},
		mouseout: function(){
			this.set('href', '#');
		}
	});
});