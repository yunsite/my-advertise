<script src="http://maps.google.com/maps?file=api&hl=zh-CN&ampv=2&sensor=false&key=ABQIAAAAebtL8DsH3pOYHMeMHyYLZhS5sBDahsynsAFLLxvfPqFBWBDr9xQ4XK7R7W8jm8GwzejcoG9mp3yM5w" type="text/javascript"></script>
<script type="text/javascript">
<!--
	function initialize(){

}

$(function(){

	var canvas = document.getElementById("map_canvas");
	  var map = new GMap2(canvas);

	  var center = new GLatLng(39.9493, 116.3975);
	  
	  map.setCenter(center, 13);

	  map.addControl(new GLargeMapControl());
	  map.addControl(new GMapTypeControl());


	  //可以连续缩放
	  map.enableContinuousZoom();
	  //支持滚轮缩放
	  map.enableScrollWheelZoom();
	  //支持双击缩放
	  map.doubleClickZoom();

	  //添加搜索栏
	  map.enableGoogleBar()



	// Create GPolylineOptions argument as an object literal.
	// Note that we don't use a constructor.

	var polyOptions = {geodesic:true};
	var polyline = new GPolyline([
	  new GLatLng(50, 120),
	  new GLatLng(30, 100)
	  ], "#ff0000", 10, 1, polyOptions);
	  map.addOverlay(polyline);  

//	  var polyline = new GPolyline([
//	                                new GLatLng(39.9493, 116.3975),
//	                                new GLatLng(39.9593, 116.4071)
//	                              ], "#ff0000", 10);
//	  map.addOverlay(polyline);
	  
	  
//	// Create our "tiny" marker icon
//	  var tinyIcon = new GIcon();
//	  tinyIcon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
//	  tinyIcon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
//	  tinyIcon.iconSize = new GSize(12, 20);
//	  tinyIcon.shadowSize = new GSize(22, 20);
//	  tinyIcon.iconAnchor = new GPoint(6, 20);
//	  tinyIcon.infoWindowAnchor = new GPoint(5, 1);
//
//	  // Set up our GMarkerOptions object literal
//	  markerOptions = { icon:tinyIcon };

//	  var marker = new GMarker(center,{draggable:true});
//
//	  GEvent.addListener(marker,"dragstart",function(){
//			map.closeInfoWindow();
//	  });
//
//	  GEvent.addListener(marker,"dragend",function(){
//			marker.openInfoWindowHtml("弹起来了");
//	  });

//	  map.addOverlay(marker);

//		弹出窗口
//	  map.openInfoWindow(center,document.createTextNode("Hello world"));
	//设置地图类型
//	  map.setMapType(G_DEFAULT_MAP_TYPES);
		 
	  // Add 10 markers to the map at random locations
	  var bounds = map.getBounds();
	  var southWest = bounds.getSouthWest();
	  var northEast = bounds.getNorthEast();
	  var lngSpan = northEast.lng() - southWest.lng();
	  var latSpan = northEast.lat() - southWest.lat();

	  
	  for (var i = 0; i < 10; i++) {
	    var point = new GLatLng(southWest.lat() + latSpan * Math.random(),southWest.lng() + lngSpan * Math.random());
	    map.addOverlay(new GMarker(point));
	  }
});
//-->
</script>
<div id="map_canvas" style="width: 550px; height: 350px"></div>