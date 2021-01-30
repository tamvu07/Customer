<?php
/*session_start();*/
include_once("../model/example.php");  
include_once("../model/model.php");
/*include_once("controller_search.php"); */

if (isset($_POST['button_ex']))
{

    $_SESSION["VO_ID"] = $_POST['button_ex'];
    header("Location: http://localhost/Pronunciation_English_2/view/example.html");
}


if (isset($_POST['bt_setting_repair']))
{
    $_SESSION["VO_ID"] = $_POST['bt_setting_repair'];
       echo '
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2" id="bt_hide_repair" hidden="hidden">
			</button>
      ';

       echo '
          <script type="text/javascript">
            window.onload = function () {	
		document.getElementById("bt_hide_repair").click();
   }
          </script>
      ';
}

if (isset($_POST['bt_setting_remove']))
{
    $_SESSION["VO_ID"] = $_POST['bt_setting_remove'];
     /*start get one vocabulary*/
		/*require_once("controller/controller_get.php");*/ 
		$t = new controller_get();
		$_SESSION["text_remove_vocabulary"] = $t->get_one_vocabulary_text_vocabulary($_POST['bt_setting_remove']);
    /*end get one vocabulary*/   
       echo '
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3" id="bt_hide_remove" hidden="hidden">
			</button>
      ';

       echo '
          <script type="text/javascript">
            window.onload = function () {	
		document.getElementById("bt_hide_remove").click();
   }
          </script>
      ';
}

if (isset($_POST['bt_setting_repair_example']))
{
    $_SESSION["EX_ID"] = $_POST['bt_setting_repair_example'];
       echo '
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_example_repair" id="bt_hide_repair_example" hidden="hidden">
			</button>
      ';

       echo '
          <script type="text/javascript">
            window.onload = function () {	
		document.getElementById("bt_hide_repair_example").click();
   }
          </script>
      ';
}

if (isset($_POST['bt_setting_remove_example']))
{
    $_SESSION["EX_ID"] = $_POST['bt_setting_remove_example'];
    /*start get one example*/
		
		$t = new controller_get();
		$_SESSION["text_remove_example"] = $t->get_one_example($_POST['bt_setting_remove_example']);
    /*end get one example*/
       echo '
           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal_example_remove" id="bt_hide_remove_example" hidden="hidden">
			</button>
      ';

       echo '
          <script type="text/javascript">
            window.onload = function () {	
		document.getElementById("bt_hide_remove_example").click();
   }
          </script>
      ';
}




class controller_get extends model{

