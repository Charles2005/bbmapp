<?php 
include("../config/config.php"); 

$selectedProduct = $_GET['product']; 
$selectedRegion = $_GET['region']; 
$selectedCategory = $_GET['category'];
$startDate = $_GET['firstDate'];
$endDate = $_GET['lastDate'];
$selectedMarket = $_GET['market'];

    $query = "SELECT product_price, date_created, shop_name FROM bbm_data 
    WHERE category = '$selectedCategory'
    AND
    product_name ='$selectedProduct' 
    AND region = '$selectedRegion'
    AND date_created between '$startDate' AND '$endDate' GROUP BY shop_name ORDER BY shop_name";


$result = mysqli_query($conn, $query); 

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row; 
}

// $conn->close();


// if(isset($selectedProduct)){
//     echo $selectedProduct;
// }


echo json_encode($data);


?> 
