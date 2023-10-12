<?php 
//  

    $query1 = "SELECT product_price, product_qty, date_created FROM bbm_data 
    WHERE category = 'Low Land Vegetables'
    AND
    product_name = 'Ampalaya' 
    AND shop_name = 'Ilocos Norte'
    AND date_created between '2023-09-18' AND '2023-09-24'";


$result1 = mysqli_query($conn, $query1); 

$data1 = array();

while($row1 = mysqli_fetch_assoc($result1)){
    $data1[] = $row1; 
}


$query2 = "SELECT product_price, product_qty, date_created FROM bbm_data 
WHERE category = 'Low Land Vegetables'
AND
product_name = 'Ampalaya' 
AND region = 'Region I'
AND date_created between '2023-09-18' AND '2023-09-24'";


$result2 = mysqli_query($conn, $query2); 

$data2 = array();

while($row2 = mysqli_fetch_assoc($result2)){
$data2[] = $row2; 
}


// $conn->close();


// if(isset($selectedProduct)){
//     echo $selectedProduct;
// }


// echo json_encode($data);


?> 
