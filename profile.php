<?php 

include('header.inc.php'); 
requireLogin();

$err_nomatch = false;
$err_badpass = false;
$p1 = $_REQUEST["p1"];
$p2 = $_REQUEST["p2"];
$p3 = $_REQUEST["p2"];
if (strlen($p1) > 0) {
	if (strcmp($p2, $p3) != 0) { // passwords do not match 
		$err_nomatch = true;
	}
	elseif (strcmp($p1, "eggbert") != 0) { // incorrect password
		$err_badpass = true;
	}
	else { // OK, change the password
	
	}
}

// save changes
//R::load($o, 'displayname,email,gender,birthdate,info');
//R::save($o);

?>

<div class="row">
	<div class="span12">
		<h1>My Profile</h1>
	</div>
</div>
<form action="profile.php" method="post">
	<div class="row">
		<div class="span6">
			<h2>General Information</h2>
			<table>
				<tr>
					<td>Display name:</td>
					<td><input type="text" name="displayname" value="<?= $displayname ?>" /></td>
				</tr>
				<tr>
					<td>E-mail address:</td>
					<td><input type="text" name="email" value="<?= $email ?>" /></td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td><input type="text" name="gender" value="<?= $gender ?>" /></td>
				</tr>
				<tr>
					<td>Birth date:</td>
					<td><input type="text" name="birthdate" value="<?= $birthdate ?>" /></td>
				</tr>
				<tr>
					<td>Additional info:</td>
					<td><textarea name="info"><?= $info ?></textarea></td>
				</tr>
			</table>
		</div>
		<div class="span6">
			<h2>Change Password</h2>
			<p>In order to change your password you need to provide your current password. If you leave these fields
			blank your password will not be changed. </p>

			<table>
				<tr>
					<td><label for="p1">Current password:</label></td>
					<td><input type="password" name="p1" /></td>
					<td><?= $err_badpass ? "Incorrect" : "&nbsp;" ?></td>
				</tr>
				<tr>
					<td><label for="p2">New password:</label></td>
					<td><input type="password" name="p2" /></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td><label for="p3">Confirm password:</label></td>
					<td><input type="password" name="p3" /></td>
					<td><?= $err_nomatch ? "Does not match" : "&nbsp;" ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="span12">
			<input type="submit" value="Save Changes" class="btn btn-primary icon-ok icon-white" />
		</div>
	</div>
</form>


<?php include("footer.php"); ?>

</form>