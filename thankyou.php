<?php 

//Ensure that a session exists (just in case)
if( !session_id() )
{
  session_start();
}

// Get Session Msg
if(isset($_SESSION["msg"])) {
  $msg = $_SESSION["msg"];
  unset($_SESSION['msg']);     
} 

include 'header.php';
?>

<div class="container">
	<div class="row text-center" style="padding:50px 0 80px 0;">
   
        <div class="col-sm-6 col-sm-offset-3 " >
        <img src="assets/img/thankyou.jpg" class="img-responsive" style="height:300px; margin:auto;">
        <img src="assets/img/smiley.png" class="img-responsive"  style="height:100px; margin:auto;">
        <?php 
    if (isset($msg))
    {
        echo $msg;
    }
?> <br>
        <a href="./" class="btn btn-success btn-lg"> Go to Home </a>
    <br><br>
        </div>
        
	</div>
</div>
<?php include 'footer.php';?>