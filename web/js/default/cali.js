var Cali = new Class({
   
    Implements: [Events, Options],
    
    initialize: function(element, options){
        this.setOptions(options);
        this.table = $(element);
        if (!this.table) return;
        this.table.store('cali', this);
        
        this.configure();
    },
    
    configure: function(){
        this.days = [];
        this.selected = false;
        this.events = {
            click: this.onClick.bind(this),
            dblclick: this.onDblClick.bind(this)
        };
    },
    
    set: function(object){
        this.reset();
        $splat(object).forEach(this.add, this);
    },
    
    reset: function(){
        this.days.forEach(this.remove, this);
        this.days.empty();
    },
    
    remove: function(day){
        this.fireEvent('remove', day.removeClass('hit').set('html', '&nbsp;'));
    },
    
    add: function(item, i){
        if ('cluster' in item) return item.cluster.forEach(this.add, this);
        if ('CLASS_NAME' in item) this['add' + item.CLASS_NAME.match(/\.(\w+)$/ig)[0].substr(1)](item);
    },
    
    addVector: function(vector){
        var date = Cali.getDate(vector.data.taken_timestamp), day;
        if ((day = this.table.getElement('#cali-{month}-{day}'.substitute(date)))) this.attach(day.store('map:vector', vector));
    },
    
    attach: function(day){
        this.days.push(day);
        this.fireEvent('attach', day.addClass('hit').addEvents(this.events).set('text', (+day.get('text') || 0) + 1));
    },
    
    onClick: function(e){
        if (this.selected) this.selected.removeClass('selected');
        this.selected = e.target.addClass('selected');
        this.fireEvent('click', e.target);
    },
    
    onDblClick: function(e){
        this.fireEvent('dblclick', e.target);
        return false;
    }
    
});

Cali.getDate = function(timestamp){
    var date = new Date();
    date.setTime(timestamp * 1000);
    return {
        month: date.getMonth() + 1,
        day: date.getDate(),
        year: date.getFullYear()  
    }; 
};