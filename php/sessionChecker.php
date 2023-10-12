<?php
error_reporting(1);
session_set_cookie_params(0);

include("../config/config.php");
session_start();


if (!(isset($_SESSION['user']) && $_SESSION['login']==true)) {
	echo '<script type="text/javascript">';
	echo 'window.top.location.href = "../index.php"';
	echo '</script>';
	die ("Unauthorized Access");
	
}

?>