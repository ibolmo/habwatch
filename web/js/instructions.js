window.addEvent('domready', function () {
	myTabs = new SlidingTabs('buttons', 'panes', {
	    animateHeight: false
	});
		
	window.addEvent('resize', myTabs.recalcWidths.bind(myTabs));
});