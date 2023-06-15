<?php
require_once "../config.php" ;
session_start();
if(!isset($_SESSION['username'])){
    header("Location:".$GLOBALS['DOCUMENT_DIR']."index.php");
    exit();
}
require $GLOBALS['PHP_DIR']."class/Autoloader.php";
Autoloader::register();
use recette\Template;
use recette\Affichages;


ob_start() ;


$_SESSION['validation'] = true;

header("Location:".$GLOBALS['AJOUT']."ajout.php");
exit();

?>

    <div class="dashbord">
        dashbord
    </div>

    <a href="<?php echo $GLOBALS['AJOUT'] ?>ajout.php" style="font-size: 0.5cm;text-decoration: none">Ajout</a>
    <a href="<?php echo $GLOBALS['SUPPRESSION'] ?>retirerRecette.php" style="font-size: 0.5cm;text-decoration: none">Retirer</a>

<?php
$content = ob_get_clean();
Template::render($content, $title = "Admin Space");
