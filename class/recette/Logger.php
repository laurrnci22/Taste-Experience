<?php
namespace recette ;

class Logger{

    public function generateLoginForm(string $action, $erreur): void{?>
        <script src = "<?= $GLOBALS['JS_DIR'] ?>login.js"></script>

        <form method="post" action="<?php $action ?>" id="login-form">

            <img class="login-picture" src="<?= $GLOBALS['IMG_DIR']?>src/login.jpg"  alt=""/>

            <div class="login-info">
                <span class = "login-info-title">Admin</span>
                <span id="erreur-log" class="error-message"> <?php echo $erreur?> </span>
                <input type="text" class = "login-input-form" id = "username" name="username" placeholder="login">
                <input type="password" class = "login-input-form" id = "password" name="password" placeholder="password">

                <div class="login-info-footer">
                    <div class="reste-conn">
                        <label>
                            <input name="rester-connecter" type="checkbox">
                        </label>
                        Rester connecté
                    </div>
                    <button type="submit" class="btn">LOGIN</button>
                </div>
            </div>

        </form>
        <?php
    }

    public function log(string $username, string $password) : array{

        $tab = array("granted" => false, "nick" => null, "error" => null) ;
        if( $username == "login" && $password == "recette"){
            $tab["granted"] = true;
        }

        else{
            $tab["error"] = " Authentication failed ";
            $tab["granted"] = false;

            if(empty($username)){
                $tab["error"] = " USERNAME IS EMPTY ";
            }
            else if(empty($password)){
                $tab["error"] = " PASSWORD IS EMPTY ";
            }
        }
        return $tab;
    }

}