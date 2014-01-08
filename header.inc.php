<?php 

	require_once("@localization.php"); 
	require_once("@schema.php"); 

?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$site_title?></title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
	<link href="contrib/manifest.css" rel="stylesheet" type="text/css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script src="contrib/jquery.ui.widget.min.js"></script>
    <script src="contrib/jquery.marcopolo.min.js"></script>
    <script src="contrib/jquery.manifest.js"></script>
	
	<style>
		body {
			padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		}
		.sidebar-nav {
			padding: 9px 0;
		}
		.side-input { width: 5em; }
	</style>

</head>
<body>
	<script type="text/javascript">
	/* initialize tag entry fields */
	var ptt = {
		<?php 
		
			$items = array();
			foreach ($_REQUEST as $key=>$val)
				if (is_array($val))
					array_push($items, "'$key' : [\"" . implode('", "', $val) . "\"]");
			echo(implode(",\n\t\t", $items));
		
		?>}
	$(function() { 
		$('.tag-entry').each(function(){
			console.log(this.name + " ==> " + ptt[this.name + "_values"] );
			$(this).manifest({ values : ptt[this.name + "_values"] });
		});
	});
	</script>
<div class="navbar navbar-fixed-top">
<div class="navbar-inner">
	<div class="container">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<a class="brand" href="#"><?=$site_title?></a>
		<div class="btn-group pull-right">
			<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
				<span><i class="icon-user"></i> <?= isset($_SESSION['displayname']) ? $_SESSION['displayname'] : "Not signed in" ?></span>
				<span class="caret"></span>
			</a>
			<ul class="dropdown-menu">
				<li><a href="profile.php">My Profile</a></li>
				<li class="divider"></li>
				<li><a href="index.php?action=signout">Sign Out</a></li>
			</ul>
		</div>
		<div class="nav-collapse">
			<ul class="nav">
				<li class="active"><a href="profile.php">Home</a></li>
				<li><a href="gallery.php">Browse</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="messages.php">Messages</a></li>
				<li><a href="requests.php">Requests</a></li>
				<li><a href="upload.php">Upload</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
</div>

<div class="container">