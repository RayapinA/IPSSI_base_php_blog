<?php include './function_article.php'; ?>
<?php if(!isset($_SESSION['connect']) && $_SESSION['connect'] == false){
    header('location:./login.php');
    exit();
} ?>

<ul class="collection with-header">
    <li class="collection-header"><h4>Liste d'articles</h4> </li>
    <a class='waves-effect waves-light btn' href='./article.php'>Ajouter un article</a>
        <?php
            $articles_array = getAllArticle();
            foreach($articles_array as $article){
                itemListFormatting($article);              
            }
        ?>
  </ul>
    