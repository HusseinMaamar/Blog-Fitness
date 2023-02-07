<?php
use model\Access;
$a = new Access;

if(!empty($_POST)){
    $q = $a->contact($_POST['email'], $_POST['message'], $_POST['prenom']) ;
    if(!$q){
        $msg = 'Désolé, quelque chose a mal tourné. Veuillez réessayer plus tard.';
    }else{
        $msg = 'Message envoyé ! Merci de nous avoir contactés.';
    }
}
?>


</section>

<h2><strong>Rentrons</strong>En contact</h2>
<section class="contact" id="contact">
<?php if (!empty($msg)) {?>
    <div class="alert alert-dismissible alert-success"  bis_skin_checked="1">
       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <?= $msg ; ?>
     </div>
<?}?>
   <form action="#contact" method="POST">     
    <div class="form-group" bis_skin_checked="1">
      <label for="prenom" class="form-label mt-4">Prénom:</label>
      <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
    </div>
    <div class="form-group" bis_skin_checked="1">
      <label for="email" class="form-label mt-4">Email:</label>
      <input type="email" class="form-control" name="email" placeholder="Email" required>
    </div>

    <div class="form-group" bis_skin_checked="1">
      <label for="exampleTextarea" class="form-label mt-4">Message:</label>
      <textarea class="form-control" id="exampleTextarea" rows="3" name='message'></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
</form>
</section>