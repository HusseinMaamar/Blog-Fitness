<?php 
$c = new controller\Controller;
//print_r($data);

?>
<div class="d-flex justify-content-center"><a href="?op=home" class="btn btn-outline-info m-3">↩️ Retour catégorie </a></div>

<div class="row p-3 text-center">
<?php foreach($data AS $article ):   //print_r($article); ?>
   
<div class="col-md-4 ">
<a href="?op=select&id=<?= $article['id'] ; ?>">
<div class="card   border-warning mb-3" bis_skin_checked="1" >
  <div class="card-header text-center fs-3" bis_skin_checked="1">
    <?php if( $article['category'] == 'fitness'): ?>
    💪 <?= $article['category'] ; ?>
    <?php elseif($article['category'] == 'nutrition'):?>
    🥗 <?= $article['category'] ; ?>
    <?php else:?>
    🏋️ <?= $article['category'] ; ?>
    <?php endif; ?>
    <?php if($c->admin()): ?>
      <a href="?op=update&id=<?= $article['id'] ; ?>" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i> Editer</a>
      <a href="?op=delete&id=<?= $article['id'] ; ?>" onclick="confirm('êtes vous sûr de supprimer cette article')" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Supprimer </a>
    <?php  endif ?>
    </div>
    <div class="card-body" bis_skin_checked="1">
    <img class="img-col" src="../assets/upload/<?= $article['image'] ; ?>" alt="">
    <h4 class="card-title"><?= $article['title'] ; ?></h4>
    <p class="text-info">🙋‍♂️Auteur:<?= $article['author'] ; ?> <span> ⏰ date mise en ligne : <?= $article['date_mise'] ; ?></span></hp>
    <div class="text-art">
    <p class="card-text opacity-25"><?= $article['text_article'] ; ?></p>
    </div>
  </div>
</div>
</a>
</div>
<?php endforeach; ?>
</div>