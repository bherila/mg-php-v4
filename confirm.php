<?php
require_once("@schema.php");
require("header.inc.php");
?>

<div class="row">
<div class="span12">
	<h1>Confirm account</h1>
	<?php

	$cid = $_REQUEST['id'];
	if (strlen($cid) < 1) 
	{
		show_error('Confirmation code missing');
	}
	else
	{
		$rbResult = R::find('user', 'userid = ? and confirmed = ? LIMIT 2', array($cid, false) );
		$rbCount = count($rbResult);
		if ($rbCount < 1) 
		{
			show_error('Account not found or already confirmed.');
		}
		elseif ($rbCount > 1)
		{
			show_error('More than 1 account found!');
		}
		else
		{
			foreach ($rbResult as $id => $bean) {
				$bean->confirmed = true;
				R::store($bean);
				echo '<p>Your account has been confirmed successfully. Welcome!</p>';
			}
		}
	}

	?>
	
	<p><a class="btn btn-primary icon-ok icon-white" href="profile.php">Continue</a></p>
	
</div>
</div>

<?php
require("footer.inc.php");
?>