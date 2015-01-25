<?php

require_once("../DropboxUploader/DropboxUploader.php");
require_once("../DropboxUploader/credentials.php");


if ($_POST and $_FILES)
{
	$resumeName = $_POST["resumeName"];
	$resumeNetID = $_POST["resumeNetID"];
	echo $resumeName . " - " . $resumeNetID . " - Resume";

	try
	{
		// raise exception on upload error
	    if ( ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) || ($_FILES['resume']['name'] === "") )
	        throw new Exception("Resume did not upload properly.");
	
	    // parse the extension from the file name
	    $ext = substr($_FILES['resume']['name'], strrpos($_FILES['resume']['name'], '.') + 1);
	
	    // raise exception if the file type is wrong
	    if ( ($ext != "pdf") && ($ext != "doc") && ($ext != "docx") )
	        throw new Exception("File type is not PDF or Microsoft Word document.");
	
	    // get the file name based on student's information
	    $filename = $resumeName . " - " . $resumeNetID . " - Resume." . $ext;
	
		$uploader = new DropboxUploader($dropbox_username, $dropbox_password);
	
	    // upload to the "resume" folder (if the folder doesn't exist, it will be created)
	    $uploader->upload($_FILES['resume']['tmp_name'], "SPAC 2015 Resumes",  $filename);
	
	    echo "success";
	}

	catch(Exception $e)
	{
        // exception raised
        echo htmlspecialchars($e->getMessage());
    }

}

?>