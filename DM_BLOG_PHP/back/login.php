<?php include './function_login.php'; ?>
<?php if(isset($_POST['username']) && isset($_POST['password'])){
    PassIsValid();
}
    ?>
    
<div class="login-page">
<div class="form">
    <form class="login-form" method="post" action="">
    
      <input type="text" placeholder="Identifiant"  name='username'/>
      <input type="password" placeholder="Mot de passe" name='password'/>
      <input type='submit' value='Valider'>
    </form>
</div>  