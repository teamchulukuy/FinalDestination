<div class="">
	<div style="color:#0DC8B0;text-shadow: 0px 1px 0px rgba(255,255,255,.75);" class="Overlay"><h1 style="width:270px;">Welcome!</h1>
	<p style="color:gray; width:520px;">This admin panel has been generated by the TEAM CHULUKOY.</p>
	<!-- <p><a class="btn btn-primary btn-large" href="http://docs.fuelphp.com">Read the Docs</a></p> -->
	</div>
	<div id="map"></div>
</div>
<br>
<div class="row">
	<div class="span4">
		<?php echo Html::img('assets/img/frame-stripe.png', array('class' => 'frame-stripe')) ?>
	</div>
	<div class="span4">
		<?php echo Html::img('assets/img/frame-stripe.png', array('class' => 'frame-stripe')) ?>
	</div>
	<div class="span4">
		<?php echo Html::img('assets/img/frame-stripe.png', array('class' => 'frame-stripe')) ?>
	</div>
</div>

<div class="row">
	<div class="span4" id="bck">
		<div style="padding:12px">
		<h4>Jeepney Routes Updates</h4>
		
		<?php if ($jeepneyroutes): ?>

				<table class="table table-striped table-hover" >
					
					<tbody>
				<?php foreach ($jeepneyroutes as $jeepneyroute): ?>		<tr>

							<td><?php echo Html::anchor('admin/jeepneyroute/view/'.$jeepneyroute->id,$jeepneyroute->routename); ?></td>
							<td><?php echo $jeepneyroute->size." "."KB"; ?></td>
							
							<td><?php echo $jeepneyroute->created_at; ?></td>
							
						</tr>
				<?php endforeach; ?>	</tbody>
					
				</table>

		<?php endif; ?>

		</div>
		
	</div>

	<div class="span4" id="bck">
		<div style="padding:12px">
		<h4>Tricycle Routes Updates</h4>
		<?php if ($tricycleroutes): ?>

				<table class="table table-striped table-hover" >
					
					<tbody>
				<?php foreach ($tricycleroutes as $tricycleroute): ?>		<tr>

							<td><?php echo Html::anchor('admin/tricycleroute/view/'.$tricycleroute->id,$tricycleroute->routename); ?></td>
							<td><?php echo $tricycleroute->size." "."KB"; ?></td>
							
							<td><?php echo $tricycleroute->created_at; ?></td>
							
						</tr>
				<?php endforeach; ?>	</tbody>
					
				</table>

		<?php endif; ?>
		</div>
		
	</div>

	<div class="span4" id="bck">
		<div style="padding:12px">
		<h4>Landmark Updates</h4>
		<?php if ($landmarks): ?>

				<table class="table table-striped table-hover" >
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th>Ratings</th>
						</tr>	
					</thead>
					<tbody>
				<?php foreach ($landmarks as $landmark): ?>		<tr>

							<td><?php echo Html::anchor('admin/landmarks/view/'.$landmark->slug, Html::img('uploads/landmarks/icon/'.$landmark->fileurl,array('class' => 'image')));?></td>
							<td><?php echo $landmark->placename; ?></td>

							<?php foreach ($landmark->voteitems as $voteitem): ?>
							<td><?php echo $voteitem->votes/100 ."%"; ?></td>
							<?php endforeach; ?>
							
						</tr>
				<?php endforeach; ?>	</tbody>
					
				</table>

		<?php endif; ?>
		</div>
		
	</div>
</div>

<script>
		var map = L.map('map').setView([7.10000, 120.35725], 8);

		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 18,
		}).addTo(map);


		L.marker([7.06819, 125.55725]).addTo(map)
			.bindPopup("<b>Davao City</b><br />Welcome to Davao City!").openPopup();

		L.circle([7.06819, 125.55725], 500, {
			color: 'red',
			fillColor: '#f03',
			fillOpacity: 0.5
		}).addTo(map).bindPopup("I am a circle.");

		L.polygon([
			[51.509, -0.08],
			[51.503, -0.06],
			[51.51, -0.047]
		]).addTo(map).bindPopup("I am a polygon.");


		var popup = L.popup();

		function onMapClick(e) {
			popup
				.setLatLng(e.latlng)
				.setContent("You clicked the map at " + e.latlng.toString())
				.openOn(map);
		}

		map.on('click', onMapClick);

		//GeoSearch function

		function getURLParameter(name) {
		    return decodeURI(
		        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,])[1]
		    );
		}

		var regionParameter = getURLParameter('region');
		var region = (regionParameter === 'undefined') ? '' : regionParameter;

		new L.Control.GeoSearch({
            provider: new L.GeoSearch.Provider.Google({
            	region: region
            })
        }).addTo(map);

	</script>
