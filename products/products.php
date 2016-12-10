<?php

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
