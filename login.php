
<?php include "init.php";?>
<?php 
if(isset($_POST['login'])){
    $data = [
    'email'=> $_POST['email'],
    'password'=> $_POST['password'],
    'email_error'=> [],
    'password_error'=> []

    ];
    if(empty($data['email'])){
        $data['email_error']="Email is required";
    }
    if(empty($data['password'])){
        $data['email_error']="password is required";
    }
    if(empty($data['email_error'])&& empty($data['password_error'])){
        if($source->Qurey("SELECT * FROM users WHERE email= ?", [$data['email']])){
            if($source->CountRows() > 0 ){
                 $row = $source->Single();
                 $id= $row->id;
                 $datab_password = $row->password;
                 $name = $row->name;
                 if(password_verify($data['password'],$datab_password)){
                     $_SESSION['login_success'] = "Hi ".$name . "you are successfully login";
                     $_SESSION['id'] = $id;
                     header("location:profile.php");

                 } else {
                     $data['password_error'] = "please enter correct password";
                 }
            } else {
                $data['email_error'] = "please enter correct email";
            } 
        }
    }
}
// form submission 
?>
    
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div class="container">
     <div class ="header">
     <h2>login<h2>

     </div>
     
     <form action="" method="post">
     <div>
         <?php
         if(isset($_SESSION['account creatd'])) :?>
         <?php echo $_SESSION['account created']; ?>       
          <?php endif; ?>
         <?php unset($_SESSION['accouut created']);?>
</div>
         <div>
             <label for="email"> Email: </label>
             <input type="email" name="email" required 
             value = "<?php if(!empty($data['email'])): echo $data['email']; endif ;?>">>
             <div class ='error'>
             <?php if(!empty($data['email_error'])): ?>
                <?php echo $data['email_error'];?>
                <?php endif; ?> </div>
</div><br>

<div>
             <label for="password"> Password: </label>
             <input type="password" name="password" required
             value = "<?php if(!empty($data['password'])): echo $data['password']; endif ;?>">>
             <div class ='error'>
             <?php if(!empty($data['password_error'])): ?>
                <?php echo $data['password_error'];?>
                <?php endif; ?> </div>
</div><br>

      <button type="submit" name="login_user"> Log In </button>
      <p> Already a user?<a href="index.php"> <b><i> Signup Here </b></i></a></p>


 </form>
</div>   
</body>
</html>