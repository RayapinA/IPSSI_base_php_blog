<?php 
include '../header.php';
include '../config/config.php';
try{
    
    $bdd = new PDO('mysql:host=mariadb;dbname=TpFinal_Rayapin;charset=utf8', $user, $password);
}
catch (Exception $e)
{

      die('Erreur : ' . $e->getMessage());

}
function passIsValid()
{
  global $bdd;
  
  cleanInjection();
  $stmt = $bdd->prepare("SELECT * FROM user where username = :name");
  $stmt->bindParam(':name', $_POST['username']);
  $stmt->execute();
  
  while ($row = $stmt->fetch()) {
    
       if($password_bdd = password_verify($_POST['password'], $row['password'])){
         
         $_SESSION['id_user'] = $row['id_user'];
         $_SESSION['username'] = $row['username'];
         $_SESSION['connect'] = true;
         header('location:dashboard.php');
         exit();
     }
  }
}
function logOut()
{
  $_SESSION = array();
  $_SESSION['connect'] = false;
}
function insertUser()
{
  global $bdd;
  cleanInjection();
  if(!verifUsername($_POST['username'])){
    return false;
  }


  $stmt = $bdd->prepare("INSERT INTO `user` (`id_user`, `username`, `password`) VALUES (NULL, :username, :password)");
  
  $stmt->bindParam(':username', $_POST['username']);
  $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $stmt->bindParam(':password', $password_hash);

  $stmt->execute();
}
function cleanInjection()
{
  $_POST['password'] = htmlspecialchars($_POST['password']);
  $_POST['username'] = htmlspecialchars($_POST['username']);
}
function verifUsername(string $username_to_insert) : boolean
{
$array_usernames = getUsername();
foreach($array_usernames as $username){
  if(in_array($username_to_insert,$username)){
    return false;
  }
}
  return true;

}
function getUsername()
{
  global $bdd;
  
  $stmt = $bdd->prepare("SELECT username FROM user");
  $stmt->execute();
  $username = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $username;

}


?>
