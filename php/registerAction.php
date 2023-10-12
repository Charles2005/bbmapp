<?php


error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

include("../config/config.php");
//$db conn

if (isset($_POST['add'])){
   $admin_usr = $_POST['admin-user'];
    $admin_pass = $_POST['admin-password'];
    $hash_pw = hash('sha256', $admin_pass);
    $sql = "INSERT INTO admin_table(admin_user, admin_password) 
    VALUES ('$admin_usr', '$hash_pw')";

    $res = mysqli_query($conn, $sql);

    if($res){echo "successful";}
    else{echo $conn->error;}

}

?>

