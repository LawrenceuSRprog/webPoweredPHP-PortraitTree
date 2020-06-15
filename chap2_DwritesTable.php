<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>[D] Writes Table using FlowBrick 4 BrickoLine</title>
	</head>
	<body>
		<h1>[D] Runs FlowBrick to Write Table</h1>
		<h2>. . .  The class is for BrickoLine.<br>
		    . . .  It uses FindBrick.</h2>
	
	<?php
		include 'autoload.php';

		function reportEachLine($singleLine){
			$prefix = "<br> . . . . . . . . . . . . . . ==> ";
			$out = $prefix . "< ". $singleLine[0] . ' > . . . . ';
			$out = $out . ' written to . [';
			$out = $out . $singleLine[1]. $singleLine[2] . '] ';
		    echo $out;

		    echo " . . .from . . . " . $singleLine[3];
		} # End func

		$brickParam["ShowTrace"]=false;
		$brickParam["LocalData"]=true;
		$givenTable=[];

		$count =0;
		$alpha = new FlowBrick($brickParam,$givenTable);
		if ($alpha->levelsRemain() == false) {
			echo "Its NO GOOD there isnt any data to start with";
		} # End if LINES REMAIN at start

		$result = $alpha->completedList(); 

		echo '<br>..The Completed List has ' . sizeof($result) . ' tuples.';
		foreach ($result as $key => $singleLine) {
			reportEachLine($singleLine);
		} # End Loop
		
		echo '<br><br>Ok up to here';
		echo '<br>Production continues in this FLOW SERIES';
		echo '<br>This code works for afOneTopAnimalData';
		echo '<br>BUT 4 afWholeBodyData - IT starts WITHOUT its own TOP ';
		echo '<br>Refer to <strong>Documents > Refactoring-TheFLOW</strong> to see whats NEXT';
	?>
	</body>
</html>

	
