<!DOCTYPE html>
<html>
	<head>
	    <base href="<?php echo $baseUrl; ?>"/>
		<script src="extern/swagmapviewer/extern/p5.js"></script>
		<script src="extern/swagmapviewer/extern/tincan.js"></script>
		<script src="extern/swagmapviewer/bin/swagmap.min.js"></script>
		<style> 
			body {
				padding: 0; 
				margin: 0;
				overflow: hidden;
			}
		</style>
		<script>
			var xApiParams={
				endpoint: "<?php echo $xapiEndpoint; ?>",
				username: "<?php echo $xapiUsername; ?>",
				password: "<?php echo $xapiPassword; ?>"
			};

			var app=new SwagMap();
			app.setXApiStore(xApiParams);
			app.setActorEmail("<?php echo $actorEmail; ?>");
			app.setMapUrl("<?php echo $mapUrl; ?>");
			app.run();
			</script>
	</head>
	<body>
	</body>
</html>