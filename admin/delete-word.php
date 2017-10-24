<?php 
if( !session_id() )
{
  session_start();
}
include 'config.php';
// Delete Data
if (isset($_GET['q'])){
    $id = $_GET['q'];

    // sql to delete a record
    $wordSql = "DELETE FROM tb_words WHERE id=$id";
    $meaningSql = "DELETE FROM tb_meaning WHERE word_id=$id";
    $antonymSql = "DELETE FROM tb_antonyms WHERE word_id=$id";
    $synonymSql = "DELETE FROM tb_synonyms WHERE word_id=$id";
    
    if(mysqli_query($conn, $wordSql) && mysqli_query($conn, $meaningSql) && mysqli_query($conn, $antonymSql) && mysqli_query($conn, $synonymSql)){
        $_SESSION["msg"]="<div class='alert alert-success'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Word and its data Delete Successfully !
                </div>";
        header('location:all-words.php');
    }
    else{
        $_SESSION["msg"]="<div class='alert alert-danger'>
                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while Deleting
                </div>";
        header('location:all-words.php');
    }
}?>