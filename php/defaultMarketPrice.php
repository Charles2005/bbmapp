<!-- <?php 
include("../config/conn.php"); 


    $query = "SELECT product_price, date_created FROM bbm_data 
    WHERE category = 'Low Land Vegetables'
    AND
    product_name ='Ampalaya' 
    AND shop_name = 'NCR'
    AND date_created between '2023-' AND '$endDate'";


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


?>  -->