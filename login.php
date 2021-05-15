<?php
  require 'authcontroller.php';
?>

<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="login.css">
   
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div login">
                <form action="login.php"method="post">
                    <h3 class="text-centre">Login</h3>
                    

                    <?php if(count($errors) >0): ?> 
                     <div class="alert alert-danger">
                     <?php  foreach($errors as $error): ?> 
                          <li>  <?php echo $error;  ?></li>
                          <?php endforeach;?>
                      </div>
                  <?php endif;?>


                    <div class="form-group">
                        <label for="username" >Username or Email</label>
                        <input type="text" name="username"class="form-control form-control-lg" ?>

                    </div>
                   
                    <div class="form-group">
                        <label for="password" >Password</label>
                        <input type="password" name="password"class="form-control form-control-lg">
                    </div>
                   
                    <div class="form-group">
                        <button type="submit" name="login-btn"class="btn btn-primary btn-block btn-lg" >Login</button>
                    </div>     
                     <p class="text-centre">Already a member?<a href="register.php">Signup </a></p>   
                    </form> 
                </div>
            </div>
        </div>
    </div>
</body>

<!--Bootstrap-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</html> 
