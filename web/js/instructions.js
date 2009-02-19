window.addEvent('domready', function () {
	myTabs = new SlidingTabs('buttons', 'panes', {
	    wrap: false,
	    animateHeight: false
	});
		
	window.addEvent('resize', myTabs.recalcWidths.bind(myTabs));
});