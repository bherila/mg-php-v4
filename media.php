<?php require('header.inc.php'); ?>

<div class="row"> 
<div class="span3">
<div class="well sidebar-nav">

</div>
</div>
<div class="span9">

<?php
$queryResults = R::find('media', 'mediaid = ?', array($_REQUEST['id']));
$found = false;
foreach ($queryResults as $iid => $entity) {
	$found = true;
	$file = $entity->file;
	if (strcmp($entity->type, 'img') == 0)
	{
		?>
		<h1><?php htmlentities($title, ENT_XHTML); ?></h1>
		<p><img src="data/<?php echo($file); ?>" alt="" /></p>
		
		<?php
	}
	elseif(strcmp($entity->type, 'mp4') == 0
		|| strcmp($entity->type, 'flv') == 0
		|| strcmp($entity->type, 'wmv') == 0 )
	{
		$w = 0 + $entity->width;
		$h = 0 + $entity->height;
		if ( is_null($w) || $w <= 1 ) { $w = 640; }
		if ( is_null($h) || $h <= 1 ) { $h = 480; }
		?>
		<script type="text/javascript" src="https://media.dreamhost.com/mp5/jwplayer.js"></script>
		<div id="mediaspace">Loading</div>
		<script type="text/javascript">
		  jwplayer('mediaspace').setup({
			'flashplayer': 'https://media.dreamhost.com/mp5/player.swf',
			'file': '/serve-file.php?filename=<?php echo($file); ?>',
			'controlbar': 'bottom',
			'width': '470',
			'height': '320'
		  });
		</script>
		<?php
	}
	else
	{
		?>
		<h1>Error</h1>
		<p>Unsupported media type: <?php echo($entity->type); ?></p>
		<hr />
		<pre><?php print_r($entity); ?></pre>
		<?php
	}
	
	?>
	<h3>Comments</h3>
	<!-- TODO: Display comments here -->
	<form action="media.php?id=<?php echo $_REQUEST['id']; ?>&action=post" method="post">
	
	<button type="submit" class="btn btn-primary">Post Comment</button>
	</form>
	<?
}
if ($found == false) {
	?>
	<h1>Error: Not found</h1>
	<p>The item you requested was not found. </p>
	<?php 
} 
?>
</div>
</div>