<?php

session_start();
include  'db.php';



$errors=array();   //making $error global variable;
$username=""; 
$email="";
 // if users clicks on  the signup button
 if(isset($_POST['signup-btn'])){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $passwordconf=$_POST['passwordconf'];
    
    //validation of the user input
    if(empty($username)){
        $errors['username']="Username Required!";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $errors['email']="Please Enter a valid email!";
    }
    if(empty($email)){
        $errors['email']="Email  Required!";
    } 
    if(empty($password)){
        $errors['password']="Password Required!";
    }
    if($password!==$passwordconf){
      $errors['password'] ="The two passwords donot match!" ;
    }
    //check douplicate email
    $emailQuery= "SELECT * FROM user WHERE email=? LIMIT 1";
    $stmt=$conn->prepare($emailQuery);
    $stmt->bind_param('s',$email); 
    $stmt->execute();
    $result=$stmt->get_result();
    $userCount=$result->num_rows;
    $stmt->close();

    if($userCount>0){
       $errors['email']="Email Already Exists";
    }
 if(count($errors)===0){
     $password=password_hash($password,PASSWORD_DEFAULT); //incript password
     $token=bin2hex(random_bytes(50));// token for email verification..generates random string
     $verified= false;
     $sql="INSERT INTO user(username,email,verified,token,password) VALUES(?,?,?,?,?)";//prepaid statements so using ?
     $stmt=$conn->prepare($sql);
     $stmt->bind_param('ssdss',$username,$email,$verified,$token,$password);
      //s->string,d->boolean;
    
     // sendVerificationEmail($email,$token);
    if( $stmt->execute()){
       //login user
       $user_id=$conn->insert_id;
       $_SESSION['id']=$user_id;
       $_SESSION['username']=$username;
       $_SESSION['email']=$email;
       $_SESSION['verified']=$verified;
       



      // send verification mail

       $to=$email;
       $subject="Email Verification";
       $message= '
       <html lang="en">
       <head>
           <meta charset="UTF-8">
           <meta http-equiv="X-UA-Compatible" content="IE=edge">
           <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Verify email</title>
       </head>
       <body>
           <div class="wrapper">
                <p>
                   Thankyou for signing up on our website
                   .Please click on the link below to verify your email. 
                </p>
                <a href="http://localhost/demo/index.php?token='.$token. '">
                  Verify your email address
                 </a>
           </div>
       </body>
       </html> ';
       $headers="From: rkrtest2021@gmail.com";
     
       $headers = "MIME-Version: 1.0" . "\r\n";
       $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      
       if(mail($to,$subject,$message,$headers)) {
           echo " Email sent successfully to".$to;

       }
       else{
           echo "Email not sent";
       }




       //set flash message
       
       $_SESSION['message']="You are now logged in!";
       $_SESSION['alert-class']="alert-success";
       header('location:index.php');//Redirected to home page; 
       exit();

    } else{
        $errors['db_error']="Database error:Failed to Register";
    }

  }
 }



//<!-- if user clicks on the login button-->
   
if(isset($_POST['login-btn'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    //validation of the user input
    if(empty($username)){
        $errors['username']="Username Required!";
    }
    if(empty($password)){
        $errors['password']="Password Required!";
    }
 if(count($errors)===0){

    $sql="SELECT*FROM user WHERE email=? OR username=? LIMIT 1";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('ss',$username,$username);
    $stmt->execute();
    $result=$stmt->get_result();
    $user=$result->fetch_assoc();
    
    if(password_verify($password,$user['password'])){
      //login sucess
      
      $_SESSION['id']=$user['id'];
      $_SESSION['username']=$user['username'];
      $_SESSION['email']=$user['email'];
      $_SESSION['verified']=$user['verified'];
      
     
         //set flash message
      $_SESSION['message']="You are now logged in!";
      $_SESSION['alert-class']="alert-success";
      header('location:index.php');//Redirected to home page; 
      exit();  
    }
    else{
        $errors['db_error']="Database error:failed to register";
    }
  }


//logout user 
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['verified']);
    header('location: login.php');
    exit();
}
}

?>