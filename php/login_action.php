<?php

function alertBox($message, $redirect){
	echo '<script type="text/javascript">';
	echo 'alert("'.$message.'"); window.top.location.href="'.$redirect.'";';
	echo '</script>';
}

include("../config/config.php");
//$db_conn
if (isset($_POST['login'])) {
	$admin_usr = $_POST['admin-user'];
	$admin_pword =hash('sha256', $_POST['admin-password']);
	if(isset($admin_usr) && isset($admin_pword)){
		$sql = "SELECT * FROM admin_table WHERE admin_user = '$admin_usr' AND admin_password = '$admin_pword' ";
		$res = $conn->query($sql);
		
		if ($res) { 
			$count_row = $res->num_rows;
			if ($count_row > 0){
				session_start();
				$_SESSION['user'] = $_POST['admin-user'];
				$_SESSION['login'] = true;
				
				header("Location: ../dashboard.php");
				
			} else {
				alertBox("Invalid Username and Password Please try again", "../index.php");
				
			}

		}
		else { echo $conn->error; }
	}
}
?>