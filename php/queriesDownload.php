<?php 
include "../config/config.php"; 

$selectedProduct = $_GET['product']; 
$selectedRegion = $_GET['region']; 
$selectedCategory = $_GET['category'];
$startDate = $_GET['firstDate'];
$endDate = $_GET['lastDate'];
$selectedMarket = $_GET['market'];


    $query = "SELECT category, product_name, region, shop_name, product_price, product_qty, date_created FROM bbm_data
    WHERE product_name = '$selectedProduct'
    AND region = '$selectedRegion'
    AND shop_name = '$selectedMarket'
    AND  date_created between '$startDate' AND '$endDate'
    " ;

    $result = mysqli_query($conn, $query); 

    while($row = mysqli_fetch_assoc($result)) { 
        $data[] = $row; 
    }
        

    echo json_encode($data);




?> 