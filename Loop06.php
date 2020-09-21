<!DOCTYPE html>
<html>

<head>

</head>
<body>

<h2>This is Loop 06</h2>
<h3>It is the function of view publish DEFAULT . . onwards . . . </h3>
<form action="AAA_Cent_00.php">
	<?php
	        $nameWorker = "Hector";
		    $nameSkill = "Hat maker";
		    $greeting = "good day to You";

		    $blurb = $nameWorker . " the " . $nameSkill;
		    $blurb = $blurb . " says " . $greeting;
			
			echo ('<p>The Blurb > ' . $blurb . '<br></p>'); 
    ?>

  <input type="submit" value="Back to Central">
</form> 
</hmtl>
