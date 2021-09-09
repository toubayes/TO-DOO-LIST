<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
<nav class="navbar navbar-light bg-light">

<a class="navbar-brand" href="#">
<img src="../img/logo.jpeg" width="50" height="50" class="d-inline-block align-top" alt="" loading="lazy">
</a>



</nav>
    <main class="container " style="text-align: right; direction: rtl; max-width:760px;  margin:auto;" >
<?php 
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "USER"){


echo '<form method="POST">
<div class="p-3 shadow ">name :  </div>
<input class="form-control mb-1" type="text" name="name" value="'.$_SESSION['user']->name.'" required />
<div class="p-3 shadow "> prenom : </div>
<input  class="form-control mb-1" type="text" name="prenom" value="'.$_SESSION['user']->prenom.'" required />
<div class="p-3 shadow "> email : </div>
<input class="form-control mb-1" type="email" name="email" value="'.$_SESSION['user']->email.'" required />
<button class="w-100 btn btn-warning mt-1" type="submit" name="update" value="'.$_SESSION['user']->id.'">تحديث</button>
<a class="w-100 btn btn-light mt-1" href="index.php">go back</a>
</form>';
require_once '../connectDataBase.php';
if(isset($_POST['update'])){

    
    $updateUserData = $database->prepare("UPDATE users SET name 
    = :name ,prenom = :prenom ,email=:email WHERE id = :id ");
        $updateUserData->bindParam('name',$_POST['name']);
        $updateUserData->bindParam('prenom',$_POST['prenom']);
        $updateUserData->bindParam('email',$_POST['email']);
        $updateUserData->bindParam('id',$_POST['update']);

    if($updateUserData->execute()){
        echo '<div class="alert alert-success mt-3">your information has updated successfuly </div>';
        $user =  $database->prepare("SELECT * FROM users WHERE ID = :id ");
        $user->bindParam('id',$_POST['update']);
        $user->execute();
        $_SESSION['user'] = $user->fetchObject();
        header("refresh:2;");
    }  else{
        echo '<div class="alert alert-alert mt-3"> your information updated failed </div>';


    }
}
}else{
    session_unset();
    session_destroy();
    header("location:http://localhost/php_mysql_learning_2021/project1--simple_website/login.php",true);  
}
}else{
    session_unset();
    session_destroy();
    header("location:http://localhost/php_mysql_learning_2021/project1--simple_website/login.php",true);  
}

?>

</main>
</body>
</html>