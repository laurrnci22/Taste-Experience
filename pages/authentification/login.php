<?php
require_once "../../config.php";
session_start();

require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template;
use recette\Logger;

ob_start() ;

$instance = new Logger();

if(isset($_POST['username']) && isset($_POST['password']) ){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $tab = $instance->log($username,$password);

    if( $tab['granted'] == false){?>

        <?php $instance->generateLoginForm("",$tab['error']); ?>

    <?php }

    else{/*l utilisateur a trouvé le login*/

        if(isset($_POST['rester-connecter'])){
            $expire = time() + 365*24*3600 ; // durée d'un an
            setcookie('username', $username, $expire) ;
        }
        $_SESSION['username'] = $_POST['username'];//On veut afficher l username
        $tab['granted'] = false;?>
        <?php
      header("Location: ".$GLOBALS['DOCUMENT_DIR']."index.php");
       exit();
    }
}

else{/*ce n est pas bon donc on retourne vers la page*/
    ?>
   <?php $instance->generateLoginForm("",""); ?>

<?php
}


$content = ob_get_clean();
Template::render($content, $title = "Loging");
