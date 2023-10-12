<?php 
include("../config/config.php"); 

$selectedRegion = $_GET['region']; 


$query = "SELECT DISTINCT TRIM(shop_name) as market FROM bbm_data WHERE region = '$selectedRegion'";


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