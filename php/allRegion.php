<?php 
include("../config/config.php"); 

    $query = " SELECT product_qty, product_price,region, date_created, shop_name FROM bbm_data 
    WHERE product_name='Bitter Gourd / Ampalaya' and region = 'NCR' AND date_created between '2023-09-01' AND '2023-09-30' GROUP BY shop_name ORDER BY shop_name";


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
