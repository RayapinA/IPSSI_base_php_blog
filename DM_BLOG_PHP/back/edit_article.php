<?php include './function_article.php'; ?>

<?php if(isset($_GET['id']) && SecureInput($_GET['id']) !== ""){

          if(is_array(getArticleContent($_GET['id']))){
             $article_content = getArticleContent($_GET['id']); 
          }
        }
        else{
          $article_content[0]['content'] = "";
          $article_content[0]['title'] = "";
        }
       
?>
<div id='edit_zone'>
<form action="function_article.php" method="POST" enctype="multipart/form-data">
<input type="hidden" value="2" name='action'>
<input type="hidden" value="<?php echo $article_content[0]['id_article']?>" name='id_article'>
<div class="row">
        <div class="input-field col s12">
          <input id="title" class="materialize-textarea" placeholder="Titre" type="text" value="<?php echo $article_content[0]['title']?>" name="title">
       </div>
    </div>
        <div class="file-field input-field">
        <div class="btn">
            <span>Image</span>
            <input type="file" name="file">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
        </div>
       
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" placeholder="Contenu" name="content"> <?php echo $article_content[0]['content'] ?> </textarea>
        </div>
    </div>
    <div class="btn">
    <input type="submit" value="Valider">
    </div>
  </form>
  </div>