<?php
  include_once 'authController.php';

  if(!isset($_SESSION['id'])){     //if user is not logged in and tries to         //access the index page the following code
    header('location:login.php');  //redirects to the login page
    exit();
  }

?>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
   
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">


               <?php if(isset($_SESSION["message"])):?>
               <div class="alert <?php echo $_SESSION["alert-class"];?>">
               <!-- prints the message to the index page using session variable-->
                   <?php 
                     echo $_SESSION["message"];
                     unset($_SESSION["message"]);
                     unset($_SESSION["alert-class"]); //displays the login message once only
                   ?>
              
               </div>
               <?php endif; ?>
              <?php if(!$_SESSION['verified']): ?>      
               <h3>Welcome,<?php echo $_SESSION["username"];?></h3>
               
               
                <a href="index.php?logout=1" class="logout">Logout</a>


                 <div class="alert alert-warning">
                     You need to verify your account.
                     Sign in to your email account and 
                     click on the verification link we
                     just emailed you at <strong><?php echo
                     $_SESSION['email'];?></strong> 
                 </div> 
              <?php endif;?> 

              <?php if($_SESSION['verified']):?>    
                 <button class="btn btn-block btn-lg btn-primary">I am verified</button>
                 <?php endif;?> 
            </div>
            </div>
        </div>
    </div>
</body>



</html> 
