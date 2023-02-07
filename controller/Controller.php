<?php 
namespace controller;

use model\Access;
session_start();
class Controller
{
private $dbAccess;
public function __construct()
{
   $this->dbAccess = new Access; 
   //echo "✅ instanciation de la classe Controller réussi !";
}


  // Méthode permettant le pilotage de notre application
  public function handleRequest()
  {
      // On stocke la valeur de l'indice "op" transmis dans l'url
      $op = isset($_GET['op']) ? $_GET['op'] : 'home';

      try
      {
          if($op == 'add' || $op == 'update')
              $this->save($op); // si on ajoute ou on modifie un employé, la méthode save() sera exécutée
          elseif($op == 'select')
              $this->select(); // si on sélectionne un employé, la méthode select() sera exécutée
          elseif($op == 'selectCate')
              $this->selectCate(); // si on sélectionne un employé, la méthode select() sera exécutée
          elseif($op == 'delete')
              $this->delete(); // si on supprime un employé, la méthode delete() sera exécutée
          //elseif($op == 'recherche')
              //$this->recherche(); // si on effectue une recherche, la méthode recherche() sera exécutée
          elseif($op == 'list') 
              $this->selectAll(); // cas par défault, on appel la méthode selectAll()
          elseif($op == 'home') 
              $this->home(); // cas par défault, on appel la méthode home()
          elseif($op == 'newUser') 
              $this->signUpUser(); // cas par défault, on appel la méthode home()
          elseif($op == 'login') 
              $this->login(); // cas par défault, on appel la méthode home()
          elseif($op == 'deco') 
              $this->deconnexion(); // cas par défault, on appel la méthode home()
          else 
              throw new \Exception("404 error : La page n'a pas été trouvé !");
              
      }
      catch(\Exception $e)
      {
          echo '<div style="width: 400px; padding: 10px; background: 	#F4BB44; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
          echo "🛑 Une erreur s'est produite : 💬 " . $e->getMessage();
          echo '</div>';
      }
      //$this->coment();
  }
   // Méthode permettant de construire une vue (une page de notre application)
   public function render($layout, $template, $parameters = [])
   {
       // extract() : fonction prédéfinie qui permet d'extraire chaque indice d'un tableau sous forme de variable
       extract($parameters);
       // permet de faire une mise en mémoire tampon, on commence à garder en mémoire de la données
       ob_start();
       // Cette inclusion sera stockée directement dans la variable $content
       require_once "view/$template";
       // on stock dans la variable $content le template
       $content = ob_get_clean();
       // On temporise la sortie d'affichage
       ob_start();
       // On inclue le layout qui est le gabarit de base (header/nav/footer)
       require_once "view/$layout";
       // ob_end_flush() va libérer et fait tout apparaître dans le navigateur
       return ob_end_flush();
   }

   // Méthode permettant d'afficher tous les employés
   public function selectAll($alert = '')
{
    $this->render('layout.php', 'all-articles.php', [
        'title' => 'BLOG FITNESS de MYBODY ',
        'data' => $this->dbAccess->selectAllAccess(),
        'message' => "TOUT LES ARTICLES",
        'alert' => $alert
    ]);

}

public function select(){
    $alert = '';
    $id = isset($_GET['id']) ? $_GET['id'] : $_GET['op'] == 'home';
  /*   if(!empty($_POST)){
        $this->dbAccess->insertComent();
        $_SESSION['message']= "✅ Commentaire envoyé";
        header('location:?op=select&id='.$id);
    }else{
        '';
    } */
    $this->render('layout.php', 'detail-article.php', [
        'title' => 'BLOG FITNESS MYBODY',
        'data' => $this->dbAccess->selectOneAccess($id),
        'message'=>'DETAIL ARTICLE',//$title
        'alert'=> $alert
    ]);
}



