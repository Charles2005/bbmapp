<?php 
include("../config/conn.php"); 

$selectedProduct = $_GET['products']; 
$selectedRegion = $_GET['region']; 

$query = "SELECT AVG(product_price) AS avg_price, date_created FROM bbm_data WHERE product_name ='$selectedProduct' AND region = '$selectedRegion' GROUP BY date_created ORDER BY date_created";


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