<?php 

include 'db\minichat.php';
$minichat = new minichat();
 
$source = filter_input(INPUT_GET, 'source');
if($source != null && $source == 'test') {
    $data = $minichat->getMinichatData();
    echo json_encode($data);       
} else {
    $data = $minichat->getMinichatDataFromDB();
    echo json_encode($data);   
}
    
