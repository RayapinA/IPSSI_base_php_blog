<?php session_start();?>
<?php include '../header.php'; ?>
<?php include './function_article.php'; ?>


Page de création d'article
<div id='add_article'>
    <form action="./function_article.php" method="post" enctype="multipart/form-data">

        <div class="row">
            <div class="input-field col s6">
            <input  id="title" type="text" placeholder='Choissisez un titre qui va attirer les internautes' name='title'>
            </div>
        </div>

        <div class="row">
            <div class="file-field input-field col s6">
            <div class="btn">
                <span>Image</span>
                <input type="file" name="file" id="file">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <textarea id="textarea1" class="materialize-textarea" placeholder='Editez le nouvel article et publiez-le ' name="content_new_article"></textarea>
            </div>
        </div>
        <div class="btn">
                <input type="submit" value='Publier'>
        </div>
    
    </form>
<div>