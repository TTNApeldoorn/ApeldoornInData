<!DOCTYPE html>
<html>
	<head>
		<title>Apeldoorn in Data</title>
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Load OpenLayers and plugins: popup, layerswitcher -->
		<link rel="stylesheet" href="https://openlayers.org/en/v4.6.5/css/ol.css" type="text/css">
		<script src="https://openlayers.org/en/v4.6.5/build/ol.js"></script>		
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.4.3/proj4.js" type="text/javascript"></script>
		<script src="https://epsg.io/28992-1753.js"></script>
		
		<link rel="stylesheet" href="https://rawgit.com/walkermatt/ol3-popup/master/src/ol3-popup.css" type="text/css">
		<script src="https://rawgit.com/walkermatt/ol3-popup/master/src/ol3-popup.js"></script>
		
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/openlayers.layerswitcher/1.1.0/ol3-layerswitcher.css" type="text/css">
		<script src="https://cdn.jsdelivr.net/openlayers.layerswitcher/1.1.0/ol3-layerswitcher.js"></script>
		
		<!-- Load Apeldoorn In Data javascript and stylesheet -->
		<link rel="stylesheet" type="text/css" href="style/apeldoornindata.css" media="all" />
		<!-- <script src="js/apeldoornindata.js"></script> -->
		
		<script src="js/mapfunctions.js"></script>
		<script src="js/backgroundlayers.js"></script>
		<script src="js/datalayers.js"></script>
		<script src="js/maplayers.js"></script>
		
		<?php
		include('data/headinclude.php');
		?>

	</head>
	<body id="body" style="text-align: center; margin:0px; ">
	<?php
	
	include('data/db.php');
	include('data/menu.php');
	//echo '<div class="container">'."\n";
	?>
		<!--[if lt IE 10]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		
		<div id="map">
			<div id="popup" class="ol-popup">
				<a href="#" id="popup-closer" class="ol-popup-closer"></a>
				<div id="popup-content"></div>
			</div>
		</div>
		<div id="logo">
			<img src="images/logo.png" width="100%"/>
		</div>
		<div id="legend">
		</div>
		<script>
			"use strict";
			
			var data = null;
			var canvas;
			var context;
			var canvasOrigin;
			var delta;
			var width;
			var height;
			var bbox;
			var timer = null;
			var map;
			
			// code to rescale map and ahn overlay when zooming or changing window size
			function redisplay() {
				// clear canvas
				if (context) {
					var imgData = context.getImageData(0,0,width,height);
					for(var i=0;i<imgData.length;i++) imgData[i] = 0;
					context.putImageData(imgData,0,0);
					map.renderSync();
				}
				// draw heatmap
				if (data!=null) drawHeatmap(context, map, data, 'legend');
			}
			
			var canvasFunction = function(extent, resolution, pixelRatio, size, projection) {
				canvas = document.createElement('canvas');
				context = canvas.getContext('2d');
				width = Math.round(size[0]), height = Math.round(size[1]);
				canvas.setAttribute('width', width);
				canvas.setAttribute('height', height);
				
				// Canvas extent is different than map extent, so compute delta between 
				// left-top of map and canvas extent.
				var mapExtent = map.getView().calculateExtent(map.getSize())
				var mapOrigin = map.getPixelFromCoordinate([mapExtent[0], mapExtent[3]]);
				canvasOrigin = map.getPixelFromCoordinate([extent[0], extent[3]]);
				delta = [mapOrigin[0]-canvasOrigin[0], mapOrigin[1]-canvasOrigin[1]]
				
				return canvas;
			};
			
			var heatmap = new ol.source.ImageCanvas({
				canvasFunction: canvasFunction
			});
			
			map = new ol.Map({
				target: 'map',
				renderer: 'canvas', // Force the renderer to be used
				layers: [
					new ol.layer.Group({
						title: 'Achtergrond',
						layers: [
							topografie,
							luchtfoto,
							ahn
						]
					}),
					//new ol.layer.Group({
					//	title: 'Kaarten',
					//	layers: [
					//		hittekaart
					//	]
					//}),
					new ol.layer.Group({
						title: 'Data',
						layers: [
							gatewayDataLayer,
							sensorAllDataLayer,
							sensorHourDataLayer
						]
					})
				],
				view: new ol.View({
					center: ol.proj.transform([5.967808, 52.210973], 'EPSG:4326', 'EPSG:900913'),
					zoom: 13
				})
			});
			
			// add layer switcher
			var layerSwitcher = new ol.control.LayerSwitcher();
			map.addControl(layerSwitcher);
			
			// add data popup routines
			var popup = new ol.Overlay.Popup();
			map.addOverlay(popup);
			map.on('singleclick', dataPopups);
			
			// callback routines for zoom and drag operations
			map.getView().on('propertychange', function(e) {
				switch (e.key) {
					case 'zoom':
					case 'center':
					case 'resolution':
						redisplay();
						break;
				}
			});
			window.addEventListener("resize", redisplay);
			
			function selectSlam(id, reload = false) {
				if (!reload && context) heatmap.refresh();
				
				var xhttp = new XMLHttpRequest();
				if (data==null) document.getElementById('download').innerHTML = 'data ophalen...';
				xhttp.open('GET', 'slamdata_json.php?date='+id, true);
//				xhttp.open('GET', 'slamdata_json.php?date='+id+'&calibrate', true);
				xhttp.responseType = 'json';
				xhttp.onload = function() {
					if (xhttp.status == 200) {
						data = xhttp.response;
						
						document.getElementById('download').innerHTML = '<input type="button" onclick="window.open(\'http://www.meetjestad.net/data/slamdata.php?date=' + id + '\', \'_blank\');" value="ga naar data"/>';
						
						if (!reload) focusMapOnData(map, data);
						drawHeatmap(context, map, data, 'legend');
						
						if (timer) clearInterval(timer);
						timer = setInterval(function(){selectSlam(id, true);}, 10000);
					}
				};
				xhttp.send();
			}
		</script>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-100353310-1', 'auto');
			ga('send', 'pageview');
		</script>
		<script type="text/javascript">
			window.smartlook||(function(d) {
			var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
			var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
			c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
			})(document);
			smartlook('init', 'ec0a1db895268f5147945b6ff6c3e176bd0006a6');
		</script>
		<?php
		
		include('data/jsendinclude.php');
		?>
	</body>
</html>