	function get_id() {
		$p = new model();
		$dem_rusult = $p->Count_ID_table_vocabulary();
		while($rows_dem=$dem_rusult->fetch_assoc())
		{
			$dem = $rows_dem['count'];
		}
		
		if($dem > 0)
		{
			$result = $p->getID();
			$this->get_rows_table_vocabulary($result,$dem);
		
		}
	}

function get_rows_table_vocabulary($result,$dem)
	{

		if($dem > 0)
		{
			$dem1 = $dem;
			$dem2 = 0;
		}else{
			$dem1 = 0;
			$dem2 = -1;
		}
		
		while($rows=$result->fetch_assoc())
			{
				if($dem2 < 0)
				{
					$dem_tam = $dem2 * -1;
				}
				if($dem1 > 0)
				{
					$dem_tam = $dem1;
				}
				
/*				$vocabulary = base64_decode($rows['vocabulary']);
				$type = base64_decode($rows['type']);
				$phonetic = base64_decode($rows['phonetic']);
				$translate = base64_decode($rows['translate']);
				$pronunciation = base64_decode($rows['pronunciation']);*/

				$vocabulary = str_replace("^", "'" , $rows['vocabulary']);
				$type_1 = str_replace("^", "'" , $rows['type']);
				/*$type_2 = str_replace("\n", "\n" , $type_1);*/
				$phonetic_1 = str_replace("^", "'" , $rows['phonetic']);
				/*$phonetic_2 = str_replace("\n", "\n" , $phonetic_1);*/
				$translate_1 = str_replace("^", "'" , $rows['translate']);
				/*$translate_2 = str_replace("\n", "\n" , $translate_1);*/
				$pronunciation = str_replace("^", "'" , $rows['pronunciation']);

/*<td><a href="'.$pronunciation.'" target="_blank">pronunciation </a></td>*/
				echo '
				      <tr >
				        <td>'.$dem_tam.'</td>
				        <td >'.$vocabulary.'</td>
				        
				        <td>'.nl2br($translate_1).'</td>
				        <td ">
				        		<audio  id="myAudio" controls>
  								
  								<source src="audio/'.$pronunciation.'.mp3" type="audio/mpeg">
								</audio>
				        </td>
				        <td>
				          <form  method="post" name="form" id="form" enctype="mutipart/form-data" >
				            <button class="btn btn-success" type="submit" id="button_ex" name="button_ex" value= "'.$rows['ID'].'" >EX</button>
				          </form>
				        </td>
				        <td>
				          <div class="dropdown">
				            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
				                  Setting
				            </button>
				            <div class="dropdown-menu">
				              <form  method="post" name="form2" id="form2" enctype="mutipart/form-data" >
				                        <a class="dropdown-item">
				                          <button class="btn btn-danger" type="submit" id="bt_setting_repair" name="bt_setting_repair" value= "'.$rows['ID'].'"  style="  margin-left: -20%; width: 141%;" data-toggle="modal">Repair</button>
				                        </a>
				                        <a class="dropdown-item">
				                          <button class="btn btn-danger" type="submit" id="bt_setting_remove" name="bt_setting_remove" value= "'.$rows['ID'].'" style="    margin-left: -20%; width: 141%;">Remove</button>
				                        </a>
				              </form>
				            </div>
				          </div>
				        </td>
				        <td><img src="images/'.$rows['image'].'" class="rounded" id="Image_vocabulary"></td>
				      </tr>
				';
				$dem1--;
				$dem2--;
			}	
	}

	function get_example($VO_ID) {
		$arr_example_one_vocabualary = array();
		$p = new model();
		$result = $p->get_example($VO_ID);
		if($result == null)
		{

		}else{
			$dem = 0;
			while($rows=$result->fetch_assoc())
			{
				$dem++;
				/*$_example_test = base64_decode($rows['example_test']);*/
				$_example_test = str_replace("^", "'" , $rows['example_test']);
				$_translate_test = str_replace("^", "'" , $rows['translate']);
				/**/
				array_push ($arr_example_one_vocabualary, new example($rows['EX_ID'],$rows['VO_ID'],$_example_test ));
				/**/
				echo '
				      <tr>
				        <td style="text-align: center;">'.$dem.'</td>
				        <td>
				        	<nav id='.$rows['EX_ID'].' class="nav_content_translate">
				        	<i class="fa fa-commenting nav_i_content_translate" aria-hidden="true" style="font-size : 227% "></i>
					        	<div class="alert alert-dark" id="translate_content_2">
					        		'.$_translate_test.'
					        	</div>
				        	</nav>
				        	
				        </td>	
				        <td>'.$_example_test.'</td>
				        <td>

					  	   <div class="dropdown">
							  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							    
							  </button>
							  <div class="dropdown-menu">
							<form method="post" name="form2" id="form2" enctype="mutipart/form-data" >
							    <a class="dropdown-item">
							    	<button class="btn btn-light" type="submit" id="bt_setting_repair" name="bt_setting_repair_example" value= "'.$rows['EX_ID'].'"  style="  margin-left: -20%; width: 141%;" data-toggle="modal">Repair</button>
							    </a>
							    <a class="dropdown-item">
							    	<button class="btn btn-light" type="submit" id="bt_setting_remove_example" name="bt_setting_remove_example" value= "'.$rows['EX_ID'].'" style="    margin-left: -20%; width: 141%;">Remove</button>
							    </a>
					  	   		</form>
							  </div>
							</div>

				        </td>
				      </tr>

				';
			}
		}
		$_SESSION["arr_example_one_vocabualary"] = $arr_example_one_vocabualary;
	}

