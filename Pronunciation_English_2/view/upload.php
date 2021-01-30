<?php



/*// file name
$filename = $_FILES['file']['name'];

// Location
$location = '../audio/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("mp3");

$response = 0;
if(in_array($file_extension,$image_ext)){
  // Upload file
  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $response = $location;
  }
}

echo $response;*/


 /*bat dau xu ly mp3*/  



$allowedExts = array("mp3");
$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
 
if ( in_array($extension, $allowedExts))
 
{
  if(($_FILES["file"]["size"] < 200000))
  {
	  if ($_FILES["file"]["error"] > 0)
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
	 
	    if (file_exists("../audio/" . $_FILES["file"]["name"]))
	      {
	      	/*echo $_FILES["file"]["name"] . " already exists. ";*/
	      	echo 4;
	      }
	    else
	      {
	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "../audio/" . $_FILES["file"]["name"]);
	      /*echo "Stored in: " . "audio/" . $_FILES["file"]["name"];*/
	      echo $_FILES["file"]["name"];
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
    /*ket thuc xu ly mp3*/


