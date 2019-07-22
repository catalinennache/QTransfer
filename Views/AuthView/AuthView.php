<?php
?>
<html>
<head>
    <title>Login</title>
     <link href="http://<?php echo $root; ?>Views/AuthView/loginstyle.css" rel="stylesheet" type="text/css">
    </head>
<body>
    <div class="logbox">
       <div class="head"> <img src="http://<?php echo $root; ?>Views/AuthView/10-512.png" width="100px"></div>
        <form class="loginform" method="post" action="">
            <h2>Please Log In </h2>
            <div>
            <label>User: </label>
            <input type="text" name="user" required></div>
           <div> <label>Pass: </label>
            <input type="password" name="password" required></div>
            <input type="submit" name="submit" value="GO !">
           <?php print_r( $_REQUEST); ?>
        </form>
     <?php
           /* if($model["badattempt"]?true:false) echo '<label>  UPS! User sau parola gresite.</label>';
            */
            ?>
    </div>
    
    </body>
</html>