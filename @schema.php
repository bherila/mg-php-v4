<?php

	require_once("rb.php"); // RedBean ORM. 
	R::setup('mysql:host=127.0.0.1;dbname=mgphp','root',''); //mysql
	R::freeze(array('media'));
	session_start();
	
	//$tags = array('eating', 'yawn', 'tongue', 'uvula', 'no-fillings', 'dental-work', 'clean-mouth', 'chewed-food');
	
	function getCurrentUser() {
		if (isset($_SESSION["currentuser"]))
			return $_SESSION["currentuser"];
		else 
			return "";
	}
	function isLoggedIn() { 
		$cu = getCurrentUser();
		if ($cu == null || strlen($cu) < 1) return false;
		return true; 
	}
	function logOut() {
		$_SESSION["currentuser"] = null; 
	}
	function requireLogin() {
		if (!isLoggedIn()) header('Location: index.php');
	}
	function commaSplit($str) {
		return explode(',', $str); 
	}
	function validateEmail($subject) {
		if (strlen($subject) < 1) return false;
		return preg_match('/\\A\\b[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]+\\b\\z/i', $subject);
		//return eregi('\\A\\b[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]+\\b\\z', $subject);
	}
	function getsqldate() {
		date_default_timezone_set('UTC');
		return date("Y-m-d H:i:s");
	}
	function newid() {
		$bytes = openssl_random_pseudo_bytes(4);
		return bin2hex($bytes);
	}
	
	function input_text($name, $caption, $placeholder, $help, $value = '') {
		echo <<<EOT
			<label for="$name">$caption</label>
			<input type="text" name="$name" placeholder="$placeholder" value="$value" />
EOT;
		if ($help != null && strlen($help) > 0)
			echo '<span class="help-block">'.$help.'</span>';
	}
	
	function input_pass($name, $caption, $help, $value = '') {
		echo <<<EOT
			<label for="$name">$caption</label>
			<input type="password" name="$name" value="$value" />
EOT;
		if ($help != null && strlen($help) > 0)
			echo '<span class="help-block">'.$help.'</span>';
	}
 
	function show_error($msg) {
		echo "<div class='alert alert-error'>$msg</div>";
	}
 
// scaffold for data. 
if (false) {

	$media = R::dispense( 'media' );
	$media->mediaid = uniqid();
	$media->owner = 3; // owner ID
	$media->dateCreated = getdate();
	$media->isPrivate = false;
	$media->type = "img";

	$tag = R::dispense( 'mediatag' );
	$tag->mediaid = "";
	$tag->tag = "mm";

	$grant = R::disposense( 'mediaGrant') ;
	$grant->mediaid = "";
	$grant->userid = "";
	$grant->startDate = getdate();
	$grant->endDate = getdate();

	$mc = R::dispense( 'mediaCollection' );
	$mc->userid = "";
	$mc->mcid = uniqid();
	$mc->dateCreated = getdate();
	$mc->dateModified = getdate();
	$mc->title = "";
	$mc->shared = false;

	$mci = R::dispense( 'mediaCollectionItem' );
	$mci->mcid = "";
	$mci->mediaid = "";

	$user = R::dispense( 'user' ); 
	$user->userid = uniqid();
	$user->email = "";
	$user->password = "";
	$user->displayname = "Ben";
	$user->dateCreated = getdate();
	$user->lastLogin = getdate();
	$user->enabled = true;
	$user->confirmed = true; 
 
}
 
 
?>