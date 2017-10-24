<?php 
include('config.php');
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

$sql = "SELECT * from tb_words";
$result = mysqli_query($conn, $sql);

include('include/header.php'); ?>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">All Words<a class=" btn btn-primary  pull-right" href="./add-word.php">Add Word</a></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php 
    if (isset($msg))
    {
        echo $msg;
    }
?> 
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Word</th>
        <th>Email</th>
        <th>Status</th>
        <th style="width: 33%;">Action</th>
      </tr>
    </thead>
    <tbody><?php if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $val = '<tr>
      <td>'.$row['word'].'</td>
      <td>'.$row['email'].'</td>
      <td>';
      if($row['status'])
      {
        $val.= "Active";
      }else
      {
        $val.= "Deactive";
      }
      $val.='</td>
      <td><a class="btn btn-primary" href="./edit-word.php?q='.$row['id'].'"><i class="fa fa-pencil"></i></a>&nbsp; 
      <a class="btn btn-danger" onclick="return check()" href="./delete-word.php?q='.$row['id'].'"><i class="fa fa-trash-o"></i></a></td>
    </tr>';   
    echo $val; 
    }
} else {
    echo '<tr><td colspan=4>0 Record</td></tr>';
}?>
      
     
      
    </tbody>
  </table>
  <script>
    function check() {
      return confirm("Are you sure?");
    }  
  </script>
  <?php include('include/footer.php'); ?>