	function insert_vocabulary($VO,$Ty,$Ph,$Tr,$Pr,$Im)
	{
		$p = new model();
		$result = $p->insert_vocabulary($VO,$Ty,$Ph,$Tr,$Pr,$Im);
		if($result == 0)
		{
		 echo '
          <script type="text/javascript">
            alert("Insert not success !");
          </script>
      ';
		}else{
/*		echo '
          <script type="text/javascript">
            alert("Insert success !");
          </script>
      ';*/
			echo '<meta http-equiv="refresh" content="0" />';
		}
	}

	function insert_example($_VO_id,$_EX,$_TRL)
	{
		$p = new model();
		$result = $p->insert_example($_VO_id,$_EX,$_TRL);
		if($result == 0)
		{
		 echo '
          <script type="text/javascript">
            alert("Insert not success !");
          </script>
      ';
		}else{
/*		echo '
          <script type="text/javascript">
            alert("Insert success !");
          </script>
      ';*/
			echo '<meta http-equiv="refresh" content="0" />';
		}		
	}

	function get_one_vocabulary($_VO_id){
		$p = new model();
		$result = $p->get_one_vocabulary($_VO_id);
		if($result == null)
		{

		}else{
			
			while($rows=$result->fetch_assoc())
			{
/*				$_vocabulary = base64_decode($rows['vocabulary']);
				$_type = base64_decode($rows['type']);
				$_phonetic = base64_decode($rows['phonetic']);
				$_translate = base64_decode($rows['translate']);
				$_pronunciation = base64_decode($rows['pronunciation']);*/

				$_vocabulary = str_replace("^", "'" , $rows['vocabulary']);
				$_type = str_replace("^", "'" , $rows['type']);
				$_phonetic = str_replace("^", "'" , $rows['phonetic']);
				$_translate = str_replace("^", "'" , $rows['translate']);
				$_pronunciation = str_replace("^", "'" , $rows['pronunciation']);
				$_image = $rows['image'];

				$_SESSION["1_vocabulary"]  = $_vocabulary;
				/*$_SESSION["1_type"]   = str_replace("\n", "\n" , $_type);
				$_SESSION["1_phonetic"]   = str_replace("\n", "\n" , $_phonetic);
				$_SESSION["1_translate"]   = str_replace("\n", "\n" , $_translate);
*/
				$_SESSION["1_type"]  = $_type;
				$_SESSION["1_phonetic"]  = $_phonetic;
				$_SESSION["1_translate"]  = $_translate;
				$_SESSION["1_pronunciation"]  = $_pronunciation;
				$_SESSION["1_image"]  =  $_image ;

			}
		}
	}

	function update_one_vocabulary($_VO_id,$_VO,$_Ty,$_Ph,$_Tr,$_Pr,$_Im)
	{
		$p = new model();
		$result = $p->update_one_vocabulary_1($_VO_id,$_VO,$_Ty,$_Ph,$_Tr,$_Pr,$_Im);
		if($result == 0)
		{
		 echo '
          <script type="text/javascript">
            alert("Update not success !");
          </script>
      ';
		}else{
/*		echo '
          <script type="text/javascript">
            alert("Update success !");
          </script>
      ';*/
			echo '<meta http-equiv="refresh" content="0" />';
		}
	}

	function remove_one_vocabulary($_VO_id)
	{
		$p = new model();
		$result_1 = $p->get_example($_VO_id);
		if($result_1 == null)
		{
			$this->remove_one_vocabulary_2($_VO_id);
		}else{
				$result = $p->remove_one_all_example_vocabulary($_VO_id);
				if($result == 0)
				{
					/*remove not success*/
				}else{
					$this->remove_one_vocabulary_2($_VO_id);
				}
		}
	}

