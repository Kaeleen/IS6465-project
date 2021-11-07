<?php
if(isset($_SESSION)){
    session_start();

    unset($_SESSION['user']);

    session_destroy();
}
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Registration Login</title>
        
        <link href="https://fonts.googleapis.com/css?familymPermanent+Marker" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="RegistrationStyle.css" > 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
        
    </head>
    
    <body id="loginPage">
        
        <div class="jumbotron text-center">
            <h1>INTI College</h1>
        </div>
    
        <div class="container-fluid bg-grey text-center" >
            <div class="row">
                <div class="col">
                    <form class="" action="check_login.php" method="post">
                        <input class="sign-text" type="text" name="name" placeholder="Username" >
                        <br>
                        <br>
                        <input class="sign-text" type="password" name="password" placeholder="Password">
                        <br>
                        <br>
                        <input type="submit" value="Login"/>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>
