<?php

require_once("@localization.php");
require_once("@schema.php");

$email = "";
$password = "";
if (isset($_REQUEST['xemail'])) { $email = $_REQUEST['xemail']; }
if (isset($_REQUEST['xpass']))  { $password = $_REQUEST['xpass']; }

$badpass = false;
$emailvalid = validateEmail($email);
if ($emailvalid && strlen($password) > 0)
{
	$qResults = R::find('user', 'email = ? and password = ?', array($email, sha1($password)));
	
	if ($_SERVER['HTTP_HOST'] == 'localhost') {
		print("<pre>debug {\n");
		print_r($qResults);
		print("}</pre>");
	}
	
	if (count($qResults) != 1) {
		// invalid
		$badpass = true;
	}
	else {
		// log in the user
		foreach ($qResults as $id=>$bean) {
			$_SESSION["currentuser"] = $email;
			$_SESSION["displayname"] = $bean->displayname;
		}
	}
}

$n_photos = count(R::find('media', 'type = ?', array('img')));
$n_videos = count(R::find('media', 'type = ?', array('mov')));

if (isLoggedIn()) {
	header('Location: profile.php');
	exit;
}

?><html>
<head>
<title>Log in - <?= $site_title ?></title>
<link href='http://fonts.googleapis.com/css?family=Cabin+Condensed:400,500' rel='stylesheet' type='text/css'>
<style type="text/css">
body { 
	background-color: #FFF9E5;
	color: #CC6600;
	font-family: 'Cabin Condensed', Arial, Helvetica;
}
.main {
	border: 1px solid #CC6600;
	background: #fff;
	padding: 1in;
	width: 700px;
	height: 500px;
	margin-top: 0.5in;
	margin-left: 0.5in;
	margin-right: auto;
}
td { vertical-align: top; }
</style>
</head>
<body>

<div class="main">

	<h1>Welcome</h1>

	<p><?=$home_text?></p>
	
	
	<table style="width: 100%; ">
		<tr>
			<td style="border-right: 1px solid #FFCC99; width: 50%;">
			<h2><?=$s_login?></h2>
			
			<?php if ($emailvalid == false) {
			?><p>Invalid e-mail address.</p><?php } 
			elseif ($badpass) { ?>
			<p>Sorry, the email and password you entered were not recognized.</p>
			<?php } ?>

			<form action="index.php" method="post">
				<p><?=$s_email?>: <input type="text" name="xemail" /></p>
				<p><?=$s_password?>: <input type="password" name="xpass" /></p>
				<p><input type="submit" text="Submit" /></p>
			</form>
			</td>
			<td style="padding-left: 30px;">
			<h2>Request invitation</h2>
			<p>Not yet!</p>
			</td>
		</tr>
	</table>
	
	<h2>We currently have</h2>
	<ul>
		<li><b><?=$n_photos?></b> <?= $n_photos != 1 ? 'photos' : 'photo' ?></li>
		<li><b><?=$n_videos?></b> <?= $n_photos != 1 ? 'videos' : 'video' ?></li>
	</ul>

</div>
</body>