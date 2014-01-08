<?php

require_once("@schema.php");

// validation state
$fs = false;
$errs = "";

// form variables
$mail = "";
$pass = "";
$disp = "";

if (isset($_REQUEST['mail'])) { $mail = $_REQUEST['mail']; $fs = true; }
if (isset($_REQUEST['pass'])) { $pass = $_REQUEST['pass']; $fs = true; }
if (isset($_REQUEST['disp'])) { $disp = $_REQUEST['disp']; $fs = true; }

if ($fs)
{
	if (strlen($mail) < 1)
		$errs .= '<li>Email is required.</li>';
	else if (! preg_match('/^[A-Z0-9._%-]+@(?:[A-Z0-9-]+\\.)+[A-Z]{2,4}$/i', $mail))
		$errs .= '<li>Email address is not valid.</li>';
	if (strlen($pass) < 1)
		$errs .= '<li>Password is required.</li>';
	if (strlen($disp) < 1)
		$errs .= '<li>Display name is required.</li>';
	
	if (strlen($errs) < 1)
	{
		$user = R::dispense('user');
		$user->userid = $cid = newid();
		$user->email = $mail;
		$user->password = sha1($pass);
		$user->displayname = $disp;
		$user->dateCreated = getsqldate();
		$user->lastLogin = getsqldate();
		$user->enabled = true;
		$user->confirmed = false;

		$id = R::store($user);
		$_SESSION["currentuser"] = $mail;
		
		$welcome_email = <<<EOT
	
Welcome to The Mouth Gallery! Please confirm your e-mail
address by clicking the following link: 

http://www.mouthgallery.com/confirm.php?id=$cid

If you didn't intend to create this account, do nothing and your account 
(and any information associated with it) will automatically be deleted 
in 3 days.

EOT;
	
		header('Location: profile.php');
		
	}
}

require_once("header.inc.php");
?>

<h1>Create account</h1>

<?php /* display form validation summary*/ 
if (strlen($errs) > 0) { 
	echo "<p>Please correct the following errors: <ul>$errs</ul>"; 
} ?>
<form method="post" action="signup.php" class="form">
<?php

	input_text('mail', 'E-mail address:', '', 'You will need to confirm your e-mail address to finish creating your account. ', $mail);

	input_pass('pass', 'Password:', 'Must be at least 5 characters', $pass);

	input_pass('conf', 'Confirm password:', $pass);

	input_text('disp', 'Display name:', '', '', $disp);

?>
<div class="input-group">
	<input type="submit" value="Create account" />
</div>

</form>
<?php require_once("footer.inc.php"); ?>