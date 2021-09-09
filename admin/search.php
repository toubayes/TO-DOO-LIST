
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>management user</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="icon" href="../img/logo.jpeg">
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
if($_SESSION['user']->ROLE === "ADMIN"){
echo '<form>
<input class="form-control" type="text" name="search" placeholder="بحث عن ...." />
<button class="btn btn-warning w-100 mt-3" type="submit" name="searchBtn" >بحث</button>
</form>
';

if(isset($_GET['searchBtn'])){
    $username = "root";
    $password = "";
    $database = new PDO("mysql:host=localhost; dbname=codershiyar;",$username,$password);
    require_once '../connectDataBase.php';
    $searchResult = $database->prepare("SELECT * FROM users WHERE name LIKE :name OR email LIKE :email");
    $searchValue = "%" . $_GET['search'] . "%";
    $searchResult->bindParam("name",$searchValue);
    $searchResult->bindParam("email",$searchValue);
    $searchResult->execute();
    echo '<table class="table mt-3">';
    echo  "<tr>";
    echo "<th>name</th>";
    echo "<th>email</th>";
    echo '<th>removed</th>';
    echo  "<tr>";
    foreach($searchResult AS $result){
        echo  "<tr>";
        echo "<td> ".$result['name'] ."</td>";
        echo "<td> ".$result['email'] ."</td>";
        echo '<td><form>
        <button class="btn btn-outline-danger" type="submit" name="remove" value="'.$result['id'].'">حذف</button>
            </form></td>';
        echo  "<tr>";
    }
    echo '</table>';
   
}

if(isset($_GET['remove'])){
    $removeItems = $database->prepare("DELETE FROM todolist WHERE user_id = :user_id ");
    $removeItems->bindParam("user_id",$_GET['remove']);
    $removeItems->execute();
   
    $removeUser = $database->prepare("DELETE FROM users WHERE id = :userId ");
    $removeUser->bindParam("userId",$_GET['remove']);
    if( $removeUser->execute()){
   echo '<div class="alert alert-info">تم حذف بنجاح</div>';
   header("Refresh: 2; url=search.php");
   
    }else{
      echo $removeUser->errorInfo();  
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