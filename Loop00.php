<!DOCTYPE html>
<html>

<head>

</head>
<body>

<h2>This is Loop 00</h2>
<h3>It is for the function of RESET</h3>
  <form action="AAA_Cent_00.php">
		<input type="submit" value="Back to Central">
  </form> 

	<?php
	
	$servername = 'localhost';
	$username = 'trunk';
	$password = 'ha50%CENT';
	$db = 'dbs_Forest';

	$validConn = True; // assign the value TRUE to $foo
	$conn = new mysqli($servername,
			$username,
			$password,
			$db);

	if ($conn->connect_error) {
		$validConn = False;
		echo 'connection failed -' . $conn->connect_error;
	} 
	
	if ($validConn == True) {
		echo "CAN get into the database <p>";
		//run the stored proc
		
		$result = mysqli_query($conn, "CALL cntrRESTART;");
		$result = mysqli_query($conn, "select count(*) from carry_spread;");
		//loop the result set
		if ($row = mysqli_fetch_array($result)){     
  			echo $row[0] . " records to the carry TABLES" . "<p>"; 
		}
		
		echo "... BUT we DONT need it any more <p>";
		$mysqli -> close();
	} // End If
    
    ?>

</hmtl>
