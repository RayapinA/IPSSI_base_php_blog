<?php include './function_article.php'; ?>

Creation d'article
<div id='edit_zone'>
<form action="function_article.php" method="POST" enctype="multipart/form-data">
<input type="hidden" value="1" name='action'>
<div class="row">
        <div class="input-field col s12">
          <input id="title" class="materialize-textarea" placeholder="Titre" type="text"  name="title" required>
       </div>
    </div>
        <div class="file-field input-field">
        <div class="btn">
            <span>Image</span>
            <input type="file" name="file" required>
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
        </div>
       
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textarea1" class="materialize-textarea" placeholder="Contenu" name="content" required></textarea>
        </div>
    </div>
    <div class="btn">
    <input type="submit" value="Valider">
    </div>
  </form>
  </div>