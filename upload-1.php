
<?php require('header.inc.php'); ?>

<link href="fileuploader.css" rel="stylesheet" type="text/css">	

<h1>Upload</h1>

<p>You can upload photos and videos on this page.</p>

	<div id="file-uploader-demo1">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			<!-- or put a simple form for upload here -->
		</noscript>         
	</div>
	
	<script src="fileuploader.js" type="text/javascript"></script>
    <script>        
        function createUploader(){            
            var uploader = new qq.FileUploader({
                element: document.getElementById('file-uploader-demo1'),
                action: 'do-nothing.htm',
                debug: true
            });           
        }
        
        // in your app create uploader as soon as the DOM is ready
        // don't wait for the window to load  
        window.onload = createUploader;     
    </script>  

<p>Once you have finished uploading files, <a href="upload-3.php">continue to set privacy and metadata</a>.</p>
<p><input type="button" onclick="location.href='upload-3.php';" value="Continue" /></p>

</script>
