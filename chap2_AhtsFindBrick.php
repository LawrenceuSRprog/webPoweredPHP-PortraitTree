<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>[A] hts Toolbox 4 BrickoLine</title>
	</head>
	<body>
		<h1>[A] Hold Test & Show BrickFind</h1>
		<h2>. . .  A private class for the BrickoLine</h2>
	
		
	<?php
		include 'autoload.php';
		$alpha = new BrickTester();
		$alpha->demoNudgingIn();

		echo "<br><br>  ##   ##  ##   ##   ##  ##   ##   ##  ##  ##   ## <br>";
		echo "<br>In this table:"; 
		echo "<br>The leading column is the category of the row";
		echo "<br>. . . . PANT-> has children . .LEAF-> Dosen't";
		echo " . .LOST-> Item is NOT a member";
		echo "<br><br>  ##   ##  ##   ##   ##  ##   ##   ##  ##  ##   ## <br><br>";
		
		$alpha->demoChekingOut();
		echo "<br><br>Ok up to here";

		echo "<br>{class FindBrick} is a private resource within the project";
	?>
	</body>
</html>

	
