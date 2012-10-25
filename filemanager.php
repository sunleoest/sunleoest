<?php
if(isset($_GET['action'])){
	if($_GET['action'] == 'mkdir'){
		if(isset($_POST['mkdir']) && $_POST['dirname'] != ""){
			$dirpath = $_POST['dirname'];
			$result = mkdir($dirpath);
			if($result)
			echo 'folder created';else echo 'failed to create folder';
		}
		echo '
				<form action="filemanager.php?action=mkdir" method=post>
				<input type="text" placeholder="dir name" name="dirname" id="" /><br />
				<input name="mkdir" style="background: blue;" type="submit" value="Create dir" />
				</form>
			';
	}
	if($_GET['action'] == 'deletedir'){
		if(isset($_POST['deletedir']) && $_POST['dirname'] != ""){
			$dirname = $_POST['dirname'];
		function delete_directory($dirname) {
			if (is_dir($dirname))
			   $dir_handle = opendir($dirname);
		    if (!$dir_handle)
			    return false;
		    while($file = readdir($dir_handle)) {
			  if ($file != "." && $file != "..") {
				 if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				 else
					delete_directory($dirname.'/'.$file);     
			  }
		   }
		   closedir($dir_handle);
		   $result = rmdir($dirname);
			if($result)
			echo $dirname.' deleted<br />';else echo 'Failed to delete folder';
		}
					if (is_dir($dirname))
			   $dir_handle = opendir($dirname);
		    if (!$dir_handle)
			    return false;
		    while($file = readdir($dir_handle)) {
			  if ($file != "." && $file != "..") {
				 if (!is_dir($dirname."/".$file))
					unlink($dirname."/".$file);
				 else
					delete_directory($dirname.'/'.$file);     
			  }
		   }
		   closedir($dir_handle);
		   $result = rmdir($dirname);
			if($result)
			echo $dirname.' deleted <br />';else echo 'Failed to delete folder';
		}
		echo '
				<form action="filemanager.php?action=deletedir" method=post>
				<input type="text" placeholder="dir name to delete" name="dirname" id="" /><br />
				<input name="deletedir" style="background: blue;" type="submit" value="Delete dir" />
				</form>
			';
	}
	if($_GET['action'] == 'deletefile'){
		if(isset($_POST['deletefile']) && $_POST['file'] != ""){
			$filepath = $_POST['file'];
			$result = unlink($filepath);
			if($result)
			echo $_POST['file'] .' has been deleted!';else echo "Failed to delete file.";
		}
		echo '
				<form action="filemanager.php?action=deletefile" method=post>
				<input type="text" placeholder="file to delete" name="file" id="" /><br />
				<input name="deletefile" style="background: blue;" type="submit" value="Delete file" />
				</form>
			';
	}
	
	if($_GET['action'] == 'upload'){
	if(isset($_POST['dirname']) && isset($_POST['upload'])){
		$target_path = dirname(__FILE__)."/".$_POST['dirname'];
		$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
		if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
			" has been uploaded!...";
		} else{
			echo "There was an error uploading the file, please try again!";
		}
	}
		echo '
				<form enctype="multipart/form-data" action="filemanager.php?action=upload" method="post">
				<input type="text" placeholder="Target Directory" name="dirname"/><br />
				<input name="uploadedfile" type="file" /><br />
				<input name="upload" style="background: blue;" type="submit" value="upload" />
				</form>
			';	
	
	}
}
echo '<br />
<a href="filemanager.php?action=mkdir" >Create Folder</a><br />
<a href="filemanager.php?action=deletedir" > Delete Folder</a><br />
<a href="filemanager.php?action=deletefile" >Delete File</a><br />
<a href="filemanager.php?action=upload" >Upload file</a><br />
';