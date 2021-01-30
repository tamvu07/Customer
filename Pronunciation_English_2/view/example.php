<?php 
require_once("../controller/controller_get.php"); 
$t = new controller_get();

if (isset($_POST['Save_new_example']))
{
  if($_POST['Exmaple'] != null && $_POST['Translate'] != null)
  {
      $t->insert_example($_SESSION["VO_ID"],$_POST['Exmaple'],$_POST['Translate']);
  }else{
          echo '
          <script type="text/javascript">
            alert("Please! The sentece form you should fill out full.");
          </script>
      ';
  }
}

if (isset($_POST['Save_repair_one_example']))
{
  if($_POST['text_example_repaired'] != null && $_POST['text_translate_repaired'] != null )
  {
    $t->update_one_example($_SESSION["EX_ID"],$_POST['text_example_repaired'],$_POST['text_translate_repaired']);
  }else{
          echo '
          <script type="text/javascript">
            alert("Please! The sentece form you should fill out full.");
          </script>
      ';
  }
}

if (isset($_POST['Remove_one_example']))
{
  $t->remove_one_example($_SESSION["EX_ID"]);
}


?>
<?php
/*start get one example to repair*/
if( isset($_SESSION["EX_ID"]))
{
   $t->get_one_example($_SESSION["EX_ID"]);
}
/*end get one example to repair*/
?>

<!-- start menu example -->
<div class="menu_main">
      <div class="row">
        <div class="col c1">
            <h2>Wellcome</h2>
            <p>The manage vocabulary better for you !</p>  
        </div>
        <div class="col c2">
          <div>
              <nav id="nav_image_return"><img src="images/1.png" class="rounded-circle" alt="Cinque Terre" onclick="click_return_main()"></nav>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> add new example </button>
          </div>
        </div>

      </div>
</div>

  <div class="container">
    <div class="content_example">
      <table class="table table-bordered table-sm">
        <thead>
          <tr>
            <th class="example_table_tr_one_th">Order</th>
            <th class="example_table_tr_one_th">Translate</th>
            <th class="example_table_tr_two_th">Example </th>
            <th class="example_table_tr_three_th">
              <img src="images/3.png" class="rounded-circle" alt="Cinque Terre"> 
            </th>
          </tr>
        </thead>
        <tbody>
          <?php

          $t->get_example($_SESSION["VO_ID"]);

          ?>
        </tbody>
      </table>
    </div>
  </div>

<!-- The Modal repair one example-->
<div class="modal" id="myModal_example_repair">
  <div class="modal-dialog ">
    <div class="modal-content" style="width: 200%;  margin-left: -50%;">
     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Repair Example</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

      <form method="post" name="form" id="form" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Exmaple:</label>
            <input type="text" class="form-control" id="text_example_repaired" name="text_example_repaired" value="<?php echo $_SESSION["1_example_test"] ?>">
             <label >Translate:</label>
            <input type="text" class="form-control" id="text_translate_repaired" name="text_translate_repaired" value="<?php echo $_SESSION["1_translate_test"] ?>">
          </div>
     </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Save_repair_one_example" name="Save_repair_one_example">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>

    </div>
  </div>
</div>
<!-- end Modal repair example-->

<!-- The Modal remove example-->
<div class="modal" id="myModal_example_remove">
  <div class="modal-dialog">
    <div class="modal-content">

     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Remove</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

        <form method="post" name="form" id="form" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Do you want to Remove right now ! </label>
             <div><?php echo $_SESSION["text_remove_example"] ?></div> 
          </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Remove_one_example" name="Remove_one_example">Yes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
      </div>

    </form>

    </div>
  </div>
</div>
<!-- end Modal remove one example-->

<!-- add new exampel -->
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog ">
    <div class="modal-content" style="width: 200%;  margin-left: -50%;">
     <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Example</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <!-- Modal body -->
    <div class="modal-body">

      <form method="post" name="form" id="form" enctype="mutipart/form-data" >
          <div class="form-group">
            <label >Exmaple:</label>
            <input type="text" class="form-control" id="Exmaple" name="Exmaple">
            <label >Translate:</label>
            <input type="text" class="form-control" id="Translate" name="Translate">
          </div>
     </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="Save_new_example" name="Save_new_example">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </form>

    </div>
  </div>
</div>
<!-- end add new example -->



<!-- <script>
  $(document).ready(function(){ 
    alert("jquery,,,,,,,,,,,,,,.");
  $('#nav_image_return').children('img').click(function(){
      window.location.replace("http://localhost/Pronunciation_English");
  });
}
</script> -->
<?php
/*$a = array('a'=>123,'b'=>456);*/
 $a = $_SESSION["arr_example_one_vocabualary"] ;
?>


<script type="text/javascript">
  $(document).ready(function(){

    var dem = 0;
    b = <?php echo json_encode($a);?>;
    b.forEach(function(element) {
      for (x0 in element) {  
/*            if (x.id == element[x0]) { 
              x.style.fontSize = "30px";
            }*/
      }
    dem = dem + 1;
    });

    var xxx = 1;
      for (i = 0; i < dem; i++) {
           var x = document.getElementsByTagName("NAV")[i+1];
          let test = document.getElementById(x.id);
              test.addEventListener("mouseenter", function( event ) {    
          $(this).children("#translate_content_2").css({"display":"block"});
            if(xxx = 1)
            {
              animation_translate();
              xxx = 0;
            }
          $(this).mouseleave(function(){
            $(this).children("#translate_content_2").css({"display":"none"});
          });
        }, false);       
      }




});

</script>