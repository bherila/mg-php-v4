<?php require('header.inc.php'); ?>

<h1>Browse Content</h1>

<?php
function qAnd($c1, $c2) { return "(($c1) AND ($c2))"; }
function qOr($c1, $c2) { return "(($c1) OR ($c2))"; }

function cb($name, $label) 
{
	$checkedDef = (isset($_REQUEST[$name]) && $_REQUEST[$name] == '1') ? 'checked="checked"' : '';
	$cbHtml = <<<EOD
	<label class="checkbox" for="$name">$label
	<input type="checkbox" value="1" name="$name" id="$name" $checkedDef /></label>
EOD;
	echo(trim($cbHtml));
}

$filter = "1";

/* deprecated
$mSel = (isset($_REQUEST["g_m"]) && $_REQUEST["g_m"] == '1');
$fSel = (isset($_REQUEST["g_f"]) && $_REQUEST["g_f"] == '1');
*/ 

$includeVideos = (isset($_REQUEST['ti']) && $_REQUEST['ti'] == '1');
$includePhotos = (isset($_REQUEST['tv']) && $_REQUEST['tv'] == '1');


require_once('rb.php');
R::setup();
$bean = NULL; // TODO: Load from RB.

if (isset($_REQUEST["a"]) && $_REQUEST["a"] != "post") {
    // TODO: load preferences from profile
} else {
    // TODO: save preferences loaded from $_REQUEST to profile
    // R::store($bean);
}

// build query
$filterTmp = '0';

/* 
DEPRECATED
if ($fSel || $mSel) // else don't care for M/F
    $filter = qAnd($filter, $filterTmp);
*/ 
	
?>

<form action="gallery.php">
<input type="hidden" name="a" value="post" /><!-- postback indicator -->
<div class="row"> 
<div class="span3">
<div class="well sidebar-nav">
	<ul class="nav nav-list">
	
	<li class="nav-header">Media Type</li>
	<li><?php cb("ti", "Image");       ?></li>
	<li><?php cb("tv", "Video");       ?></li>
		
	<li class="nav-header">Required Tags</li>
	<li><input name="tag" type="text" class="tag-entry side-input" /></li>
	
	<li class="nav-header">Exclude Tags</li>
	<li><input name="xtag" type="text" class="tag-entry side-input" /></li>
	
	<li class="nav-header">Submit</li>
	<li><button class="btn btn-primary" type="submit"><i class="icon-refresh icon-white"></i>Update</button></li>
	
	</ul>
</div>
</div>
<div class="span9">
	<?php
		$limit1 = isset($_REQUEST['page']) ? 0 + $_REQUEST['page'] : 0;
		$query = "select * from media limit $limit1,50";// where ' . $filter;
		echo($query);
	?>
	<ul class="thumbnails">
	<?php

		$result = R::getAll($query);
		foreach ($result as $i) {
			$id = $i['mediaid'];
			$thumb = $i['file'];
			echo <<<EOD
			<li>
				<a href="media.php?id=$id">
					<div style="width: 160px; height: 120px; overflow: hidden;">
					<img src="thumbs/$thumb" alt="" border="0" />
					</div>
				</a>
				<h5>label</h5>
				<p>caption</p>
			</li>
EOD;
		}
	?>
	</ul>
</div>
</div>
</form>
<!--
<div class="modal" id="myModal">
  <div class="modal-header">
    <button class="close" data-dismiss="modal">×</button>
    <h3>Add Tags</h3>
  </div>
  <div class="modal-body">
	<?php 
	if (isset($tags))
	foreach ($tags as $tag) {
		cb('si_' . $tag, $tag);
	}
	?>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn">Close</a>
    <a href="#" class="btn btn-primary" onclick="tagClick2">Save changes</a>
  </div>
</div>
-->











<?php require('footer.inc.php'); ?>