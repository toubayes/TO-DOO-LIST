<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sigin in</title>
    <link rel="icon" href="img/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<?php require_once 'nav.php';?>
    <main class="container">
<?php 
require_once 'connectDataBase.php';
if(isset($_POST['register'])){
    $checkEmail = $database->prepare("SELECT * FROM users WHERE email = :email");
    $email = $_POST['email'];
    $checkEmail->bindParam("email",$email);
    $checkEmail->execute();

    if($checkEmail->rowCount()>0){
        echo '<div class="alert alert-danger" role="alert">
      this account is allreday rxist
      </div>';
    }else{
        $name =$_POST['name'] ;
        $password = sha1($_POST['password']) ;
        $email = $_POST['email'];
        $prenom = $_POST['prenom'];

        $addUser = $database->prepare("INSERT INTO users(name,prenom,email,password,SECURITY_CODE,ROLE)
         VALUES(:name,:prenom,:email,:password,:SECURITY_CODE,'USER')") ;
        $addUser->bindParam("name",$name);
        $addUser->bindParam("prenom",$prenom);
        $addUser->bindParam("password",$password);
        $addUser->bindParam("email",$email);
        $securityCode = md5(date("h:i:s"));
        $addUser->bindParam("SECURITY_CODE",$securityCode);

        if($addUser->execute()){
            echo '<div class="alert alert-success" role="alert">
      create account successfuly 
          </div>';
          echo '<div class="alert alert-success" role="alert">
we send nun lin activation on your email
              </div>';

          require_once "mail.php";
          $mail->addAddress($email);
          $mail->Subject = "Your account verification code ";
          $mail->Body = '<h1> Thank you for registering on our site</h1>'
          . "<div> Link to verify your account" . "<div>" . 
          "<a href='http://localhost/php_mysql_learning_2021/project1--simple_website/active.php?code=".$securityCode  . "'>
           " . "http://localhost/php_mysql_learning_2021/project1--simple_website/active.php?code=" .$securityCode . "</a>";
          ;
          $mail->setFrom("youcefleprince463@gmail.com", "youcef dev");
          $mail->send();

        }else{
            echo '<div class="alert alert-danger" role="alert">
            something wrong
          </div>';
        }
       
    }

}
?>
        <form action="" method="post">
            <label for="name" class="fom label">your name</label>
            <input type="text" class="form-control" name="name" id="" required>
            <label for="prename" class="fom label">your prename</label>
            <input type="text" class="form-control" name="prenom" id=""required>
            <label for="email" class="fom label">your email</label>
             <input type="email" class="form-control" name="email" required id="">
             <label for="password" class="fom label">your password </label>
             <input type="password" class="form-control" name="password" required id="">
   
             <button type="submit" class="btn btn-outline-success mt-5" name="register">register</button>
             <a class="btn btn-warning mt-5" href="login.php">login in </a>
        </form>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>


