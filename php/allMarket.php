<?php 
include("../config/config.php"); 


$query = "SELECT product_qty, product_price, region, shop_name, date_created FROM bbm_data 
WHERE product_name = 'Bitter gourd / Ampalaya' AND shop_name = 'Pasay City Wet Market' and DATE_SUB(CURDATE(), INTERVAL 30 DAY) <= date_created";


$result = mysqli_query($conn, $query); 

$data = array();

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row; 
}


echo json_encode($data);


?> 
