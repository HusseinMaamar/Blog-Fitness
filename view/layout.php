<?php 
$c = new controller\Controller;
 //print_r($_SESSION['user']) ;
?>
<!DOCTYPE html>
<html lang="Fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBody</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.2.3/solar/bootstrap.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- navBar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid" bis_skin_checked="1">
  <a class="navbar-brand fs-1" href="?op=home"><strong>MY</strong><span class="badge rounded-pill bg-danger">BODY</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor02" bis_skin_checked="1">
      <ul class="navbar-nav me-auto">
      <?php if ($c->admin()): ?>
        <li class="nav-item">
          <a class="nav-link active text-warning" href="#"> <i class="fa-solid fa-user-secret"></i>  Admin <?= $_SESSION['user']['prenom'] ; ?>
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?op=add">➕Ajout d'article</a>
        </li>
        <?php elseif($c->user()):?>
        <li class="nav-item">
          <a class="nav-link active nav-link-user" href="#">🏋️ Bonjour <?= $_SESSION['user']['prenom'] ; ?>
            <span class="visually-hidden">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?op=add">➕Ajout d'article</a>
        </li>
      <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link" href="?op=list">Articles</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
          <div class="dropdown-menu" bis_skin_checked="1">
            <a class="dropdown-item" href="?op=selectCate&id='fitness'">Fitness</a>
            <a class="dropdown-item" href="?op=selectCate&id='nutrition'">Nutrition</a>
            <a class="dropdown-item" href="?op=selectCate&id='exercices'">Programmes</a>
          </div>
        </li>
        
      </ul>
      <?php if(!$c->connect()): ?>
      <a href="?op=newUser" class="btn btn-success me-2">Inscription</a>
      <a href="?op=login" class="btn btn-info">Connexion</a>
      <?php else:  ?>
        <a href='?op=deco'class="btn btn-info me-2">Déconnexion</a>
      <?php endif ?>
    </div>
  </div>
</nav>
<!-- endnav -->

<!-- Contenu -->
<h1 class="text-center mt-5 mb-5"><?= $title; ?></h1>
<div class="container mt-5 mb-5" style="min-height: 79vh;">
<div class="text-muted text-center fs-2"  bis_skin_checked="1">
  <?= $message ; ?>
</div>

  <?php if(!empty($alert)){?>
    <div class="alert alert-dismissible alert-info"  bis_skin_checked="1">
       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
       <?= $alert ; ?>
     </div>
    <?php }?>

  <?= $content; ?>
 </div>
 
 <!-- endcontenu -->

<!-- Parallaax -->



<!-- form Contact -->


<!-- footer -->
<footer class="container-fluid navbar-dark bg-dark " style="min-height: 60px; color: white;">
<a class="navbar-brand fs-1" href="#"><strong>MY</strong><span class="badge rounded-pill bg-danger">BODY</span></a>
<div class="row p-3">
<div class="list-group col-12 col-md-4 " bis_skin_checked="1">
  <a href="#" class="list-group-item list-group-item-action active  disabled fs-5">-BLOG</a>
  <a href="?op=selectCate&id='nutrition'" class="list-group-item list-group-item-action">Nutrition</a>
  <a href="?op=selectCate&id='fitness'" class="list-group-item list-group-item-action ">Fitness & Musculation</a>
  <a href="?op=selectCate&id='exercices'" class="list-group-item list-group-item-action ">Exercices & Cardio</a>
</div>
<div class="list-group col-12 col-md-4 " bis_skin_checked="1">
  <a href="#" class="list-group-item list-group-item-action active  disabled fs-5">-NOUS SUIVRE</a>
  <a href="#" class="list-group-item list-group-item-action"><i class="fa-brands fa-square-facebook "></i> Facebook</a>
  <a href="#" class="list-group-item list-group-item-action "><i class="fa-brands fa-instagram"></i> Instagram</a>
  <a href="#" class="list-group-item list-group-item-action "><i class="fa-brands fa-tiktok"></i> TikTok</a>
</div>
<div class="list-group col-12 col-md-4 " bis_skin_checked="1">
  <a href="#" class="list-group-item list-group-item-action"> Montion légal</a>
  <a href="#" class="list-group-item list-group-item-action ">CGU</a>
  <a href="#" class="list-group-item list-group-item-action disabled">💙🤍❤️</a>
</div>
</div>
<hr>
 <p class="text-center p-3" ><?= date('Y') ?> - Tous droits reservés - &copy; MyBody fait avec 🤍</p>
</footer>
<!-- endfooter -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>

