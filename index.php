<?php
session_start();
if ((isset($_SESSION['user']) && $_SESSION['login']==true)) {
	echo '<script type="text/javascript">';
	echo 'window.top.location.href = "dashboard.php"';
	echo '</script>';
	
}

?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="styles/login1.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Log-in</title>
    </head>
    <body>
     
      <div class="main">
      <img class="logo" src="assets/agriwatchlogo.png" alt="watch-logo" width="300px"/>
        <h2 class="fb-quote">BILIHAN AT BAGSAKAN NG MAMAMAYAN  <br> Version 2</h2>
        
        <div class="login-container">
            <form action="php/login_action.php" method="POST">

              
                <input type="text" name="admin-user" id="admin-user" class="input-cred" placeholder="Username" required>
                
                
                <input type="password" name="admin-password" id="admin-password" class="input-cred" placeholder="Password" required>
                <button type="submit" name='login' class="btn-login" id='login'>Log-in</button>
            
        </div>

        

      </div>

        

        


    </body>
</html>


