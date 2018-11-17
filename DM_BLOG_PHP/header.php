<?php  declare(strict_types=1);   session_start();?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Blog Hockey Fun
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!-- CSS Files -->
    <link href="../css/style.css" rel="stylesheet" />
<!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css"  media="screen,projection"/>
  
</head>

<nav>
    <div class="nav-wrapper">
    <?php if(isset($_SESSION['username']) && $_SESSION['connect']){
                echo "<a href='#' class='brand-logo right'>". $_SESSION['username'] ."</a>";
                echo "<a style='float:left;' class='waves-effect waves-light btn left' href='../back/dashboard.php'>Dashboard</a>";
                echo "<a class='waves-effect waves-light btn left' href='../back/add_user.php'>Ajouter un utilisateur</a>";
                echo "<a class='waves-effect waves-light btn left' href='../back/logout.php'>Deconnexion</a>";
            }
            else{
                echo "<a class='waves-effect waves-light btn right' href='../back/login.php'> Sign In </a>";
                echo "<a class='waves-effect waves-light btn right' href='../back/login.php'> Sign Up </a>";
                
                      
            } 
    ?>
    <a class='waves-effect waves-light btn left' href='../front/list_article.php?page=0'>Site Web</a>
    </div>
  </nav>