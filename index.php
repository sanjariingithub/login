<?php 
 include "init.php";
  if (isset($_POST['signup'])){
      $data = [
          'name'             => $_POST['full_name'],
          'email'            =>$_POST['email'],
          'password'         =>$_POST['password'],
          'confirm_password' =>$_POST['confirm'],
          'name_error'  => '',
          'email_error' => '',
          'password_error' =>'',
          'confirm_error' => ''     
    ];
    // name validation
    if(empty($data['name'])){
        $data['name_error'] = "Name is required";
    }
    // email validation
    if(empty($data['email'])){
        $data ['email_error'] = "Email is required";
    } else{
       if ($source->Query("SELECT * FROM users WHERE email=?",[$data['email']])){
           if($source->CountRows()> 0 ){
               $data['email_error']="Sorry email is already exist ";
           }
       }
    }

    // password validation
    if(empty($data['password'])) {
        $data['password_error'] = "password is required ";
    } else if(strlen($data['password'])<5){
        $data['password_error'] = "password is too short ";
    }
    // confirm password validation 
    if(empty($data['confirm_password'])){
        $data['confirm_error']="confirm password is required";
   } 
   if ($data['password']!= $data['confirm_password']){
       $data['confirm_error'] = "Confirm password not matched";
   }
// submit the form 

 if(empty($data['name_error'])&& empty($data['email_error'])&& empty($data['password_error'])&&empty($data['confirm_error'])){
     $password = password_hash($data['password'], PASSWORD_DEFAULT);
     if($source->Query("INSERT INTO users (name,email,password) VALUES (?,?,?)", [$data['name'],$data['email'],$data['password']]))
 {

    $_SESSION['account_created']="Your account is successfully created ";
    header("location:login.php");
     }

    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <div class="container">
     <div class ="header">
     <h2>Register<h2>

     </div>
     <form action="" method="post">
         <div>
             <label for="full_name"> Username: </label>
             <input type="text" name="full_name" required
             value = "<?php if(!empty($data['name'])): echo $data['name']; endif ;?>">
             <div class ='error'>
                 <?php if(!empty($data['name_error'])) :?>
                    <?php echo $data['name_error']?>
                    <?php  endif; ?> </div>
</div><br>
<div>
             <label for="email"> Email: </label>
             <input type="email" name="email" required
             value = "<?php if(!empty($data['email'])): echo $data['email']; endif ;?>">
</div><br>
<div class="error">
    <?php
    
   if(!empty($data['email_error'])): ?>
   <?php echo $data['email_error']; ?>
   <?php endif;?>
</div>
<div>
             <label for="password"> Password: </label>
             <input type="password" name="password" required
             value = "<?php if(!empty($data['password'])): echo $data['password']; endif ;?>">
             <div class ='error'>
                 <?php if(!empty($data['password_error'])) :?>
                    <?php echo $data['password_error']?>
                    <?php  endif; ?> </div>
</div><br>
<div>
             <label for="confirm"> Confirm password: </label>
             <input type="password" name="confirm" required
             value = "<?php if(!empty($data['confirm_password'])): echo $data['confirm_password']; endif ;?>">
             <div class ='error'>
                 <?php if(!empty($data['confirm_error'])):?>
                    <?php echo $data['confirm_error']?>
                    <?php  endif; ?> </div>
</div> <br>
      <button type="submit" name="signup"> signup </button> <br>
      <p> Already a user?<a href="login.php"> <b><i> Log In </b></i></a></p>

 </form>
</div>   
</body>
</html>