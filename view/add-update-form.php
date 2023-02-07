<?php 
//print_r($values);
//echo $op ;  echo '<br>';
//var_dump($values);
 //echo '<br>';
//echo $values['title']; 
//echo '<br>';
//var_dump($op);
if($op == 'update'){
  $values = $this->dbAccess->selectOneAccess($_GET['id']);
 }else{
    $values='';
 }
?>

<form action="" method="POST" enctype='multipart/form-data'>

    <legend>Ajout ou modification d'article</legend>
      
    <div class="form-group" bis_skin_checked="1">
      <label for="title" class="form-label mt-4">Titre de l'article</label>
      <input type="text" class="form-control" id="title" placeholder="Titre" name='title' value="<?= ($op == 'update') ? $values['title'] :' ';?>" >
    </div>

    <div class="form-group" bis_skin_checked="1">
      <label for="Textarea" class="form-label mt-4">Texte article</label>
      <textarea class="form-control" id="Textarea" rows="5" name='text_article'><?= ($op == 'update') ? $values['text_article'] :'';?></textarea>
    </div>

    <div class="form-group" bis_skin_checked="1">
      <label for="author" class="form-label mt-4">Category</label>
      <input class="form-control" type="text" id="category" name='category' value="<?= ($op == 'update') ? $values['category'] :'';?>">
    </div>

    <div class="form-group" bis_skin_checked="1">
      <label for="author" class="form-label mt-4">Author</label>
      <input class="form-control" type="text" id="author" name='author' value="<?= ($op == 'update') ? $values['author'] :'';?>">
    </div>

    <div class="form-group" bis_skin_checked="1">
      <label for="formFile" class="form-label mt-4">Image</label>
      <input class="form-control" name='image' type="file" id="formFile" >
    </div>
   
    <button type="submit" class="btn btn-info mt-4">Valider</button>
  </fieldset>

</form>