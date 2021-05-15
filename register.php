<?php
 require 'authcontroller.php';
?>


<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Here</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="register.css"> 
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form-div ">
                <form action="register.php" method="post">
                    <h3 class="text-centre">Register</h3>
          
                    <?php if(count($errors) >0): ?> 
                     <div class="alert alert-danger">
                     <?php  foreach($errors as $error): ?> 
                          <li>  <?php echo $error;  ?></li>
                          <?php endforeach;?>
                      </div>
                  <?php endif;?>
                
                    <div class="form-group">
                        <label for="username" >Username</label>
                        <input type="text" name="username" value="<?php echo $username ?>" class="form-control form-control-lg"required>
                    </div>
                    <div class="form-group">
                        <label for="email" >Email</label>
                        <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $email ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password" >Password</label>
                        <input type="password" name="password"class="form-control form-control-lg" required >
                    </div>
                    <div class="form-group">
                        <label for="passwordconf" >Confirm Password</label>
                        <input type="password" name="passwordconf"class="form-control form-control-lg" required>
                    </div> 
                    <div class="form-group">
                        <button type="submit" name="signup-btn"class="btn btn-primary btn-block btn-lg" > signup</button>
                    </div>     
                     <p class="text-centre">Already a member?<a href="login.php">Sign in </a></p>   
                    </form> 
                </div>
            </div>
        </div>
    </div>

  </body> 
</html>