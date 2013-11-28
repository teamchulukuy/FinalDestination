<h3>Draw Jeepney Route</h3>

<div id="map" style=" height: 600px; border: 1px solid #ccc"></div>

<div id="latlon" style="margin: 0 auto; width:940px;"></div>
<!-- controls for the drawing!-->

    <button class="leaflet-div-icon" style="position:relative; top:-590px; left:850px; box-shadow: -1px 1px 5px 1px gray; -webkit-border-radius: 4px 4px 4px 4px;
            -moz-border-radius: 4px 4px 4px 4px;
            border-radius: 4px 4px 4px 4px; border:white;" onclick="connectToLast()">End route</button>


           

    <script>

        var firstPoint;
        var layer;
    
        var cloudmadeUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            cloudmade = new L.TileLayer(cloudmadeUrl, {maxZoom: 18}),
            map = new L.Map('map', {layers: [cloudmade], center: new L.LatLng(7.06819, 125.55725), zoom: 15 });

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);


        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polygon: {
                    title: 'Draw a sexy polygon!',
                    allowIntersection: false,
                    drawError: {
                        color: '#b00b00',
                        timeout: 1000
                    },
                    shapeOptions: {
                        color: '#bada55'
                    },
                    showArea: true
                },
                polyline: {
                    metric: false
                },
                circle: {
                    shapeOptions: {
                        color: '#662d91'
                    }
                }
            },
            edit: {
                featureGroup: drawnItems,
            }
        });
        map.addControl(drawControl);


        map.on('draw:created', function (e) {
            var type = e.layerType;
            layer = e.layer;
                
            if (type === 'marker') {
                layer.bindPopup('A popup!'); 
            }
            else if(type == 'polyline'){
                var latlons = layer.getLatLngs();
                //alert(latlons[latlons.length - 1]);
                eCurrent = latlons[latlons.length - 1];
            
                // var div=document.createElement("p");
                // // div.id="latlon";
                // // div.style="margin: 0 auto; width:940px;";

                // var t=document.createTextNode(layer.getLatLngs());
                
                //  div.appendChild(t);

                //  var element=document.getElementById("latlon");
                //  element.appendChild(t);
             
                //  document.body.appendChild(element);
            }

            drawnItems.addLayer(layer);

            
        });
        

         map.on('draw:edited', function (e) {
            var layers = e.layers;
            layers.eachLayer(function (layer) {
                //do whatever you want, most likely save back to db
                
                alert(layer.getLatLngs());
                
                var div=document.createElement("div");
                div.id="edited";
                div.style="margin: 0 auto; width:940px;";

                var t=document.createTextNode(layer.getLatLngs());
                
                 div.appendChild(t);
             
                document.body.appendChild(div);
            
                 
            });


        });


        var popup = L.popup();

        function onMapClick(e) {
            popup.setLatLng(e).setContent("<form action='' onsubmit='streetName()' id='routename'>Street Name: <input id='streetname'><button>save</button></form>" + e).openOn(map);
        }

        map.on('click', onMapClick);


        function streetName(){
            
            // var rname = this.getElementById('routename').submit();
            // alert(rname);

            //this.routename.submit();

             var div=document.createElement("p");
                // div.id="latlon";
                // div.style="margin: 0 auto; width:940px;";

             var t=document.createTextNode(layer.getLatLngs());
                
                 div.appendChild(t);

                 var element=document.getElementById("latlon");
                 element.appendChild(t);

                 // var route = 'ASasASas';
                 // element.appendChild(route);

                 document.body.appendChild(element);
        }


        function connectToLast(){
            if(layer != null){
                layer.addLatLng(firstPoint);
                eCurrent = null;
                firstPoint = null;
                layer = null;
            }
        }
        
    </script>




