<?php include '../back/function_article.php'; ?>

<?php if(isset($_POST['id_article']) && isset($_POST['content'])){
  //var_dump($_POST['content']);
    if(!empty($_POST['content'])){
      secureInput($_POST['content']);
      insertComment();
     
      $_POST['content'] = "";
    }
  
}
?>
<?php $content = getArticleContent(secureInput($_GET['id']));
      $tableau_commentaire = getCommentaireByArticle(secureInput($_GET['id']));
      //var_dump($tableau_commentaire);
  $id_article = secureInput($_GET['id']); ?>

<a href="./list_article.php"><button> <i class='material-icons'>arrow_back</i>  </button></a>

<div id='content_article'> 

  <h1> <?php echo $content[0]['title']; ?> </h1>
  <br />

  <h4> publié par <?php echo getUsername($content[0]['author']); ?> </h4>

  <img src="../back/images/<?php echo $content[0]['image']; ?>">

  <div>
    <p> <?php echo $content[0]['content']; ?> </p>
    <hr /> 
    <div id="zone_comment">
    
    <?php  formatingZoneComment($tableau_commentaire)?>

        <form method="POST" action="">
          <input type="hidden" value=<?php echo $id_article ?> name="id_article">
          <textarea id="textarea1" class="materialize-textarea" name='content'></textarea>
          <span class="helper-text" data-error="wrong" data-success="right">Réagissez a cet article</span>
          <br />
          <input type='submit' value='Commentez'>
        </form>

    </div>  
  </div>
</div>


