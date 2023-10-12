<?php 
include("../config/conn.php"); 

$selectedProduct = $_GET['products']; 
$selectedMarket = $_GET['market']; 

$query = "SELECT product_price, date_created FROM bbm_data WHERE product_name ='$selectedProduct' AND shop_name = '$selectedMarket'";


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