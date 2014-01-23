<?php
	header('Content-Type: text/html; charset=ISO-8859-1');

	include_once("classes/BddPDO.php");
					
	$bdd = new BddPDO("localhost", 3336, "epinoel", "epinoel", "Cx6~gX}(vW67");
		
	$search = $_GET['rs'];
	if (!empty($search)) {
		$file = file('logins.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		if (!in_array($search, $file)) {
			$json = array('msg' => 'UNKNOWN', 'err' => $search, 'login' => $search);
		} else {
			$i = rand(1,50);
			if ($i == 42)
			{
				$bdd->updateWinner($search);
				$json = array('msg' => 'GAGNE', 'login' => $search, 'nombre' => $i);
			} else {
				$json = array('msg' => 'PERDU', 'login' => $search, 'nombre' => $i);
			}
		}
		echo json_encode($json);
	}
?>