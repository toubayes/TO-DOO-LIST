

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rest password</title>
    <link rel="icon" href="img/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<?php require_once 'nav.php';?>
    <main class="container ">
<?php         
if(!isset($_GET['code'])){
echo '<form method="POST">
<div class="p-3 shadow mb-3">email </div>
<input class="form-control" type="email" name="email"  required/>
<button class="btn btn-warning mt-3 w-100" type="submit" name="resetPassword" >
Send a password reset link to an email
</button> 
</form > ';
}else if(isset($_GET['code']) && isset($_GET['email'])){
echo '<form method="POST">
<div class="p-3 shadow mb-3">
new password
</div>
<input class="form-control" type="text" name="password" required/>
<button type="submit" class="btn btn-warning mt-3 w-100" name="newPassword">rest password</button>
</form>';
}
?>


<?php 
if(isset($_POST['resetPassword']) ){

   require_once 'connectDataBase.php';
    $checkEmail = $database->prepare("SELECT email,SECURITY_CODE FROM users WHERE email = :email");
    $checkEmail->bindParam("email",$_POST['email']);
    $checkEmail->execute();

    if( $checkEmail->rowCount() > 0){
        require_once 'mail.php';
        $user = $checkEmail->fetchObject();
        $mail->addAddress($_POST['email']);
        $mail->Subject = "rest password";
    $mail->Body = 'rest password link
        <br>
        ' . '<a href="http://localhost/php_mysql_learning_2021/project1--simple_website/rest.php?email='.$_POST['email']. 
        '&code='.$user->SECURITY_CODE. '">http://localhost/php_mysql_learning_2021/project1--simple_website/rest.php?email='.$_POST['email']. 
        '&code='.$user->SECURITY_CODE.'</a>';
        ;
        
        $mail->setFrom("youcefleprince463@gmail.com", "youcef dev");
        $mail->send();
        echo '
        <div class="alert alert-success mt-3">
         we Send a password reset link to an email     </div> 
     ';
    }else{
        echo '
        <div class="alert alert-warning mt-3">
        this email not exist
        </div> 
        ';
    }
}
?>


<?php 

if(isset($_POST['newPassword'])){
    require_once 'connectDataBase.php';
   $updatePassword = $database->prepare("UPDATE users SET password 
   = :password WHERE email = :email");
   $updatePassword->bindParam("password",$_POST['password']);
   $updatePassword->bindParam("email",$_GET['email']);
   
   if($updatePassword->execute()){
    echo '
    <div class="alert alert-success mt-3">
    rest password succesfuly
    </div> 
    ';
   }else{
    echo '
    <div class="alert alert-danger mt-3">
    rest password falied
    </div>
    ';
   }
}

?>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
