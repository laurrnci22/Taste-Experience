<?php
namespace recette;

class Template{
    public static function render($code, $title) : void{ ?>

        <!doctype html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport"
                          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title><?= $title?></title>
                <link rel="shortcut icon" href="<?= $GLOBALS['IMG_DIR']?>src/tte.png">

                <script src="<?= $GLOBALS['JS_DIR']?>main.js" ></script>
                <script src = "<?= $GLOBALS['JS_DIR'] ?>supprimer_recette.js"></script>
                <link rel="stylesheet" href="<?php echo $GLOBALS['CSS_DIR'] ?>main.css">
            </head>

            <body>
                <?php include $GLOBALS['PHP_DIR']."pages/header.php" ; ?>

                <?php if(!isset($_SESSION['rechercheRecette'])){?>
                    <div id="main-content">
                        <?php echo $code ?> <!-- #main-content -->
                    </div>
                <?php }

                else{ ?>

                <?php } ?>
                <?php include $GLOBALS['PHP_DIR']."pages/footer.php" ?>
            </body>
        </html>

    <?php
    }

}