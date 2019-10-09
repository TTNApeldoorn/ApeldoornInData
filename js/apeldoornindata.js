function init() {
	proj4.defs("EPSG:28992","+proj=sterea +lat_0=52.15616055555555 +lon_0=5.38763888888889 +k=0.9999079 +x_0=155022 +y_0=463015 +ellps=bessel +towgs84=565.417,50.3319,465.552,-0.398957,0.343988,-1.8774,4.0725 +units=m +no_defs");
	
	var projection = new ol.proj.Projection('EPSG:28992');
	var projectionExtent = [-285401.92,22598.08,595401.92,903402.0];
	var size = ol.extent.getWidth(projectionExtent) / 256;
	
	// generate resolutions and matrixIds arrays for PDOK WMTS
	var resolutions = [3440.64, 1720.32, 860.16, 430.08, 215.04, 107.52, 53.76, 26.88, 13.44, 6.72, 3.36, 1.68, 0.84, 0.42]
	var matrixIds = new Array(14);
	for (var z = 0; z < 15; ++z) matrixIds[z] = 'EPSG:28992:' + z;
	
	// get last hour sensor data
	var sensorHourDataSource = new ol.source.GeoJSON({
		url: 'data/sensors_json.php',
		defaultProjection: 'EPSG:4326',
		projection: 'EPSG:28992'
	});
	
	var sensorHourStyleCache = {};
	var sensorHourDataLayer = new ol.layer.Vector({
		title: 'sensoren laatste 24 uur',
		source: new ol.source.Cluster({
			distance: 40,
			source: sensorHourDataSource,
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
	var sensorAllDataSource = new ol.source.GeoJSON({
		url: 'data/sensors_json.php?select=all',
		defaultProjection: 'EPSG:4326',
		projection: 'EPSG:28992'
	});
	
	var sensorAllStyleCache = {};
	var sensorAllDataLayer = new ol.layer.Vector({
		visible: false,
		title: 'sensoren alles',
		source: new ol.source.Cluster({
			distance: 40,
			source: sensorAllDataSource,
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
	
	
	var url = 'https://geodata1.nationaalgeoregister.nl/luchtfoto/wmts/luchtfoto_png/nltilingschema/';
	var tileUrlFunction = function(tileCoord, pixelRatio, projection) {
		var zxy = tileCoord;
		if (zxy[1] < 0 || zxy[2] < 0) return "";
		return url +
			zxy[0].toString()+'/'+ zxy[1].toString() +'/'+
			((1 << zxy[0]) - zxy[2] - 1).toString() +'.png';
	};
	
	luchtfoto = new ol.layer.Tile({
		title: 'Luchtfoto',
		type: 'base',
		visible: false,
		source: new ol.source.TileImage({
			attributions: [
				new ol.Attribution({
					html: 'Kaartgegevens: <a href="http://creativecommons.org/licenses/by-nc/3.0/nl/">CC-BY-NC</a> <a href="http://www.pdok.nl">PDOK</a>.'
				})
			],
			projection: 'EPSG:28992',
			tileGrid: new ol.tilegrid.TileGrid({
				origin: [-285401.92,22598.08],
				resolutions: resolutions
			}),
			tileUrlFunction: tileUrlFunction
		}),
	});
	
	var topografie = new ol.layer.Tile({
		title: 'Topografie',
		type: 'base',
		visible: true,
		source: new ol.source.WMTS({
			url: 'https://geodata.nationaalgeoregister.nl/tiles/service/wmts/brtachtergrondkaart',
			layer: 'brtachtergrondkaart',
//			url: 'http://geodata.nationaalgeoregister.nl/tiles/service/wmts/brtachtergrondkaartgrijs',
//			layer: 'brtachtergrondkaartgrijs',
			attributions: [
				new ol.Attribution({
					html: 'Kaartgegevens: <a href="https://creativecommons.org/licenses/by-sa/4.0/deed.nl">CC-BY-SA</a> <a href="http://www.osm.org">OSM</a> & <a href="http://www.kadaster.nl">Kadaster</a>.'
				})
			],
			matrixSet: 'EPSG:28992',
			format: 'image/png',
			tileGrid: new ol.tilegrid.WMTS({
				origin: ol.extent.getTopLeft(projectionExtent),
				resolutions: resolutions,
				matrixIds: matrixIds
			})
		}),
	});
	
	var ahn = new ol.layer.Tile({
		title: 'AHN',
		type: 'base',
		visible: false,
		source: new ol.source.WMTS({
			url: 'https://geodata.nationaalgeoregister.nl/tiles/service/wmts/ahn2',
			layer: 'ahn2_05m_ruw',
//			url: 'http://geodata.nationaalgeoregister.nl/tiles/service/wmts/ahn3',
//			layer: 'ahn3_05m_dtm',
			attributions: [
				new ol.Attribution({
					html: 'Kaartgegevens: <a href="http://creativecommons.org/publicdomain/zero/1.0/deed.nl">CC-0</a> <a href="www.ahn.nl">AHN</a>.'
				})
			],
			matrixSet: 'EPSG:28992',
			format: 'image/png',
			tileGrid: new ol.tilegrid.WMTS({
				origin: ol.extent.getTopLeft(projectionExtent),
				resolutions: resolutions,
				matrixIds: matrixIds
			})
		}),
	});
	
	// Create the map
	var map = new ol.Map({
		target: 'map',  // The DOM element that will contains the map
		renderer: 'canvas', // Force the renderer to be used
		layers: [
			new ol.layer.Group({
				title: 'Achtergrond',
				layers: [
					luchtfoto,
//					ahn,
					topografie
				]
			}),
			new ol.layer.Group({
				title: 'Kaartlagen',
				layers: [
					sensorAllDataLayer,
					sensorHourDataLayer
				]
			})
		],
		projection: 'EPSG:28992',
		view: new ol.View({
//			center: ol.extent.getCenter(projectionExtent),
			center: ol.proj.transform([5.967979, 52.209711], 'EPSG:4326', 'EPSG:28992'),
			zoom: 14
		})
	});
	
	var layerSwitcher = new ol.control.LayerSwitcher({
		tipLabel: 'Legenda'
	});
	map.addControl(layerSwitcher);
	
	// -- Display information on singleclick --
	
	// Create a popup overlay which will be used to display feature info
	var popup = new ol.Overlay.Popup();
	map.addOverlay(popup);
	
	// Add an event handler for the map "singleclick" event
	map.on('singleclick', function(evt) {
		// Hide existing popup and reset it's offset
		popup.hide();
		popup.setOffset([0, 0]);
		
		// Attempt to find a feature in one of the visible vector layers
//		alert(evt.pixel);
		var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature, layer) {
//			alert(layer);
//			alert(feature);
			return feature;
		});
		
		if (feature != null) {
		    feature = feature.get('features')[0];

		    if (feature) {
		        var coord = feature.getGeometry().getCoordinates();
		        var props = feature.getProperties();
		        var info;
		        if (feature != null) {
		            info = '<h2>' + feature.o[0].location + '</h2>';
		            info += '<i>' + feature.o[0].timestamp + '</i><br/>';
		            var arrayTags = $.map(feature.o, function (value, index) {
		                return [value];
		            });
		            for (index = 0; index < arrayTags.length; ++index) {
		                if (arrayTags[index].name != undefined && arrayTags[index].value != undefined) {
		                    info += arrayTags[index].name + ': ' + arrayTags[index].value + '<br/>';
		                }
		            }
		        }
		        // Offset the popup so it points at the middle of the marker not the tip
		        popup.setOffset([10, -60]);
		        popup.show(coord, info);
		    }
		}
	});
}

var thisPage;
function showPage(url) {
	if (url && thisPage!==url) {
		thisPage = url;
		document.getElementById('textframe').style.visibility = 'visible';
		
		var request = window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject('Microsoft.XMLHTTP');
		request.onreadystatechange = function() {
			if(request.readyState == 4) {
				document.getElementById('frame').style.display = 'block';
				document.getElementById('textframe').innerHTML = request.responseText;
			}
		}
		request.open('GET', url, true);
		request.send(null);
	}
	else {
		document.getElementById('frame').style.display = 'none';
		thisPage = '';
	}
	
	menuItems = document.getElementsByTagName('menu');
	for(i=0; i<menuItems.length; i++) if (menuItems[i].getAttribute('id')==page) menuItems[i].setAttribute('class', 'menuSelected');
	else menuItems[i].setAttribute('class', 'menuDefault');
}

function toggleMenu() {
	menu = document.getElementById('menu');
	if (menu.style.display == 'block') menu.style.display = 'none';
	else menu.style.display = 'block';
}