	function remove_one_vocabulary_2($_VO_id)
	{
		$p = new model();
		$result = $p->remove_one_vocabulary($_VO_id);
		if($result == 0)
		{
					/*remove not success*/
			echo '
		     <script type="text/javascript">
		         alert("Remove not success !");
		     </script>
		     ';
		}else{
/*		echo '
		     <script type="text/javascript">
		         alert("Remove success !");
		     </script>
		     ';*/
		echo '<meta http-equiv="refresh" content="0" />';
			}
	}

	function get_one_example($_EX_id){
		$p = new model();
		$result = $p->get_one_example($_EX_id);
		if($result == null)
		{

		}else{
			
			while($rows=$result->fetch_assoc())
			{
				/*$_example_test = base64_decode($rows['example_test']);*/
				/*$_SESSION["1_example_test"]  = $_example_test;*/
				$_example_test = str_replace("^", "'" , $rows['example_test']);
				$_translate_test = str_replace("^", "'" , $rows['translate']);
				$_SESSION["1_example_test"] = $_example_test;
				$_SESSION["1_translate_test"] = $_translate_test;

			}
		}
	}

	function update_one_example($_EX_id,$_text,$_translate)
	{
		$p = new model();
		$result = $p->update_one_example($_EX_id,$_text,$_translate);
		if($result == 0)
		{
		 echo '
          <script type="text/javascript">
            alert("Update not success !");
          </script>
      ';
		}else{
/*		echo '
          <script type="text/javascript">
            alert("Update success !");
          </script>
      ';*/
			echo '<meta http-equiv="refresh" content="0" />';
		}
	}

	function remove_one_example($_EX_id)
	{
		$p = new model();
		$result = $p->remove_one_example($_EX_id);
		if($result == null)
		{
			echo '
		     <script type="text/javascript">
		         alert("Remove not success !");
		     </script>
		     ';
		}else{
/*			echo '
		     <script type="text/javascript">
		         alert("Remove success !");
		     </script>
		     ';*/
			echo '<meta http-equiv="refresh" content="0" />';
		}
	}

	function get_one_vocabulary_text_vocabulary($_VO_id){
		$p = new model();
		$result = $p->get_one_vocabulary($_VO_id);
		if($result == null)
		{

		}else{
			
			while($rows=$result->fetch_assoc())
			{
				/*$_vocabulary = base64_decode($rows['vocabulary']);*/
				$_vocabulary = str_replace("^", "'" , $rows['vocabulary']);
				return $_vocabulary;
			}
		}
	}

	function get_text_search($_text_search)
	{
		$p = new model();
		$result =  $p->get_text_search($_text_search);
		
		if($result == null)
		{
/*			echo '
		     <script type="text/javascript">
		         alert("Can not found !");
		     </script>
		     ';*/
		}else{
/*			$dem = 10;
			$this->get_rows_table_vocabulary($result,$dem);*/
			$this->get_rows_table_vocabulary($result,0);
		}

	}

	function help_base64_decode_encode()
	{
		$p = new model();
		$result =  $p->getID();
		while($rows=$result->fetch_assoc())
		{
				$vocabulary_1 = base64_decode($rows['vocabulary']);
				$type_1 = base64_decode($rows['type']);
				$phonetic_1 = base64_decode($rows['phonetic']);
				$translate_1 = base64_decode($rows['translate']);
				$pronunciation_1 = base64_decode($rows['pronunciation']);

				$_VO = str_replace("'", "^" , $vocabulary_1);
				$_Ty = str_replace("'", "^" , $type_1);
				$_Ph = str_replace("'", "^" , $phonetic_1);
				$_Tr = str_replace("'", "^" , $translate_1);
				$_Pr = str_replace("'", "^" , $pronunciation_1);

				$this->update_one_vocabulary($rows['ID'],$_VO,$_Ty,$_Ph,$_Tr,$_Pr);
		}
	}


}

?>


