<?php 
include("../config/config.php"); 


$query = "SELECT product_qty, product_price, region, shop_name, date_created FROM bbm_data 
WHERE product_name = 'Bitter gourd / Ampalaya' AND shop_name = 'Pasay City Wet Market' and date_created between '2023-09-01' and '2023-09-30'";


$result = mysqli_query($conn, $query); 

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row; 
}


echo json_encode($data);


?> 
