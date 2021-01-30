<?php




$allowedExts = array("jpg","png","gif","jpeg");
$extension = pathinfo($_FILES['file_image']['name'], PATHINFO_EXTENSION);
 
if ( in_array($extension, $allowedExts))
 
{
  if(($_FILES["file_image"]["size"] < 90000000))
  {
	  if ($_FILES["file_image"]["error"] > 0)
	    {
	    	/*echo "Return Code: " . $_FILES["file"]["error"] . "<br />";*/
	    	echo 3;
	    }
	  else
	    {
	/*    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
	    echo "Type: " . $_FILES["file"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
	    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/
	 
	    if (file_exists("../images/" . $_FILES["file_image"]["name"]))
	      {
	      	/*echo $_FILES["file"]["name"] . " already exists. ";*/
	      	echo 4;
	      }
	    else
	      {
	      move_uploaded_file($_FILES["file_image"]["tmp_name"],
	      "../images/" . $_FILES["file_image"]["name"]);
	      /*echo "Stored in: " . "audio/" . $_FILES["file"]["name"];*/
	      echo $_FILES["file_image"]["name"];
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
    /*ket thuc xu ly images*/


