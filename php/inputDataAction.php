<?php


error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

include("../config/config.php");
//$db conn

function alertBox($message, $redirect){
	echo '<script type="text/javascript">';
	echo 'alert("'.$message.'"); window.top.location.href="'.$redirect.'";';
	echo '</script>';
}


if (isset($_POST['add'])){
    $category = $_POST['category'];
    $product = $_POST['product'];
    $price = (int)  $_POST['price'];
    $volume = (int) $_POST['quantity'];
    $region = $_POST['region'];
    $market = $_POST['market'];

   $query = "SELECT * FROM bbm_data WHERE category ='$category' AND product_name = '$product' AND region ='$region' AND shop_name = '$market' ";


    $query_res = mysqli_query($conn, $query); 


    
   $prices = array();
   $volumes = array();
   while($row = mysqli_fetch_assoc($query_res)){
       $prices[] = (int)$row['product_price']; 
       $volumes[] = (int)$row['product_qty'];
   }

   $lastPrice = (int) $prices[count($prices) -1 ];
   $lastVolume = (int) $volumes[count($volumes) - 1];

   $sql = "INSERT INTO bbm_data(region, shop_name, category, product_name, product_price, product_qty)
   VALUES ('$region', '$market', '$category', '$product', '$price', '$volume')";

    $res = mysqli_query($conn, $sql);   

    if($res){
        if($price > $lastPrice || $volume < $lastVolume){
            alertBox("Successfully Added! Critical Price/Volume Detected!", "../dashboard.php");
        }else{
            alertBox("Successfully Added! No Critical Price/Volume Detected! ", "../dashboard.php");
        }
    
    }
    else{alertBox("Unsuccessful", "../dashboard.php");}

}

?>

