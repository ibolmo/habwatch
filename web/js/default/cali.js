var Cali = new Class({
   
    Implements: Options,
    
    initialize: function(element, options){
        this.setOptions(options);
        this.table = $(element);
        if (!this.table) return;
        this.table.store('cali', this);
        this.selected = [];
    },
    
    set: function(object){
        this.reset();
        $splat(object).forEach(this.add, this);
    },
    
    reset: function(){
        this.selected.forEach(this.remove, this);
        this.selected.empty();
    },
    
    remove: function(item){
        item.removeClass('hit');  
    },
    
    add: function(item, i){
        if ('cluster' in item) return item.cluster.forEach(this.add, this);
        if ('CLASS_NAME' in item) this['add' + item.CLASS_NAME.match(/\.(\w+)$/ig)[0].substr(1)](item);
    },
    
    addVector: function(vector){
        var date = Cali.getDate(vector.data.taken_timestamp), day;
        //console.log(vector.data.taken_timestamp, date);
        if ((day = this.table.getElement('#cali-{month}-{day}'.substitute(date)))){
            this.selected.push(day.addClass('hit'));
        }
    },    
    
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