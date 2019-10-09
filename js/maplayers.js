var canvasFunction = function(extent, resolution, pixelRatio, size, projection) {
	scale = pixelRatio;
	canvas = document.createElement('canvas');
	context = canvas.getContext('2d');
	width = Math.round(size[0]), height = Math.round(size[1]);
	canvas.setAttribute('width', scale*width);
	canvas.setAttribute('height', scale*height);
	
	// Canvas extent is different than map extent, so compute delta between 
	// left-top of map and canvas extent.
	var mapExtent = map.getView().calculateExtent(map.getSize())
	var mapOrigin = map.getPixelFromCoordinate([mapExtent[0], mapExtent[3]]);
	canvasOrigin = map.getPixelFromCoordinate([extent[0], extent[3]]);
	delta = [mapOrigin[0]-canvasOrigin[0], mapOrigin[1]-canvasOrigin[1]]
	
	var xhr = new XMLHttpRequest();
	xhr.open('GET', '/data/sensors_json.php', true);
	xhr.responseType = 'json';
	xhr.onload = function() {
		var status = xhr.status;
		if (status == 200) {
			drawHeatmap(context, map, xhr.response, 1000, 'legend');
		}
	};
	xhr.send();
	return canvas;
};

var hittekaart = new ol.layer.Image({
	source: new ol.source.ImageCanvas({
		canvasFunction: canvasFunction
	}),
	visible: false,
	title: 'hittekaart'
});

hittekaart.on('change:visible', function(){
	document.getElementById('legend').style.visibility = hittekaart.getVisible() ? 'visible' : 'hidden';
});
