<?php require("header.inc.php") ?>

<!-- filters panel --> 
<form action="my-content.php" method="post">

	<div>
	Show these tags: <?php 
		$tagid = 0; 
		foreach ($tags as $tag) {
			
			echo <<<EOM
				<div><input type="checkbox" name="tag$tagid" value="$tag" checked="$checked" /><label for="tag$tagid">$tag</label></div>
EOM;
			++$tagid;
		} ?>
	</div>
	<div>
		Show:
		<div><input type="checkbox" name="show_pics" /><label for="show_pics">Pictures</label></div>
		<div><input type="checkbox" name="show_videos" /><label for="show_videos">Videos</label></div>
	</div>


</form>


<!-- set-properties panel --> 

<form action="set-properties.php" method="post">

<div>
	<div class="thumbnail"><img src="$url" /></div>
	<h2>$filename</h2>
	<p>Privacy: 
		<input type="radio" name="privacy$id" class="ck-pub" value="public" selected="selected" /><label for="privacy$id">Public</label>
		<input type="radio" name="privacy$id" class="ck-pri" value="private" /><label for="privacy$id">Private</label>
	</p>
	<p>Tags:
		<input type="text" name="tags$id" value="" />
</div>


</form>