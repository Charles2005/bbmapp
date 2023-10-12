<?php 
include("../config/config.php"); 


$selectedProduct = $_GET['product']; 
$selectedRegion = $_GET['region']; 
$selectedCategory = $_GET['category'];
$startDate = $_GET['firstDate'];
$endDate = $_GET['lastDate'];
$selectedMarket = $_GET['market'];

$query = "SELECT ROUND(AVG(product_price), 2) AS avg_price, ROUND(AVG(product_qty),0) AS product_qty, MAX(product_qty) as high_vol, MIN(product_qty) AS  low_vol, MAX(product_price) as high_price, MIN(product_price) as low_price, product_name, shop_name FROM bbm_data WHERE  product_name = '$selectedProduct' AND region='$selectedRegion' AND shop_name = '$selectedMarket' ";


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