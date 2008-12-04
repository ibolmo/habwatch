window.addEvent('domready', function(){
	var stop = function(e){ e.stop(); return false; }
	
	$$('input.disabled').addEvent('keydown', stop);
		
	var disable_field = function(){
		var input = this.getParent().getPrevious().getElement('input').toggleClass('disabled');
		var checkbox = this.getNext();
				
		if (this.get('text') == 'enable') {
			input.removeEvent('keydown', stop);
			checkbox.erase('checked');
			this.set('text', 'disable');
		} else {
			input.addEvent('keydown', stop);
			checkbox.set('checked', 'checked');
			this.set('text', 'enable');
		}
		return false;
	};
	
	var remove_field = function(){
		var row = this.getParent('tr');
		if (!row.getElement('input').get('id')) {
			var rowspan = row.getParent().getElement('tr:nth-child(2) td');
			rowspan.set('rowspan', (rowspan.get('rowspan') * 1) - 1);
			row.empty().destroy();
		} else {
			var input = row.getElement('input');
			input.set('value', '');
			if (input.hasClass('disabled')) this.getParent('td').getPrevious().getElement('a').fireEvent('click');
		}
		return false;
	};
	
	$$('.disable_field').addEvent('click', disable_field);
	$$('.remove_field').addEvent('click', remove_field);
	
	$$('.add_field').addEvent('click', function(){
		var row = this.getParent('tr');
		var template = row.getPrevious();
		var clone = template.clone().inject(row, 'before')
		clone.getElements('input').each(function(input){
			input.set('value', '');
			input.set('name', input.get('name').replace(/[0-9]+/g, function(index){
				return (index * 1) + 1;
			}));
		});
		var disabled_fields = clone.getElements('.disable_field').addEvent('click', disable_field);
		clone.getElements('.remove_field').addEvent('click', remove_field);
		
		if (clone.getElement('input').hasClass('disabled')) disabled_fields.fireEvent('click');
		
		var rowspan = row.getParent().getElement('tr:nth-child(2) td');
		rowspan.set('rowspan', (rowspan.get('rowspan') * 1) + 1);
		return false;
	});
	
});