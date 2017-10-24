<?php include('include/header.php'); ?>
<div class="container-fluid">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Word</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<form class="form-horizontal" method="post" action="#">
  <div class="form-group">
    <label class="control-label col-sm-2" for="word">Word:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="word" placeholder="Enter Word" name="word">
    </div>
  </div>
  <div id="addCategoryArea">
      <div class="form-group">
        <label class="control-label col-sm-2" for="category">Category:</label>
        <div class="col-sm-10"> 
          <input type="text" class="form-control" id="category" placeholder="Enter Category" name="category[]">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="category">Detail:</label>
        <div class="col-sm-10"> 
         <textarea class="form-control" rows="8" name="detail[]"></textarea>
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
       <textarea class="form-control" rows="8" id="antonyms" name="antonyms"></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="category">Synonyms:</label>
      <div class="col-sm-10"> 
       <textarea class="form-control" rows="8" id="synonyms" name="synonyms"></textarea>
      </div>
    </div>
    <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success" >Submit</button>
    </div>
  </div>

</form>
  </div>
  <?php include('include/footer.php'); ?>


<script type="text/javascript">
$('#addCategoryButton').click(function () {
  $('#addCategoryArea').append('<div class="form-group"><label class="control-label col-sm-2" for="category">Category:</label><div class="col-sm-10"><input type="text" class="form-control" id="category" placeholder="Enter Category"  name="category[]"></div></div><div class="form-group"><label class="control-label col-sm-2" for="category">Detail:</label><div class="col-sm-10"><textarea class="form-control" rows="8"  name="detail[]"></textarea></div></div>');
});
$('textarea#antonyms').tagEditor({
    initialTags: [],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Antonyms ...'
});
$('textarea#synonyms').tagEditor({
    initialTags: [],
    delimiter: ', ', /* space and comma */
    placeholder: 'Enter Synonyms ...'
});
</script>