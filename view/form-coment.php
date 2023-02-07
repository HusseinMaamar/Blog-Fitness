<?php   
use model\Access;
$date =date("Y-m-d H:i:s");
$id = $_GET['id'];

if(!empty($_POST)){
    $a = new Access;
   
    if($_SESSION['user']['id']!= null){
         $q=   $a->insertComent();
            if($q == 1){
                $alert= "✅ Commentaire envoyé";
            }else{
                $alert= "❌Commentaire non envoyé";;
            }
        }else{
            
               header('location:?op=login');
             
        }
}
?>

<form action="" method="POST">
  <fieldset>
    <legend>Commentaire</legend>
    <input type="hidden" name="id_user" value='<?= $_SESSION['user']['id'] ?? ''; ?>'>
    <input type="hidden" name="id_article" value="<?= $id; ?>">
    <div class="form-group" bis_skin_checked="1">
      <label for="exampleTextarea" class="form-label mt-4">Exprimer vous:</label>
      <textarea class="form-control" id="exampleTextarea" rows="3" name='coment'></textarea>
    </div>
    <input type="hidden" name="date_coment" value="<?= $date; ?>">
    <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
  </fieldset>
</form>