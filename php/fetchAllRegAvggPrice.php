<?php 
include("../config/config.php"); 

$selectedProduct = $_GET['product']; 
$selectedRegion = $_GET['region']; 
$selectedCategory = $_GET['category'];
$startDate = $_GET['firstDate'];
$endDate = $_GET['lastDate'];
$selectedMarket = $_GET['market'];

$query = "SELECT ROUND(AVG(product_price), 2) AS avg_price, MAX(product_price) as high_price, MIN(product_price) as low_price, product_name, region FROM bbm_data WHERE product_name ='$selectedProduct' AND region='$selectedRegion'";


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