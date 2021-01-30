<?php include ("header.php"); 
session_start();

?>
<main class="main oh" id="main">

<?php
if(isset($_GET['p'])){
    $p=$_GET['p'];
    if($p=="example")
    {
        include "example.php";
    }
    if($p=="main")
    {
        include "main.php";
    }
    if($p=="game")
    {
        include "game.php";
    }
    if($p=="main_0")
    {
        include "main_0.php";
    }
}
else include "main_0.php";
?>
</main>
<!-- end main-wrapper -->

<!-- footer -->
<?php
include "footer.php";
?>
<!-- end footer -->
