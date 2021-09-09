  

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>activate your account</title>
  <link rel="icon" href="img/logo.jpeg">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
  <main class="container">  
    <?php

if(isset($_GET['code'])){

require_once 'connectDataBase.php';
$checkCode = $database->prepare("SELECT SECURITY_CODE FROM users WHERE SECURITY_CODE = :SECURITY_CODE");
$checkCode->bindParam("SECURITY_CODE",$_GET['code']);
$checkCode->execute();
if($checkCode->rowCount()>0){
   
$update = $database->prepare("UPDATE users SET SECURITY_CODE = :NEWSECURITY_CODE ,
 ACTIVATED=true WHERE SECURITY_CODE = :SECURITY_CODE");
  $securityCode = md5(date("h:i:s"));
$update->bindParam("NEWSECURITY_CODE",$securityCode);
$update->bindParam("SECURITY_CODE",$_GET['code']);


if($update->execute()){
    echo '<div class="alert alert-success" role="alert">
  your account has activated successfuly
  </div>';
  echo '<a class="btn btn-warning" href="login.php">تسجيل دخول</a>';
}
}else{
    echo '<div class="alert alert-danger" role="alert">
thats code wrong , please try agin
  </div>';
}

}
?></main>

</body>
</html>
