<?php 

include 'admin/config.php';
$word = strtolower($_POST['word']);
$resultHtml= '';
// get word
$allWord = array();
$id = 0;
$sql = "SELECT * FROM tb_words where word='$word' and status = '1' ";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $id=$row['id'];
        $allWord['word']=$row['word'];
    }
} 

if($id > 0){
        
    // get meaning
    $meaningSql = "SELECT * from tb_meaning where word_id='$id' ";
    $meaningResult = mysqli_query($conn, $meaningSql);

    // get antonyms
    $allAntonyms=array();
    $antonymsSql = "SELECT * from tb_antonyms where word_id='$id' ";
    $antonymsResult = mysqli_query($conn, $antonymsSql);
    if (mysqli_num_rows($antonymsResult) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($antonymsResult)) {
            $allAntonyms[]=$row['antonym'];
        }
    } 

    // get synonyms
    $allSynonyms=array();
    $synonymsSql = "SELECT * from tb_synonyms where word_id='$id' ";
    $synonymsResult = mysqli_query($conn, $synonymsSql);
    if (mysqli_num_rows($synonymsResult) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($synonymsResult)) {
            $allSynonyms[]=$row['synonym'];
        }
    } 


    $resultHtml.='<div style="padding-top: 50px;" class="features-container text-left section-container"> <div class="container">
    <h2>Searched...</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><span class="orange">Word:</span> '.ucfirst($allWord['word']).'</h3>
        </div>
        <div class="panel-heading"><span class="orange">Antonyms:</span> ';
        foreach($allAntonyms as $antonym ){    
            $resultHtml.=ucfirst($antonym).', ';
        }
        $resultHtml.= '</div>
        <div class="panel-heading"><span class="orange">Synonyms:</span>';
        foreach($allSynonyms as $synonyms ){    
            $resultHtml.=ucfirst($synonyms).', ';
        }
        $resultHtml.='</div>
        <div class="panel-body">
            <ul class="list-group">';
            if (mysqli_num_rows($meaningResult) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($meaningResult)) {
                    $resultHtml.= ' <li class="list-group-item">
                    <h3><span class="orange">Category:</span> '.ucfirst($row['category']).'</h3>
                    <p><span class="orange">Meaning:</span>'.ucfirst($row['detail']).' </p>
                </li>';
                }
            } else {
                echo "0 results";
            }
            $resultHtml.='</ul>
        </div>
    </div>

    </div></div>
    <hr>';

}
else{
    $resultHtml.='<div style="padding-top:50px"><h2>No Word Found !!!</h2></div>';
}
print_r ($resultHtml);
?>