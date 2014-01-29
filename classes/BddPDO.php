<?php

/**
 * Description of Bdd
 *
 * @author stef
 */

class BddPDO {
    public function __construct($host, $port, $bdd, $user, $pass){
        $PDO = $this->connect($host, $port, $bdd, $user, $pass);
    }

    private function connect($host, $port, $bdd, $user, $pass){
		try {
			$PDO = new PDO('mysql:host='.$host.';port='.$port.';dbname='.$bdd, $user, $pass);
		} catch(Exception $e) {
			echo 'PDO Erreur : '.$e->getMessage().'<br />';
			echo 'N°: '.$e->getCode();
		}
		return $PDO;
    }
    
	public static function checkWinner(){
		$res = $PDO->prepare("SELECT winner FROM days WHERE date=CURDATE()");
		$res->execute();
		if ($res->rowCount() == 1)
		{
			$res->setFetchMode(PDO::FETCH_OBJ);
			$line = $res->fetch();
			return ($line->winner);
		}
		return "error";	
	}
	
	public static function updateWinner($search){
		$res = $PDO->prepare("UPDATE days SET winner=? WHERE date=CURDATE()");
		$success = $res->execute(array($search));
	}
}
?>
