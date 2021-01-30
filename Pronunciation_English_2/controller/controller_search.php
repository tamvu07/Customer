<?php
include_once("controller_get.php");
$t = new controller_get();

if(isset($_GET['text_search'])){
	if($_GET['text_search'] != null)
	{
		
		$result = $t->get_text_search($_GET['text_search']);
		/*$t->get_rows_table_vocabulary($result,10);*/
		echo $result;
	}else{echo 0;}
}


/*end text search*/
/*class controller_search extends controller_get
{
	function get_text_search($_text_search)
	{
		$t = new controller_get();
		$t->get_text_search($_text_search);
	}
}
?>*/