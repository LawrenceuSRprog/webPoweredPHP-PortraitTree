<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>[C] Writes Table using LinoBrick 4 BrickoLine</title>
	</head>
	<body>
		<h1>[C] Runs LinoBrick to DEMO a std near DB work</h1>
		<h2>. . .  The class is for BrickoLine.<br>
		    . . .  It uses FindBrick.</h2>
	
	<?php
		include 'autoload.php';

		function reportedLine($singleLine){
			$prefix = "<br> . . . . . . . . . . . . . . ==> ";
			$out = $prefix . "< ". $singleLine[0] . ' > . . . . ';
			$out = $out . ' written to . [';
			$out = $out . $singleLine[1]. $singleLine[2] . '] ';
		    echo $out;

		    echo " . . .from . . . " . $singleLine[3];
		} # End func

		function reportedLinesInLevel($linesWithinLevel){
			foreach ($linesWithinLevel as $key => $line) {
				reportedLine($line);
			} // End Loop
		} # End func

		$brickParam["ShowTrace"]=false;
		$brickParam["LocalData"]=true;
		$givenTable=[];

		$count =0;
		$alpha = new LinoBrick($brickParam,$givenTable);
		if ($alpha->levelsRemain() == false) {
			echo "Its NO GOOD there isnt any data to start with";
		} # End if LINES REMAIN at start

		while($alpha->levelsRemain()==true) {
    		$level = $alpha->get_LevelLineList(); 
    		reportedLinesInLevel($level);
		} # End Loop

		echo '<br><br>Ok up to here';
		echo '<br>This is ONLY a STANDARD it is NOT to be editted !';
	?>
	</body>
</html>

	
