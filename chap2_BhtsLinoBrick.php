<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>[B] hts LinoBlock 4 BlockoLine</title>
	</head>
	<body>
		<h1>[B] Hold Test and Show demo of LinoBlock</h1>
		<h3>. . .  The TEMPORARY std class for BrickoLine which uses FindBrick</h3>
	
		
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


		$brickParam["ShowTrace"]=true;
		$brickParam["LocalData"]=true;
		$givenTable=[];

		$count =0;
		$alpha = new LinoBrick($brickParam,$givenTable);
		if ($alpha->levelsRemain() == false) {
			echo "Its NO GOOD there isnt any data to start with";
		} # End if LINES REMAIN at start

		while($alpha->levelsRemain()==true) {
    		reportedLinesInLevel($trackFullWidth);
    		# BAD IDEA $peggy = $alpha->get_LevelLineList(sdfdsf); 
    		$trackFullWidth = $alpha->get_LevelLineList(); # Try WITHOUT count
    		$count +=1;
		} # End Loop

		echo '<br><br>Ok up to here';
		echo '<br>This is ONLY a STANDARD it is NOT to be editted ! ';
	?>
	</body>
</html>

	
