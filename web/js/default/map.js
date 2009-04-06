var Map = new Class({
	
	Implements: Options,
	
	options: {    
	    osm: {
	    	url: [
		        'http://a.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		        'http://b.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		        'http://c.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/'
		    ]
	    },
	    
	    longitude: -118.489609,
	    latitude: 33.757989,
	    
	    loading: {
	    	opacity: 0.7	
	    },
	    
	    photos: {
	    	styles: {
		        'default': {
		            pointRadius: '${radius}',
		            fillColor: '#67B1E6',
		            fillOpacity: 0.8,
		            strokeColor: '#004E85',
		            strokeWidth: 2,
		            strokeOpacity: 0.8
		        }, 
		        'radius': function(feature) {
	                return Math.pow(2, feature.attributes.count/1.5).limit(4, 12);
	            },
		        'select': {
		            fillColor: '#0078CC',
		            strokeColor: '#004E85'
		        }
		    }
	    },
	    
	    tips: {
	        onShow: function(tip){
	            tip.fade('in')
	        },
	        onHide: function(tip){
	            tip.fade('out');
	        }
	    }
	},
	
	initialize: function(element, options){
		this.setOptions(options);
		this.element = $(element);			    
	    this.vectors = {};
	    this.events = {
	    	photos: {
				loadstart: this.onLoadStart,
		    	loadend: this.onLoadEnd,
		    	featureadded: this.onPhotoAdded,
		    	featureselected: this.onPhotoMouseEnter,
		    	featureunselected: this.onPhotoMouseLeave,
		    	moveend: this.onMoveEnd,
		    	click: this.onPhotoClick,
		    	dblclick: this.onPhotoDblClick,
				scope: this
		    }
	    };
	    this.bounded = false;
	    this.projection = {
	        internal: new OpenLayers.Projection('EPSG:900913'),
	        external: new OpenLayers.Projection('EPSG:4326')
	    };
		this.configure();
	},
	
	configure: function(){
		this.configureMap();
		this.configureLoading();
		this.configureTips();
		this.configurePhotos();
	},
	
	configureMap: function(){
		this.boundary = new OpenLayers.Bounds();		
		var zoom = new OpenLayers.Control.ZoomPanel();
	    zoom.controls[1].trigger = function(){
	    	if (this.boundary) this.map.zoomToExtent(this.boundary);
	    }.bind(this);
		
		this.map = new OpenLayers.Map(this.element.id, {
			controls: [
		        new OpenLayers.Control.Navigation(),
		        new OpenLayers.Control.Attribution(),
		        zoom
		    ],
	        theme: null,
	        maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
	        maxResolution: 156543.0399,
	        numZoomLevels: 19,
	        units: 'm',
	        projection: this.projection.internal,
	        displayProjection: this.projection.external
	    });	
	    
	    this.vectors.osm = new OpenLayers.Layer.OSM.Mapnik('OSM', this.options.osm);
	    this.vectors.osm.url = this.options.osm.url;
	    this.map.addLayer(this.vectors.osm);
	    
	    this.reset({
	    	coordinate: new OpenLayers.LonLat(this.options.longitude, this.options.latitude).transform(this.projection.external, this.projection.internal),
	    	zoom: 10	    	
	    });    
	},
	
	configureLoading: function(){
	    this.vectors.loading = new Element('div', {'id': 'map-loading'}).adopt(
	    	new Element('h3', {'class': 'text', 'html': 'Loading'}),
	    	new Element('div', {'class': 'background'}).setOpacity(this.options.loading.opacity)
	    );	
	},
	
	configureTips: function(){
		this.tip = new Tips(this.options.tips);
	},
	
	configurePhotos: function(){
	    this.vectors.photos = new OpenLayers.Layer.Vector('Photos', {
		    strategies: [
		        new OpenLayers.Strategy.Fixed({ preload: true }),
		        new OpenLayers.Strategy.Cluster()
		    ],
		    protocol: new OpenLayers.Protocol.HTTP({
		        url: this.options.photos.url,
		        format: new OpenLayers.Format.GeoJSON({
	                'internalProjection': this.projection.internal,
	                'externalProjection': this.projection.external
	            })
		    }),
		    styleMap: new OpenLayers.StyleMap({
		        'default': new OpenLayers.Style(this.options.photos.styles.default, {
		            context: {
		                radius: this.options.photos.styles.radius
		            }
		        }),
		        'select': this.options.photos.styles.select
		    }),
		    eventListeners: this.events.photos
		});
		this.map.addLayer(this.vectors.photos);
		
		var hover = new OpenLayers.Control.SelectFeature(this.vectors.photos, {
			hover: true,
			callbacks: this.events.photos
		});
		this.map.addControl(hover);
		hover.activate();
	},
	
	reset: function(center){
		if (center) this.center = center;
		this.map.setCenter(this.center.coordinate, this.center.zoom);
	},
	
	getPixelFromGeometry: function(geometry){
        return this.map.getPixelFromLonLat(new OpenLayers.LonLat(geometry.x, geometry.y));  
	},
	
	onLoadStart: function(){
		this.vectors.loading.injectTop(this.element);
	},
	
	onLoadEnd: function(){
		this.vectors.loading.getLast().get('tween').start('opacity', 0).chain(function(){ this.vectors.loading.dispose(); }.bind(this));
		if (!this.bounded) this.bounded = true;
		this.map.zoomToExtent(this.boundary);
	},
	
	onPhotoAdded: function(event){
		if (!this.bounded) this.boundary.extend(event.feature.geometry);
	},
	
	onPhotoMouseEnter: function(event){
		var count = event.feature.attributes.count, position = this.element.getPosition();
		var element = new Element('div').store('tip:title', 'Count').store('tip:text', count + ' report' + ((count > 1) ? 's' : ''));
		
		event.page = this.getPixelFromGeometry(event.feature.geometry);
		event.page.x += position.x;
		event.page.y += position.y;
		this.tip.elementEnter(event, element);
	},
	
	onPhotoMouseLeave: function(event){
	    this.tip.elementLeave();
	},
	
	onPhotoClick: function(){
		// load pictures on the left bar
	},
	
	onPhotoDblClick: function(layer){
		var bounds = new OpenLayers.Bounds();
		layer.cluster.each(function(point){
			bounds.extend(point.geometry);
		});
		this.map.zoomToExtent(bounds, 1);
	},
	
	onMoveEnd: function(event){
	    this.tip.elementLeave();
	}

});

window.addEvent('load', function(){
    new Map('map', {
    	photos: {
    		url: HABWatch.Flickr.URL
    	}
    });
});