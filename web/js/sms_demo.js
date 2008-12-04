window.addEvent('domready', function(){
	var go = $('sms_demo_go'), input = $('sms_demo_input'), phone_message = $('sms_demo_phone_message');
	
	if (go && input && phone_message){
		var request = new Request({
			onSuccess: function(text){
				phone_message.set('text', text);
			}
		});
		
		var send_request = function(){
			request.get('../demo/go/' + this.get('value'));
			this.set('value', '');
			return false;
		};
		
		input.addEvent('keypress', function(e){
			if (e.key == 'enter') return send_request.call(this);
		});
		go.addEvent('click', send_request.bind(input));
	}
})