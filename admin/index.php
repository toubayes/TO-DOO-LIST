<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my profil</title>
    <link rel="icon" href="img/logo.jpeg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <?php
  session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROLE === "ADMIN"){
echo '<div class="shadow-lg p-3 mb-3 bg-light rounded">welcome back admin '.$_SESSION['user']->name.'</div>'  ;
echo '<div class="shadow p-3 mb-3 bg-light rounded"> name : '.$_SESSION['user']->name .'</div>';
echo '<div class="shadow p-3 mb-3 bg-light rounded"> prenom :'.$_SESSION['user']->prenom .'</div>';
echo '<div class="shadow p-3 mb-3 bg-light rounded"> email : '.$_SESSION['user']->email .'</div>';
echo '<div class="shadow p-3 mb-3 bg-light rounded"> password :كلمة المرور مشفرة </div>';
echo '<div class="shadow p-3 mb-3 bg-light rounded">ROLE : Admin</div>';
echo "<form> <button class='btn btn-danger w-100'  type='submit' name='logout'>logout</button></form>";
echo '<a href="profil.php" class="btn btn-light w-100 ">update your information</a>';
echo '<a href="search.php" class="btn btn-dark w-100">management users</a>';

}else{
    header("location:http://localhost/php_mysql_learning_2021/project1--simple_website/login.php",true); 
    die("");
}
}else{
    header("location:http://localhost/php_mysql_learning_2021/project1--simple_website/login.php",true); 
    die(""); 
}
if(isset($_GET["logout"])){
    session_unset();
    session_destroy();
    header("location:location:http://localhost/php_mysql_learning_2021/project1--simple_website/login.php",true);
}
?> </main>
     
</body>
</html>

