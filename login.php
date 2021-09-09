<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="icon" href="img/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
<?php require_once 'nav.php';?>
    <main class="container">
        <?php
if(isset($_POST['login'])){

require_once 'connectDataBase.php';
$login = $database->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
$login->bindParam("email",$_POST['email']);
$passwordUser = sha1($_POST['password']);
$login->bindParam("password",$passwordUser);
// $login->bindParam("password",$_POST['password']);
$login->execute();
if($login->rowCount()===1){
$user = $login->fetchObject();
if($user->ACTIVATED === "1"){
    session_start();
    $_SESSION['user'] = $user;

    if($user->ROLE ==="USER"){
    header("Location:user/index.php",true);
    }else if($user->ROLE ==="ADMIN"){
        header("Location:admin/index.php",true);
    }

}else{
    echo '
    <div class="alert alert-warning"> 
     your password or your email is not corrected
    </div>
    ';
}
}else{
 echo '
 <div class="alert alert-danger">
your password is not exist in our database
 </div>
 ';   
}
}
?>
        <form action="" method="post">
            <label for="email" clss="form-label">email</label>
            <input type="email" class="form-control" name="email" id="" required>
            <label for="password" class="form-label">password</label>
            <input type="password" class="form-control" name="password" id="" required>
            <a href="rest.php">forget your password ?</a><br>
            <button type="submit" class="btn btn-warning mt-4" name="login">login</button>
            <a  class="btn btn-outline-dark mt-4" href="regester.php">regester</a>
        </form>
    </main>
</body>
</html>
