<?php
namespace pdo ;

use \PDO ;

class PdoConnexion
{
    private $pdo ;

    public function __construct(){
        /*lancement : mysql -h 192.168.22.48 -u john -p
        machine perso :  */
        $db_name = "recettecuisine" ;
        $db_host = '127.0.0.1' ;
        $db_port = '3306' ;
        $db_user =  'root' ;
        $db_pwd = '' ;
        /*
                machine fac :
                $db_name = "agaye" ;
                $db_host = '192.168.22.48' ;
                $db_port = '3306' ;
                $db_user =  'agaye' ;
                $db_pwd = '06032003' ;

                $db_name = "agaye" ;
                $db_host = '192.168.22.48' ;
                $db_port = '3306' ;
                $db_user =  'agaye' ;
                $db_pwd = '06032003' ;
        */
        $dsn = 'mysql:dbname=' . $db_name . ';host='. $db_host. ';port=' . $db_port;
        try{
            $this->pdo = new PDO($dsn, $db_user, $db_pwd);
        }catch (\Exception $ex){
            die('Error : ' . $ex->getMessage()) ;
        }
    }
     public function getPdo(){
        return $this->pdo;
     }


}
