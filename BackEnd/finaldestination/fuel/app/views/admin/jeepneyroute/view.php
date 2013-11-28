<?php echo Html::img('assets/img/frame-top.png', array('class' => 'frame-top')) ?>
<h4 style="margin-left:15px;"><?php echo $jeepneyroute->routename; ?></h4>
<br><br>
<div id="map"></div>
<br>

<div class="row">
	<div class="span4" id="c-img">
		<div class="inner-cont">
			<p>
				<strong>Filename:</strong>
				<?php echo $jeepneyroute->filename; ?></p>
			<p>
				<strong>Size:</strong>
				<?php echo $jeepneyroute->size.'KB'; ?></p>
			<p>
				<strong>Type:</strong>
				<?php echo $jeepneyroute->type; ?></p>
			<p>
				<strong>Route Description:</strong>
				<?php echo $jeepneyroute->routedesc; ?></p>

			<p>
				<strong>Uploaded at:</strong>
				<?php echo $jeepneyroute->created_at; ?></p>
		</div>
	</div>
</div>

<script>

		var map = L.map('map').setView([7.06819, 125.55725], 9);

		L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			maxZoom: 18,
		}).addTo(map);

		var url = 'http://finaldestination.dev/uploads/jeepneyroute/'+'<?php echo $jeepneyroute->filename; ?>'; // URL to your GPX file
		new L.GPX(url, {
		  async: true,
		  marker_options: {
		    startIconUrl: 'images/pin-icon-start.png',
		    endIconUrl: 'images/pin-icon-end.png',
		    shadowUrl: 'images/pin-shadow.png'
		  }
		}).on('loaded', function(e) {
		  map.fitBounds(e.target.getBounds());
		}).addTo(map);
</script>


<?php echo Html::anchor('admin/jeepneyroute/edit/'.$jeepneyroute->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/jeepneyroute', 'Back'); ?>