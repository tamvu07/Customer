<?php
 /*bat dau xu ly mp3 repair*/  



$allowedExts_repair = array("mp3");
$extension_repair = pathinfo($_FILES['file_repair']['name'], PATHINFO_EXTENSION);
 
if ( in_array($extension_repair, $allowedExts_repair))
 
{
  if(($_FILES["file_repair"]["size"] < 200000))
  {
	  if ($_FILES["file_repair"]["error"] > 0)
	    {
	    	/*echo "Return Code: " . $_FILES["file"]["error"] . "<br />";*/
	    	echo 3;
	    }
	  else
	    {
	 
	    if (file_exists("../audio/" . $_FILES["file_repair"]["name"]))
	      {
	      	/*echo $_FILES["file"]["name"] . " already exists. ";*/
	      	echo 4;
	      }
	    else
	      {
	      move_uploaded_file($_FILES["file_repair"]["tmp_name"],
	      "../audio/" . $_FILES["file_repair"]["name"]);
	      echo $_FILES["file_repair"]["name"];
	      }
	    }
  }else{
  	echo 2;
  }

 }
else
  {
  echo 1;
  }
    /*ket thuc xu ly mp3 repair*/
?>