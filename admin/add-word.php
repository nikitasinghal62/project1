<?php 
if( !session_id() )
{
  session_start();
}
include('config.php');


// add 
if(isset($_POST['addWord'])) {
  
  $word = $_POST['word'];
  $email = $_POST['email'];
  $status = $_POST['status'];
  
  // Insert words
  $wordSql = "INSERT INTO tb_words (word, email, status) VALUES ('".strtolower($word)."', '".strtolower($email)."', '".$status."')";
  mysqli_query($conn, $wordSql);
  $last_id = mysqli_insert_id($conn);

  // Insert category with meaning
  $itemValues=0;
  $query = "INSERT INTO tb_meaning (word_id,category,detail) VALUES ";
  $queryValue = "";
  for($i=0;$i<count($_POST['category']);$i++){
    if(!empty($_POST["category"][$i]) || !empty($_POST["detail"][$i])) {
      $itemValues++;
      if($queryValue!="") $queryValue .= ",";
        $queryValue .= "('".$last_id."','" . $_POST["category"][$i] . "', '" . $_POST["detail"][$i] . "')";
    }
  }
  $sql = $query.$queryValue;
  if($itemValues!=0) {
     $result = mysqli_query($conn,$sql);
     if(!empty($result)) $message = "Added Successfully.";
  }

  // Insert antonyms

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
        $antonymqueryValue .= "('".$last_id."','" . $antonymsArray[$i] . "')";
    }
  }
  $antonymsql = $antonymquery.$antonymqueryValue;
  if($antonymValues!=0) {
     $antonymresult = mysqli_query($conn,$antonymsql);
     if(!empty($antonymresult)) $message = "Added Successfully.";
  }

  // Insert synonyms

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
        $synonymqueryValue .= "('".$last_id."','" . $synonymsArray[$i] . "')";
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
include('include/header.php'); ?>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Word</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<form class="form-horizontal" method="post" action="#">
<input type="hidden" name="email" value="admin@admin.com">
  <div class="form-group">
    <label class="control-label col-sm-2" for="word">Word:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="word" placeholder="Enter Word" name="word" required>
    </div>
  </div>
  <div id="addCategoryArea">
      <div class="form-group">
        <label class="control-label col-sm-2" for="category">Category:</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="category" placeholder="Enter Category" required name="category[]">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="category">Detail:</label>
        <div class="col-sm-10"> 
         <textarea class="form-control" rows="8" name="detail[]" required></textarea>
        </div>
      </div>
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
          <label><input type="radio" name="status" checked value="1">Active</label>
        </div>
        <div class="radio">
          <label><input type="radio" name="status" value="0">Deactive</label>
        </div>
        </div>
    </div>

    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-success" name="addWord">Submit</button>
      </div>
     </div>

</form>
  </div>
  <?php include('include/footer.php'); ?>

<script type="text/javascript">
var counter=0;
$('#addCategoryButton').click(function () {
  counter++;
  $('#addCategoryArea').append('<div id="box'+counter+'"><div class="form-group"><label class="control-label col-sm-2" for="category"><button onclick="closeBox('+counter+')" class="btn btn-danger"><i class="fa fa-close"></i> </button> Category:</label><div class="col-sm-10"><input type="text" class="form-control" id="category" required placeholder="Enter Category"  name="category[]"></div></div><div class="form-group"><label class="control-label col-sm-2" for="category">Detail:</label><div class="col-sm-10"><textarea class="form-control" xrequired rows="8"  name="detail[]"></textarea></div></div></div>');
});
$('textarea#antonym').tagEditor({
    initialTags: [],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Antonyms ...'
});
$('textarea#synonym').tagEditor({
    initialTags: [],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Synonyms ...'
});
function closeBox(id){
  $('#box'+id).remove();
}
</script>