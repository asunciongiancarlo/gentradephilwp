function bugspatrol_googlemap_init(dom_obj, coords) {
	"use strict";
	if (typeof BUGSPATROL_STORAGE['googlemap_init_obj'] == 'undefined') bugspatrol_googlemap_init_styles();
	BUGSPATROL_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		BUGSPATROL_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: BUGSPATROL_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
		
		bugspatrol_googlemap_create(id);

	} catch (e) {
		
		//dcl(BUGSPATROL_STORAGE['strings']['googlemap_not_avail']);

	};
}

function bugspatrol_googlemap_create(id) {
	"use strict";

	// Create map
	BUGSPATROL_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(BUGSPATROL_STORAGE['googlemap_init_obj'][id].dom, BUGSPATROL_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers)
		BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	bugspatrol_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].map)
			BUGSPATROL_STORAGE['googlemap_init_obj'][id].map.setCenter(BUGSPATROL_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function bugspatrol_googlemap_add_markers(id) {
	"use strict";
	for (var i in BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (BUGSPATROL_STORAGE['googlemap_init_obj'].geocoder == '') BUGSPATROL_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			BUGSPATROL_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			BUGSPATROL_STORAGE['googlemap_init_obj'].geocoder.geocode({address: BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = BUGSPATROL_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					BUGSPATROL_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						bugspatrol_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(BUGSPATROL_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: BUGSPATROL_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].title;
			BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				BUGSPATROL_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				BUGSPATROL_STORAGE['googlemap_init_obj'][id].map.setCenter(BUGSPATROL_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								BUGSPATROL_STORAGE['googlemap_init_obj'][id].map,
								BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			BUGSPATROL_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function bugspatrol_googlemap_refresh() {
	"use strict";
	for (id in BUGSPATROL_STORAGE['googlemap_init_obj']) {
		bugspatrol_googlemap_create(id);
	}
}

function bugspatrol_googlemap_init_styles() {
	"use strict";
	// Init Google map
	BUGSPATROL_STORAGE['googlemap_init_obj'] = {};
	BUGSPATROL_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.bugspatrol_theme_googlemap_styles!==undefined)
		BUGSPATROL_STORAGE['googlemap_styles'] = bugspatrol_theme_googlemap_styles(BUGSPATROL_STORAGE['googlemap_styles']);
}