   public function home($alert = '')
   {
    $this->render('layout.php', 'affichage-category.php', [
        'title' => 'BLOG FITNESS MYBODY',
        'message' => "ARTICLES PAR CATÉGORIE",
        'alert' => $alert
    ]);
   }
   public function selectCate(){
    $cate = isset($_GET['id']) ? $_GET['id'] : $_GET['op'] == 'list';
    $alert ='';
    if($_POST){
        print_r($_POST);
        $email = $_POST['email'];
        $message = ['message']; 
        $prenom = ['prenom'];
        $this->dbAccess->contact($email, $message, $prenom);
        $alert =  $_SESSION['messages'];
    }
    $this->render('layout.php', 'detail-article.php', [
        'title' => 'BLOG FITNESS MYBODY',
        'data' => $this->dbAccess->selectOneCateAccess($cate),
        'message'=>'TOUT LES ARTICLES '.strtoupper(str_replace("'",'',$cate)),
        'alert'=> $alert//$title
    ]);
}


 // ajout et update
 public function save($op){
    $alert = '';
    $id = isset($_GET['id']) ? $_GET['id'] : NULL;
     if(!empty($_POST)){
       if (!empty($_FILES) && !empty($_FILES['image']['name'])) {
        $date =date("Y-m-d H:i:s");
        $text = str_replace("'", "\\'", $_POST['text_article']) ;
        $pic_bdd = date_format(new \DateTime(),'dmYHis').uniqid().$_FILES['image']['name'];
        if (!file_exists('assets/upload')) {
            mkdir('assets/upload', 0777, true);
        }
        copy($_FILES['image']['tmp_name'],'assets/upload/'.$pic_bdd);

        $this->dbAccess->insertUpdateArticleAndUploadImg($date,$text, $pic_bdd);
       
        $alert = ($op == 'update') ? "✅ L'article n° $id à été modifié avec succès !" : "✅ Création de l'article effectué avec succès ! votre article sera publié s'il est approuvé par l'administration";
        $this->home($alert);
      }
    }
     $this->render('layout.php', 'add-update-form.php', [
        'title' => "AJOUTER / MODIFIER",
        'op' => $op,
        //'values' => $values,
        'message' => ($op == 'update') ? "modification de larticle n°:$id" : "Ajouter un article",
        
    ]); 
 }


public function delete(){
    $id = isset($_GET['id']) ? $_GET['id'] : $_GET['op'] == 'list';
    $this->dbAccess->deleteAccess($id);
    $alert = "✅L'article N°$id est supprimer";
    $this->home($alert);
}
public function signUpUser(){
    
    $alert = '';
   if(!empty($_POST)){
    $error = false;
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
       
        if (empty($_POST['email'])) {
            $alert.= 'le champ est obligatoire';
            $error = true;
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $alert.= 'L\'adresse mail est invalide';
            $error = true;
        }
    } if (empty($_POST['mdp'])) {
        $alert = 'le mot de passe est obligatoire et doit comporter au min 4 caractéres 
        max 8 caractéres';
        $error = true;
      }
      if(!$error){
        $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
        $this->dbAccess->signUpAccess($mdp);
        $alert = "✅ Création de compte effectué avec succès !";
        //header('location:?op=');
      }
    
     }
    $this->render('layout.php', 'sign-Up.php', [
        'title' => 'Création de compte MYBODY',
        'message'=>'Inscription',
        'alert'=>$alert
        
    ]);

}
// connexion (login USER)
public function login(){
    $alert = '';
    if(!empty($_POST)){
    $email = $_POST['email'];
    $this->dbAccess->loginAccess($email);
     $alert =  $_SESSION['messages'];
}
$this->render('layout.php', 'log-in.php', [
    'title' => 'MYBODY',
    'message'=>'CONNEXION',
    'alert'=>$alert
]);

}
public function connect(){
    if(isset($_SESSION['user'])){
        return true;
    }else{
        return false;
    }
    }

 public   function admin(){
        if($this->connect() && $_SESSION['user']['statut']=='ROLE_ADMIN'){
            return true;
        }else{
            return false;
        }
    }

public  function user(){
        if($this->connect() && $_SESSION['user']['statut']=='ROLE_USER'){
            return true;
        }else{
            return false;
        }
    }

    public function deconnexion(){
        $alert ='';
        if(isset($_GET['op']) && $_GET['op']=='deco'){
            unset($_SESSION['user']);
           $alert =  $_SESSION['messages']='A bientôt';
            //header('location:?op=home');
            //exit();
           }
        $this->home($alert);
    }


}
