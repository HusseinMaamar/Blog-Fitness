<?php
// ma class acces aux données 
namespace model;
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
class Access{

  private $db;
  // fonnction de connexion
    public function getDb($fileIni) {
        if(!$this->db)
        {
        $tabProp= parse_ini_file($fileIni);
         // les proprietes des cnxs 
           $lsProtocole = $tabProp["protocole"];
           $lsServeur = $tabProp["serveur"];
           $lsPort = $tabProp["port"];
           $lsUT = $tabProp["ut"];
           $lsMDP = $tabProp["mdp"];
           $lsBD = $tabProp["bd"];
           /*
            * Connexion
            */

           try {
            $this->db = new \PDO ("$lsProtocole:host=$lsServeur;port=$lsPort;dbname=$lsBD;", $lsUT, $lsMDP ,
               [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
               $this->db->exec("SET NAMES 'UTF8'");
           } catch (\PDOException $e) {
               echo '<div style="width: 400px; padding: 10px; background: 	#CCE5FF; border-radius: 4px; margin: 0 auto; color: white; text-align: center;">';
               echo "🛑 Une erreur s'est produite : 💬 " . $e->getMessage();
               echo '</div>';
           } 
            //print_r($this->db);
           return $this->db;
        }
       }
         // selectALL
   public function selectAllAccess(){
    $data= $this->getDb('conf/cnx.ini')->query("SELECT * FROM article WHERE visibility= 1 ORDER BY title");
    $r = $data->fetchAll(\PDO::FETCH_ASSOC);
    return $r;
   }
   // selectOneParCategory
   public function selectOneCateAccess($cate){
    $data= $this->getDb('conf/cnx.ini')->query("SELECT * FROM article WHERE category = $cate AND visibility= 1");
    $r = $data->fetchAll(\PDO::FETCH_ASSOC);
    return $r;
   }
   // selectOne
       public function selectOneAccess($id){
        $data= $this->getDb('conf/cnx.ini')->query("SELECT * FROM article WHERE id = $id");
        $r = $data->fetch(\PDO::FETCH_ASSOC);
        return $r;
       }
    // insert coment
    public function insertComent(){
        $q= $this->getDb('conf/cnx.ini')->query("INSERT INTO coment (id_user,id_article,coment,date_coment)values($_POST[id_user],$_POST[id_article], '$_POST[coment]', '$_POST[date_coment]')");
        $r = $q->rowCount();
        return $r;
    }
    public function selectComent($id){
        $data= $this->getDb('conf/cnx.ini')->query("SELECT * FROM coment c INNER JOIN user u 
          on u.id = c.id_user 
          WHERE 
          c.id_article = $id 
         ");
       
            $r = $data->fetchAll(\PDO::FETCH_ASSOC); 
            return $r;
        
    }
   // tDelete
   public function deleteAccess($id){
    $q = $this->getDb('conf/cnx.ini')->query("DELETE FROM article WHERE id = $id");
   
   }
// inesret 
       public function insertUpdateArticleAndUploadImg($date, $text, $pic_bdd){
        $id = isset($_GET['id']) ? $_GET['id'] : 'NULL';
        $q= $this->getDb('conf/cnx.ini')->query("REPLACE INTO article (id, title, text_article, image, category, date_mise, author) VALUES ($id,'$_POST[title]','$text','$pic_bdd', '$_POST[category]','$date', '$_POST[author]')");
        return $q;
       }

   // inscription
   public function signUpAccess($mdp){
    $data= $this->getDb('conf/cnx.ini')->query("INSERT INTO user (prenom, email, mdp,statut)values('$_POST[prenom]','$_POST[email]','$mdp','ROLE_USER')");
   }
   // connexion user
   public function loginAccess($email){

    //if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
 /*    $url = "https"; 
   else
    $url = "http"; 
    
   // Ajoutez // à l'URL.
   $url .= "://"; 
    
   // Ajoutez l'hôte (nom de domaine, ip) à l'URL.
   $url .= $_SERVER['HTTP_HOST']; 
    
   // Ajouter l'emplacement de la ressource demandée à l'URL
   $url .= $_SERVER['REQUEST_URI'];  */
   
    $r= $this->getDb('conf/cnx.ini')->query("SELECT * FROM user WHERE email = '$email'");
         if($r->rowCount() == 1){
            $user = $r->fetch(\PDO::FETCH_ASSOC);
            if(password_verify($_POST['mdp'], $user['mdp'])){
                $_SESSION['user'] = $user;
                $_SESSION['messages'] = '✅💪Vous êtes connecté '.strtoupper($user['prenom']);
                header('location:?op=home');
            }else{
                $_SESSION['messages'] ='⛔Erreur sur le mot de passe';
                header('location:?op=login');
            }
    }else{
        $_SESSION['messages']  = "❌Aucun compte à cette adresse mail";
        header('location:?op=login');
    }
    return $user;
   }

   public function contact($email, $message, $prenom){
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.ionos.fr';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'info@kiracom.fr';
    $mail->Password = '';
    $mail->setFrom($email, $prenom);
    $mail->addAddress('info@kiracom.fr', 'MYBODY');
    if ($mail->addReplyTo($email, $prenom)) {
    $mail->Subject = 'CONTACT MYBODY';
    $mail->isHTML(false);
    $mail->Body = <<<EOT
    E-mail: {$email}
    Nom: {$prenom}
    Message: {$message}
EOT;
if (!$mail->send()) {
   $msg = false;
} else {
   
  $msg = true;
}

} 
return $msg;
}
   
}
