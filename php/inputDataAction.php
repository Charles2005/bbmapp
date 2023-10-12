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
    $price = $_POST['price'];
    $volume = $_POST['quantity'];
    $region = $_POST['region'];
    $market = $_POST['market'];
    $sql = "INSERT INTO bbm_data(region, shop_name, category, product_name, product_price, product_qty)
    VALUES ('$region', '$market', '$category', '$product', '$price', '$volume')";

    $res = mysqli_query($conn, $sql);

    if($res){alertBox("Successfully Added", "../dashboard.php");}
    else{alertBox("Unsuccessful", "../dashboard.php");}

}

?>

