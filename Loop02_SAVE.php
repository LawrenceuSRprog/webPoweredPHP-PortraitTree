<?php
	function getCurrVector($index, $Line){
		$eachField = explode(":", $Line);
		$stopat = 'T';
		$pos = strpos($eachField[1], $stopat);
		$num =  substr($eachField[1],0,$pos);
		$eachField[1] = (int)$num;
		#
		$eachField[2] = $eachField[2] . 'T';
		$stopat = 'T';
		$pos = strpos($eachField[2], $stopat);
		$num =  substr($eachField[2],0,$pos);
		$eachField[2] = (int)$num;
		#
		$eachField[0] = $index;
		return $eachField;
	}

	function makeCommand($vect) {
		$ret = 'INSERT INTO move_horizon';
		$ret = $ret .'(row_stays,col_gradient,col_add) ';
		$ret = $ret .'VALUES( ';

		$ret = $ret . $vect[0]. ', ';
		$ret = $ret . $vect[1]. ', ';
		$ret = $ret . $vect[2]. '); ';

		return $ret;
	}

	function mainLoop(){
	    echo 'Prepare DB access - Delete contents, THEN .... <br><br>';
		$ContentOf_UL = $_POST["UpperList"];
		$eachLine = explode("Multi", $ContentOf_UL);
		$lastLine = count($eachLine);
		
		for ($i = 1; $i <$lastLine; $i++) { 
			$vect = getCurrVector($i,$eachLine[$i]);
			$writer = ' . . . . ' . makeCommand($vect);
			echo $writer. '<br>';
		}
	} 
	
	mainLoop();
?>

