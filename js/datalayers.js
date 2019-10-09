// get last hour sensor data
var sensorHourStyleCache = {};
var sensorHourDataLayer = new ol.layer.Vector({
	title: 'sensoren vandaag',
	source: new ol.source.Cluster({
		distance: 40,
		source: new ol.source.Vector({
		    url: 'data/sensors_json.php',
			defaultProjection: 'EPSG:4326',
			projection: 'EPSG:28992',
			format: new ol.format.GeoJSON()
		})
	}),
	style: function(feature, resolution) {
		var size = feature.get('features').length;
		var style = sensorHourStyleCache[size];
		if (!style) {
			var label = '';
			if (size>1) label = size.toString();
			style = [new ol.style.Style({
				image: new ol.style.Icon(({
					scale: 0.4,
					anchor: [0, 1.0],
					anchorXUnits: 'fraction',
					anchorYUnits: 'fraction',
					opacity: 0.75,
					src: 'images/sensor.png'
				})),
				text: new ol.style.Text({
					text: label,
					offsetX: 5,
					offsetY: -6,
					fill: new ol.style.Fill({
						color: '#000'
					})
				})
			})];
			sensorHourStyleCache[size] = style;
		}
		return style;
	}
});

// get all sensor data
var sensorAllStyleCache = {};
var sensorAllDataLayer = new ol.layer.Vector({
	visible: false,
	title: 'sensoren alles',
	source: new ol.source.Cluster({
		distance: 40,
		source: new ol.source.Vector({
		    url: 'data/sensors_json.php?select=all',
			defaultProjection: 'EPSG:4326',
			projection: 'EPSG:28992',
			format: new ol.format.GeoJSON()
		})
	}),
	style: function(feature, resolution) {
		var size = feature.get('features').length;
		var style = sensorAllStyleCache[size];
		if (!style) {
			var label = '';
			if (size>1) label = size.toString();
			style = [new ol.style.Style({
				image: new ol.style.Icon(({
					scale: 0.4,
					anchor: [0, 1.0],
					anchorXUnits: 'fraction',
					anchorYUnits: 'fraction',
					opacity: 0.75,
					src: 'images/sensor.png'
				})),
				text: new ol.style.Text({
					text: label,
					offsetX: 5,
					offsetY: -6,
					fill: new ol.style.Fill({
						color: '#000'
					})
				})
			})];
			sensorAllStyleCache[size] = style;
		}
		return style;
	}
});

// get getways
var gatewayStyleCache = {};
var gatewayDataLayer = new ol.layer.Vector({
    title: 'gateways',
    source: new ol.source.Cluster({
        distance: 40,
        source: new ol.source.Vector({
            url: 'data/gateways_json.php',
            defaultProjection: 'EPSG:4326',
            projection: 'EPSG:28992',
            format: new ol.format.GeoJSON()
        })
    }),
    style: function (feature, resolution) {
        var size = feature.get('features').length;
        var style = gatewayStyleCache[size];
        if (!style) {
            var label = '';
            if (size > 1) label = size.toString();
            style = [new ol.style.Style({
                image: new ol.style.Icon(({
                    scale: 1,
                    anchor: [0.5, 1],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'fraction',
                    opacity: 0.75,
                    src: 'images/ttn.png'
                })),
                text: new ol.style.Text({
                    text: label,
                    offsetX: 0,
                    offsetY: 0,
                    fill: new ol.style.Fill({
                        color: '#000'
                    })
                })
            })];
            gatewayStyleCache[size] = style;
        }
        return style;
    }
});

function dataPopups(evt) {
	// Hide existing popup and reset it's offset
	popup.hide();
	popup.setOffset([0, 0]);
	
	// Attempt to find a feature in one of the visible vector layers
	var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
		return feature;
	});
	
	//feature = feature.get('features')[0];
	
    // if (feature) {
    // 	var coord = feature.getGeometry().getCoordinates();
    // 	var props = feature.getProperties();
    // 	var info;
    // 	if (feature != null) {
    // 	    info = '<h2>' + feature.o[0].location + '</h2>';
    // 	    info += '<i>' + feature.o[0].timestamp + '</i><br/>';
    // 	    var arrayTags = $.map(feature.o, function (value, index) {
    // 	        return [value];
    // 	    });
    // 	    for (index = 0; index < arrayTags.length; ++index) {
    // 	        if (arrayTags[index].name != undefined && arrayTags[index].value != undefined) {
    // 	            info += arrayTags[index].name + ': ' + arrayTags[index].value + '<br/>';
    // 	        }
    // 	    }
    // 	}
    // 	// Offset the popup so it points at the middle of the marker not the tip
    // 	popup.setOffset([10, -60]);
    // 	popup.show(coord, info);
    // }
	if (feature != null) {
	    feature = feature.get('features')[0];

	    if (feature) {
	        console.log('Click');
	        var coord = feature.getGeometry().getCoordinates();
	        var props = feature.getProperties();
	        var info;
	        if (feature != null) {
	            if (feature.N[0].type == 'sensor') {
	                info = '<p width="800" height="800">';
	                info += '<h2>' + feature.N[0].location + '</h2>';
	                info += '<i>' + feature.N[0].timestamp + '</i><br/>';
	                var arrayTags = $.map(feature.S, function (value, index) {
	                    return [value];
	                });
	                for (index = 0; index < arrayTags.length; ++index) {
	                    if (arrayTags[index].name != undefined && arrayTags[index].value != undefined) {
	                        info += arrayTags[index].name + ': ' + arrayTags[index].value + '<br/>';
	                    }
	                }
	                info += '<iframe src="https://apeldoornindata.nl/data/chart.php?id=' + feature.N[0].nodeid + '" frameborder="0" height="100" scrolling="no"></iframe>';
	                info += '<a href="https://apeldoornindata.nl/data/node.php?id=' + feature.N[0].nodeid + '">Data</a><br/>';
	                info += '</p>';
	            } else {
	                info = '<p width="800" height="300">';
	                info += '<b>' + feature.N[0].location + '</b><br/>';
	                info += '<i>' + feature.N[0].timestamp + '</i><br/>';
	                var arrayTags = $.map(feature.S, function (value, index) {
	                    return [value];
	                });
	                info += '<a href="http://ttnmapper.org/?gateway=' + feature.N[0].location.replace("eui-", "").toUpperCase() + '&type=radar" target="_blanc">TTN Mapper</a><br/>';
	                info += '</p>';
	            }
	        }
	        // Offset the popup so it points at the middle of the marker not the tip
	        popup.setOffset([10, -60]);
	        popup.autoSize = false;
	        //popup.setSize(new ol.source.size(500, 300));
	        popup.show(coord, info);
	    }
	} else {
	    console.log('null object');
	}
}
