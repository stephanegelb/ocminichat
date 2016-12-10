<?php 

class MinichatTable
{
    public $id;
    public $pseudo;
    public $message;
}

function getMinichatTable($id, $pseudo, $message) {
    $data = array('id' => $id, 'pseudo' => htmlspecialchars($pseudo), 'message' => htmlspecialchars($message));
    return $data;
}

function getMinichatData() {
    $data = array();
    array_push($data, getMinichatTable(1, 'Rene', "message 1 de Rene"));
    array_push($data, getMinichatTable(2, 'René', "message 2 de Rene"));
    array_push($data, getMinichatTable(3, 'René', "message 3 de René"));
//    array_push($data, getMinichatTable(1, "René", "message 2 de René"));
//    array_push($data, getMinichatTable(1, "Jean", "message 1 de Jean"));
//    array_push($data, getMinichatTable(1, "Maurice", "message 1 de Maurice"));
//    array_push($data, getMinichatTable(1, "Jean", "message 10 de Jean"));
    return $data;        
}

function getProducts() {
    // PHP array
    $products = array(
        // product abbreviation, product name, unit price
        array('choc_cake', 'Chocolate Cake', 15),
        array('carrot_cake', 'Carrot Cake', 12),
        array('cheese_cake', 'Cheese Cake', 20),
        array('banana_bread', 'Banana Bread', 14)
    );
    
    return $products;
}

function getProductsJson() {
    $products = getProducts();
    $json = json_encode($products);
    return $json; 
}

function getMinichatDataFromDB() {
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    } catch (Exception $ex) {
        die('Erreur : '.$ex->getMessage());
    }

    $statement = 'SELECT id, pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10';
    $reponse = $bdd->query($statement);

    $array = array();
    while($data = $reponse->fetch()) {
        array_push($array, getMinichatTable($data['id'], $data['pseudo'], $data['message']));
    }
    $reponse->closeCursor();
    
    return $array;
}
 
$source = filter_input(INPUT_GET, 'source');
if($source != null && $source == 'db') {
    $data = getMinichatDataFromDB();
    echo json_encode($data);       
} else {
//    $data = getMinichatData();
//    echo json_encode($data);   
    $data = getMinichatDataFromDB();
    echo json_encode($data);      
}
    
