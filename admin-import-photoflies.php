<?php
require_once('@schema.php');

if ($handle = opendir("./thumbs")) 
{
	while (false !== ($file = readdir($handle))) 
	{
		$filename = basename($file);
		if ($filename == '.' 
		 || $filename == '..' 
		 || strcasecmp($filename, 'thumbs.db') == 0) 
			continue;
		
		$existingItems = R::find('media', 'file = ?', array($filename));
		if (count($existingItems) == 0) {
		
			$id = newid();
			$media = R::dispense('media');
			$media->mediaid = $id;
			$media->owner = '4fb80ee081d07';
			$media->dateCreated = getsqldate();
			$media->isPrivate = false;
			$media->type = "img";
			$media->file = $filename;
			$media->s_male = true;
			$media->s_female = false;
			R::store($media);

			echo("<font color='green'>$filename stored as $id</font><br />");
		}
		else {
			echo("<font color='orange'>$filename already exists in DB</font><br />");
		}
		flush();
	}
}


?>