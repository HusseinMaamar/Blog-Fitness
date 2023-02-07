<?php 

?>

<div class="block-form">
<form action="" method="post">
<div class="form-group" bis_skin_checked="1">
  <fieldset>
    <label class="form-label mt-4" for="readOnlyInput">Email</label>
    <input class="form-control" id="readOnlyInput" type="email" placeholder="Email" name="email">
  </fieldset>
</div>
<div class="form-group has-success" bis_skin_checked="1">
  <label class="form-label mt-4" for="inputValid">Mot de passe</label>
  <input type="password" class="form-control is-valid" id="inputValid" name="mdp">
</div>
<button class="btn btn-info mt-4">Connexion</button>  <a class="btn btn-outline-info mt-4 ms-3" href="?op=newUser">Inscription</a>
</form>
</div>