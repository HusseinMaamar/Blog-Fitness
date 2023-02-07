<?php
use model\Access;
$id = $_GET['id'];
$a = new Access;
$r =$a->selectComent($id);
?>

<?php   if($r !=null): ?>
  <div class="overflow-auto mt-3" style="max-height: 400px;">
  <?php   foreach($r as $coment): ?>
<div class="shadow p-1 mb-2 bg-light opacity-50">
  <p class="d-inline ms-2 fs-4"><i class="fa-sharp fa-solid fa-circle-user"></i> <?= $coment['prenom'] ; ?></p> 
  <div class="float-r"> <i class="fa-solid fa-clock"></i> <?= $coment['date_coment'] ; ?></div>
  <p class="ms-2"><i class="fa-solid fa-arrow-turn-down-right"></i><?= $coment['coment'] ; ?></p>
</div>
<?php  endforeach;?> 
</div>
<?php  endif;?> 

