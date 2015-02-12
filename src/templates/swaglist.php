<a href="main/logout">logout</a><br/><br/>

<h1>These are swagmaps</h1>

<ul>
	<?php foreach ($swagmaps as $swagmap) { ?>
		<li>
			<a href="main/showmap?filename=<?php echo urlencode($swagmap["filename"]); ?>">
				<?php print_r($swagmap["title"]); ?>
			</a>
		</li>
	<?php } ?>
</ul>
