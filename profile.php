<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
</head>
<body>
<h2><b>Welcome to profile ! </b></h2><br>
            <a href ="logout"> logout</a>
            
    <div>
        <?php if(isset($_SESSION['login_success'])): ?>
            <div class="success" >
            <?php echo $_SESSION['login_success'];?> 
        </div>
            <?php endif;?>
            <?php unset ($_SESSION['login_success']);?>
            <h2><b>Welcome to profile ! </b></h2><br>
            <a href ="logout"> logout</a>
            
</div>
    
</body>
</html>