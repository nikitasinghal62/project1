<?php

//Ensure that a session exists (just in case)
if( !session_id() )
{
    session_start();
}

// Config file
include ('config.php');
// Get Date
if(isset($_GET['q'])){
  $id=$_GET['q'];

// get word
$wordSql = "SELECT * from tb_words where id=$id";
$wordResult = mysqli_query($conn, $wordSql);
  if (mysqli_num_rows($wordResult) > 0) {
      while($wordRow = mysqli_fetch_assoc($wordResult)) {
          $word= $wordRow['word'] ;
          $status= $wordRow['status'] ;
      }
  } 
  
// get meaings
$meaningSql = "SELECT * from tb_meaning where word_id='$id' ";

// get antonyms
$antonymSql = "SELECT * from tb_antonyms where word_id='$id' ";
$antonymResult = mysqli_query($conn, $antonymSql);
if (mysqli_num_rows($antonymResult) > 0) {
    while($antonymRow = mysqli_fetch_assoc($antonymResult)) {
        $antonymArray[] = $antonym = "'".$antonymRow['antonym']."'";
    }
} 
$antonymString=implode(",",$antonymArray);

// get synonyms
$synonymSql = "SELECT * from tb_synonyms where word_id='$id' ";
$synonymResult = mysqli_query($conn, $synonymSql);
if (mysqli_num_rows($synonymResult) > 0) {
    while($synonymRow = mysqli_fetch_assoc($synonymResult)) {
        $synonymArray[] = $synonym = "'".$synonymRow['synonym']."'";
    }
} 
$synonymString=implode(",",$synonymArray);

// update
if(isset($_POST['updateWord'])) {
  
  $id = $_POST['id'];
  $word = $_POST['word'];
  $status = $_POST['status'];
 
  count($_POST['category']);
  count($_POST['detail']);
  
  // Insert words
  $wordSql = "update tb_words set word = '".$word."', status='".$status."' where id=".$id;
  mysqli_query($conn, $wordSql);

  // Insert category with meaning
  $delCatSql = "DELETE FROM tb_meaning WHERE word_id=$id";
  mysqli_query($conn, $delCatSql);
  $itemValues=0;
  $query = "INSERT INTO tb_meaning (word_id,category,detail) VALUES ";
  $queryValue = "";
  for($i=0;$i<count($_POST['category']);$i++){
    if(!empty($_POST["category"][$i]) || !empty($_POST["detail"][$i])) {
      $itemValues++;
      if($queryValue!="") $queryValue .= ",";
        $queryValue .= "('".$id."','" . $_POST["category"][$i] . "', '" . $_POST["detail"][$i] . "')";
    }
  }
  echo $sql = $query.$queryValue;
  if($itemValues!=0) {
     $result = mysqli_query($conn,$sql);
     if(!empty($result)) $message = "Added Successfully.";
  }

  // Insert antonyms
  $delAntSql = "DELETE FROM tb_antonyms WHERE word_id=$id";
  mysqli_query($conn, $delAntSql);
  // antonyms string
  $antonymsString=$_POST['antonym'];
  // string to array convert
   $antonymsArray= explode(",",$antonymsString);
  // insert record one by one
  $antonymValues=0;
  $antonymquery = "INSERT INTO tb_antonyms (word_id,antonym) VALUES ";
  $antonymqueryValue = "";
  for($i=0;$i<count($antonymsArray);$i++){
    if(!empty($antonymsArray[$i])) {
      $antonymValues++;
      if($antonymqueryValue!="") $antonymqueryValue .= ",";
        $antonymqueryValue .= "('".$id."','" . $antonymsArray[$i] . "')";
    }
  }
  $antonymsql = $antonymquery.$antonymqueryValue;
  if($antonymValues!=0) {
     $antonymresult = mysqli_query($conn,$antonymsql);
     if(!empty($antonymresult)) $message = "Added Successfully.";
  }

  // Insert synonyms
  $delSynSql = "DELETE FROM tb_synonyms WHERE word_id=$id";
  mysqli_query($conn, $delSynSql);
  // antonyms string
  $synonymsString=$_POST['synonym'];
  // string to array convert
   $synonymsArray= explode(",",$synonymsString);
  // insert record one by one
  $synonymValues=0;
  $synonymquery = "INSERT INTO tb_synonyms (word_id,synonym) VALUES ";
  $synonymqueryValue = "";
  for($i=0;$i<count($synonymsArray);$i++){
    if(!empty($synonymsArray[$i])) {
      $synonymValues++;
      if($synonymqueryValue!="") $synonymqueryValue .= ",";
        $synonymqueryValue .= "('".$id."','" . $synonymsArray[$i] . "')";
    }
  }
  $synonymsql = $synonymquery.$synonymqueryValue;
  if($synonymValues!=0) {
     $synonymresult = mysqli_query($conn,$synonymsql);
     if(!empty($synonymresult)) $message = "Added Successfully.";
  }
  if(!empty($synonymresult) && !empty($antonymresult) && !empty($result)){
    $_SESSION["msg"]="<div class='alert alert-success'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Word Added Successfully !
    </div>";
    header('location:all-words.php');
  }else {            
    $msg = "<div class='alert alert-danger'>
    <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while word Adding !
    </div>";
    header('location:all-words.php');
  }
}
include('include/header.php');
?>

<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Word</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<form class="form-horizontal" method="post" action="#">
<input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="word">Word:</label>
    <div class="col-sm-10">
      <input type="text" required class="form-control" id="word" value="<?php echo $word; ?>" placeholder="Enter Word" name="word">
    </div>
  </div>
  <div id="addCategoryArea">
        <?php 
          $meaningResult = mysqli_query($conn, $meaningSql);
          if (mysqli_num_rows($meaningResult) > 0) {
              while($meaningRow = mysqli_fetch_assoc($meaningResult)) {
                  
                  echo '
                  <div id="box'.$meaningRow['id'].'">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="category"><button onclick="closeBox('.$meaningRow['id'].')" class="btn btn-danger"><i class="fa fa-close"></i> </button> Category:</label>
                      <div class="col-sm-10"> 
                        <input type="text" class="form-control" required id="category" value="'.$meaningRow['category'].'" placeholder="Enter Category" name="category[]">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="category">Detail:</label>
                      <div class="col-sm-10"> 
<textarea class="form-control" rows="8" required name="detail[]">'.trim($meaningRow['detail']).'</textarea>
                      </div>
                    </div
                  </div>
                  </div>';
              }
          } 
        }
        ?>
    
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-warning" id="addCategoryButton">Add More Category with Detail </button>
    </div>
  </div>
   <div class="form-group">
      <label class="control-label col-sm-2" for="category">Antonyms:</label>
      <div class="col-sm-10"> 
       <textarea class="form-control" rows="8" id="antonym" name="antonym" required></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="category">Synonyms:</label>
      <div class="col-sm-10"> 
       <textarea class="form-control" rows="8" id="synonym" name="synonym" required></textarea>
      </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="category">Status:</label>
        <div class="col-sm-10"> 
        <div class="radio">
          <label><input type="radio" name="status" <?php echo ($status ?  "checked" : "");  ?> value="1">Active</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="status" <?php echo (!$status ?  "checked" : "");  ?> value="0">Deactive</label>
        </div>
        </div>
    </div>
    <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success" name="updateWord">Update</button>
    </div>
  </div>
  
</form>
  </div>
  <?php include('include/footer.php'); ?>

<script type="text/javascript">
var counter=0;
$('#addCategoryButton').click(function () {
  counter++;
  $('#addCategoryArea').append('<div id="box2'+counter+'"><div class="form-group"><label class="control-label col-sm-2" for="category"><button onclick="closeBox2('+counter+')" class="btn btn-danger"><i class="fa fa-close"></i> </button> Category:</label><div class="col-sm-10"><input type="text" class="form-control" required id="category" placeholder="Enter Category"  name="category[]"></div></div><div class="form-group"><label class="control-label col-sm-2" for="category">Detail:</label><div class="col-sm-10"><textarea class="form-control" required rows="8"  name="detail[]"></textarea></div></div></div>');
});
$('textarea#antonym').tagEditor({
    initialTags: [<?php echo $antonymString; ?>],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Antonyms ...'
});
$('textarea#synonym').tagEditor({
    initialTags: [<?php echo $synonymString; ?>],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Synonyms ...'
});
function closeBox2(id){
  $('#box2'+id).remove();
}
function closeBox(id) {
  $('#box'+id).remove();
}
</script>