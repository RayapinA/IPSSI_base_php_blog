<?php include './function_login.php'; ?>
<?php if(isset($_POST['username']) && isset($_POST['password'])){
 insertUser();
}
?>
<div style='background-color:#FFFFFF;'>
<form method="POST" action="">
<div class="row">
        <div class="input-field col s6">
          <input id="identifiant" class="materialize-textarea" placeholder="ID" type="text"  name="username">
       </div>
       <div class="input-field col s6">
          <input id="password" class="materialize-textarea" placeholder="Password" type="password"  name="password">
       </div>
       <input type="submit" value="Valider">
    </div>
</div>