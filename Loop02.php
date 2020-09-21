<!DOCTYPE html>
<html>

<head>
	 <title id=67>Look at IDEA 4 WHO sent YOU and Discoveries.txt</title>
	 <!-- Fill in the checklist at the TOP of THAT PHP file -->
	 <script>
	 		function saveLineParams(e){
	 			alert("Saving the Line");
	 			var ret = [-1000,-1000,-1000];

	 			ret[0] = document.getElementById('fieldLeft').value;
	 			ret[1] = document.getElementById('fieldDouble').value;
	 			ret[2] = document.getElementById('fieldRight').value;

	 			
	 			var retFocus = ['b','b',',',',',','];

	 			var sa = 'dataRow0';
	 			var storedAddress = sa.concat(ret[0]);

	 			retFocus[0] = '<li id="';
	 			retFocus[1]= storedAddress;
	 			retFocus[2]='"> [ ';
	 			retFocus[3]= ret[0];
	 			retFocus[4]=' ] ===> Multiply by: ';

	 			var str = retFocus.join('');
	 			var res = str.replace(",", " ");
  				ret[0] = res;

	 			retFocus = ['b','b',',',',',','];
	 			retFocus[0] = ret[1];
	 			retFocus[1]=' ';
	 			retFocus[2]='Then add: ';
	 			retFocus[3]=ret[2];

				str = retFocus.join('');
	 			var res = str.replace(",", " ");
  				ret[1] = res;
  				ret[2] = ret[0].concat(ret[1]);

  				alert(ret[2]);
  				var innerContent = ret[2];

  				var retFocus = ['b','b',',',',',','];
	 			ret[0]= innerContent;

  				alert(ret[0]);
  				return([storedAddress,innerContent]);
  			}	

  			function saveLineDetail(e){
	 			var res = saveLineParams(e);
	 			var objSendTo = document.getElementById(res[0]);
	 			objSendTo.outerHTML=res[1];
  			}
			
	 		function saveLine(e){
	 			saveLineDetail(e);
	 			saveLineWholeForm();
  			}

	 		function saveLineWholeForm(e){
	 			locateWholeList = 'subform-00';
	 			srcX = document.getElementById(locateWholeList).innerHTML;
	 			sendTo = document.getElementById('UpperList');
	 			sendTo.value= srcX
	 		}

	        function cutOutPair(pstr){
                var str = pstr.replace("<br>", "|");
                var tabley = str.split(":");
                	
                var strLeft = tabley[1];
                var stopAt =strLeft.indexOf('Then');
                var r0 =Number(strLeft.substr(0,stopAt));
                
                strRight = tabley[2];
                stopAt=strRight.indexOf('|');/* END of LINE */
                var r1=Number(strRight.substr(0,stopAt));
               
               return [r0,r1];
            }
            function userDelivers(rowNum){
                var p = "dataRow0";
                var strLocationOf_thePair = p.concat(rowNum);

                strPair = document.getElementById(strLocationOf_thePair).innerHTML; 
                return cutOutPair(strPair);
            }
            function rowToFields(rowNum){
                var receive = document.getElementById('fieldLeft');
                receive.setAttribute("value", rowNum);
                
                var ud = userDelivers(rowNum);
                
                receive = document.getElementById('fieldDouble');
                receive.setAttribute("value", ud[0]);
                
                receive = document.getElementById('fieldRight');
                receive.setAttribute("value", ud[1]);
            }
		    function pushed(eSource){
                rowToFields(eSource.innerHTML);
        }
        </script>
	<style>
	    <body {
	        padding: 0px;
	        margin: 0px;
	        border: 0px;
	    }
	        .updown_banner {
            height: 50px;
            background-color: #9f4444;
            color:#efefef;
        }

        #getFrom_here {
          width: 380px;
          height: 200px;

          background-position:0px 50px; 
          overflow: auto;
          background-color: #9f6633;
        }
		.flex-multiCol{
	 			display: flex;
	 			background-color: white;
	 			width: 320px;
	 		}

	  .itemCol1{
	 			margin: 2px;
	 			padding: 5px;
	 			font-size:15px;
	 			width: 60px;
	 			border-style: solid;
	 			background-color: white;
	 		}

	  .itemCol2{
	 			margin: 2px;
	 			padding: 5px;
	 			font-size:15px;
	 			width: 120px;
	 			border-style: solid;
	 			background-color: white;
	 			text-align: center;
	 		}

    </style>
</head>
<body>
	<h2>This is Loop 02</h2>
	<h3>It is for the function - adjust params for DEFAULT</h3>
	<div class = updown_banner>
	    <br>
	    These are the rows:
	</div>

	<div id = getFrom_here>
	<ul id='subform-00' 
	    list-style-type = None
		indexViaLid = None>
	<?php

		$servername = 'localhost';
		$username = 'trunk';
		$password = 'ha50%CENT';
		$db = 'dbs_Forest';

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}

		$fieldLeft = $_POST['fieldLeft'];
		if  (isset($_POST['submit']))  {
			$strSQL = 'UPDATE move_horizon SET ';
			$p = 'col_gradient= ' . $_POST['fieldDouble'].', ';
			$q = 'col_add= "' . $_POST['fieldRight'].'" ';
			$r = 'WHERE row_stays= "'. $fieldLeft . '"';
			$strSQL = $strSQL . $p . $q . $r;

			$p = 'DO the COMMAND:' . $strSQL;

			echo $p;
		 }

		$sql = "select row_stays,col_gradient,col_add from move_horizon;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
                
		        $r = $row["row_stays"];
		        $id = "<li id='" . dataRow0 . $r. "'>";
		        $g = ' Multiply by: '  . $row["col_gradient"];
		        $a = ' Then add: ' . $row["col_add"] . '<br>';

		        $buffer = $id . ' [ ' . $r . ' ] ===> '. $g . $a . '</li>';

				echo $buffer . '<br>';
		    }
		} else {
		    echo "0 results";
		}

		$conn->close();
	?>

		</ul>
	</div>
	    
	<div class = updown_banner>
	    Pick from:<br>

	    <button type=button onclick="pushed(this)">1</button> 
	    <button type=button onclick="pushed(this)">2</button> 
	    <button type=button onclick="pushed(this)">3</button> 
	    <button type=button onclick="pushed(this)">4</button> 
	    <button type=button onclick="pushed(this)">5</button> 
	    <button type=button onclick="deepEnd(this)">6</button> 
	</div>
	<br>
	<form action="Loop02_SAVE.php" method="POST">
			<label for='fieldLeft'>This Row:</label> 
			<input type="text" id='fieldLeft'
			     type="text" readonly>
      		<br>
	 		<label for="fieldDouble">Multiply it by:</label> 
      		<input name="fname" id="fieldDouble" type="text" />
      		<br>
      		<label for="fieldRight">Then add to it:</label> 
      		<input name="fname" id="fieldRight" type="text" />
      		<br>
	    	<br>
	    	Send these to the list above with . . . 
			<button type=button onclick="saveLine()">LINE</button> 

			<br><br>
			<div class = updown_banner>
			<span> . . . For the whole list:</span><br>
			<input type="button" 
  		 	onclick="location.replace(
  		 		'AAA_Cent_00.php')"
  		    value="QUIT">
  		    <span> to abort  . . . otherwise . </span>
			<input type="submit" value="SAVE">
			</div>
			<input name = "UpperList" id="UpperList" type="hidden" /> 
	</form> 
</hmtl>
