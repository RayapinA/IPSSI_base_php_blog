<?php 
include '../header.php';
include '../config/config.php';
try{
    // Sous Windows
    $bdd = new PDO('mysql:host=localhost;dbname=dm_blog;charset=utf8', $user, $password);
  
    //Sous mac
    //$bdd = new PDO('mysql:host=localhost;dbname=dm_blog;charset=utf8', 'root', 'root');
  }
catch (Exception $e)
{

      die('Erreur : ' . $e->getMessage());

}

function insertArticle()
{
  global $bdd;
  
  $stmt = $bdd->prepare('INSERT INTO `article` (`id_article`, `title`, `content`, `image`, `author`)  VALUES (Null,:title,:content,:img, :author);');
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':content', $_POST['content']);

  $image = UploadedFileFormating($_FILES);

  $stmt->bindParam(':img',$image);
  $stmt->bindParam(':author', $_SESSION['id_user']);

  $stmt->execute();

}
function insertComment()
{
  global $bdd;
  
  $stmt = $bdd->prepare('INSERT INTO `commentaire` (`id`, `username`, `content`, `article`)  VALUES (Null,:username,:content, :article);');
  $stmt->bindParam(':username', $_SESSION['id_user']);
  $stmt->bindParam(':content', $_POST['content']);
  $stmt->bindParam(':article', $_POST['id_article']);

  $stmt->execute();

  $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $commentaires;


}
function deleteArticle($id_article)
{
      
  global $bdd;

  $stmt = $bdd->prepare('DELETE FROM `article` WHERE id_article = :id_article');
  $stmt->bindParam(':id_article', $id_article);

  $stmt->execute();
}
function editArticle() // Verifier la presence de la photo
{
  global $bdd;
  $stmt = $bdd->prepare('UPDATE `article` SET `title`=:title,`content`= :content,`image`= :img, `author`= :author  WHERE id_article = :id_article');
  $stmt->bindParam(':title', $_POST['title']);
  $stmt->bindParam(':content', $_POST['content']);

  $image = UploadedFileFormating($_FILES);

  $stmt->bindParam(':img',$image);
  $stmt->bindParam(':author', $_SESSION['id_user']);
  $stmt->bindParam(':id_article', $_POST['id_article']);

  $stmt->execute();
}

function getAllArticle()
{
  global $bdd;
  
  $stmt = $bdd->prepare("SELECT * FROM article");
  $stmt->execute();
  $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $articles;

}

function getCommentaireByArticle($id_article)
{
  global $bdd;
  
  //$stmt = $bdd->prepare("SELECT * FROM commentaire LEFT JOIN WHERE article=$id_article");
  $stmt = $bdd->prepare("SELECT commentaire.id,user.username,commentaire.content FROM `commentaire`LEFT JOIN user ON commentaire.username = user.id_user WHERE article = :id_article");
  $stmt->bindParam(':id_article',$id_article);
  $stmt->execute();
  $commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $commentaires;
}
function formatingZoneComment(array $tableau_commentaire){
  $html = "";
  for($i=0; $i < count($tableau_commentaire); $i++){
    $html .= "<div>
                <span class='username_comment'> ".$tableau_commentaire[$i]['username']." : </span>
                <br />
                <p> ".$tableau_commentaire[$i]['content']."</p>
              </div>";
                
  }
  echo $html;

}
function formatingListArticle()
{
  $tableau_articles = getAllArticle();

  if(isset($_GET['page']))
  $current_page = SecureInput($_GET['page']);
  else 
  $current_page = 0;

  $article_per_page = 5;
  $nbre_page = ceil(count($tableau_articles)/$article_per_page);
  $tableau_article_page = array_slice($tableau_articles,$article_per_page * $current_page,$article_per_page);
  
  $html = "";
  for($i=0; $i<count($tableau_article_page); $i++){

      $html .= "<li>
                  <div style='padding:10px 5px;'>";
                    
      if ($i % 2 == 0){
        $html .= "
        <a href='../front/article.php?id=".$tableau_article_page[$i]['id_article']."'>
          <h3 style='float:right;font-size:18px;'>".$tableau_article_page[$i]['title']." </h3>
        </a>
        <img style='width:250px;' src='../back/images/".$tableau_article_page[$i]['image']."'>";
      }
      else{
        $html .= "
        <a href='../front/article.php?id=".$tableau_article_page[$i]['id_article']."'>
          <h3 style='float:left;font-size:18px;'>".$tableau_article_page[$i]['title']." </h3>
      </a>
      <img style='width:250px;float:right;' src='../back/images/".$tableau_article_page[$i]['image']."'>";
      }
                      
      $html .= "  </div>
              </li>
            
              <div style='clear:both;'> </div>"; 
                 
  }
    $html .="<div style='text-align:center;'>
              << ";
  for($j=0; $j < $nbre_page; $j++){
    $html .= " <a  style='margin-right:5px;font-size:32px;' href='./list_article.php?page=".$j."'>".$j." </a>";
  }
    $html .=" >>
    </div>";
  
  echo $html;
}

function itemListFormatting(array $item)
{
    // pour la liste articles et la liste user
    echo " <li class='collection-item'>
                <div id='".$item['id_article']."'>".$item['title']."

                <a href='./dashboard.php?action=del&id=".$item['id_article']."' class='secondary-content'> <i class='material-icons'>delete</i> </a>
                <a href='./edit_article.php?id=".$item['id_article']."' class='secondary-content'> <i class='material-icons'>edit</i></a> 
                <a href='../front/article.php?id=".$item['id_article']."'  target='_blank' class='secondary-content'> <i class='material-icons'>send</i> </a>
                    
                </div>
            </li>";
  
}
function UploadedFileFormating(array $file)
{
  $regex = '/^.*\.(jpg|jpeg|png)$/i';
  if (0 == preg_match($regex, $file['file']['name'], $ext)) {
      $errors[] = "Veuillez choisir un fichier de type JPG ou PNG";
  }

  if ($file['file']['size'] > 2097152) {
    $errors[] = 'Le fichier dépasse la taille maximale';
  }

  if (empty($errors) == true) {
    $image_name = uniqid() . ".$ext[1]";
    move_uploaded_file($file['file']['tmp_name'], "images/".$image_name);
    return $image_name;
  } else {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
  }
}
function getArticleContent(string $id_article) 
{
  global $bdd;
  
  $stmt = $bdd->prepare("SELECT * FROM article WHERE id_article = $id_article");
  $stmt->execute();
  $info_article = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if($info_article)
    return $info_article;
  else
    return false;

}
function getUsername($id_user)
{
  global $bdd;
  
  $stmt = $bdd->prepare("SELECT username FROM user WHERE id_user = $id_user");
  $stmt->execute();
  $info_user = $stmt->fetch(); 

    return $info_user[0]; // A revérifier
}
function SecureInput($content_to_secure): string 
{
  $secure_content = htmlspecialchars($content_to_secure);

  return $secure_content;
}

if(isset($_POST['action']) && SecureInput($_POST['action'] == 1)){ //add article
    insertArticle();
    header('location:./dashboard.php');
    exit();
}
else if(isset($_POST['action']) && SecureInput($_POST['action'] == 2)){ // Edit article

  editArticle();
  header('location:./dashboard.php');
  exit();
}
else if(isset($_GET['action']) && SecureInput($_GET['action'] == "del")){ //Delete article
    if(isset($_GET['id']) && is_numeric(SecureInput($_GET['id']))){
      deleteArticle($_GET['id']);
  }
    
}
?>