<?php 
include("../config/config.php"); 

$selectedCategory = $_GET['category']; 


$query = "SELECT DISTINCT TRIM(product_name) as products FROM bbm_data WHERE category = '$selectedCategory'";


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