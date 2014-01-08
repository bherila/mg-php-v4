<?php require('header.inc.php'); ?

<p>Please set the privacy and subject properties of your uploaded images. You can also tag your images. </p>

<form action="set-properties.php" method="post">

<div>
	<div class="thumbnail"><img src="$url" /></div>
	<h2>$filename</h2>
	<p>Privacy: 
		<input type="radio" name="privacy$id" value="public" selected="selected" /><label for="privacy$id">Public</label>
		<input type="radio" name="privacy$id" value="private" /><label for="privacy$id">Private</label>
	</p>
	<p>Subjects:
		<input type="checkbox" name="m$id" value="1" /><label for="m$id">Male</label>
		<input type="checkbox" name="f$id" value="1" /><label for="f$id">Female</label></p>
	<p>Tags:
		<input type="text" name="tags$id" value="" />
</div>


</form>