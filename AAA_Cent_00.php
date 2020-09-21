<!DOCTYPE html>
 <html>
 <head>
	 <title>Sending to all php Satelites</title>
	 <meta charset="UTF-8"/>
	 <style>

	 	div.picLeft{
	 		height: 124px;
	 		width: 124px;
	 		margin:  3px;
	 		padding-top: 23px;
	 		padding-botton: 0px;
	 		border:  3px;
	 		border-style:none;
	 	}

	 	div.explainRight{
	 		padding-top: 0px;
	 		margin:  4px;
	 		padding-left: 60px;
	 		border:  4px;
	 		border-style:none;
	 	}

	 	ul.showNothing{
	 		list-style-type:none;
	 		padding-botton: 0px;
	 	}
	 	li.showBox{
	 	    background-color: #696969;
		    color: #90EE90;
		    padding: 0px 0px;
	 		width:200px;
	 		margin:4px;
	 		border: 5px solid black;
	 	}

		a:link, a:visited, a:hover, a:active {
		  background-color: #696969;;
		  color: #90EE90;
		  padding: 0px 0px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		}


	 </style>
 </head>
	 <body>
	 	<h1>This whole Form Starts HERE</h1>

		<!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="Reset Blurb" class="explainRight"> 
			Restart all versions of picture
		</div>
	 	
	 	<div id="Reset Pic" class="picLeft">
	 		<a href="Loop00.php">
         		<img src = "ICON-SUPPLY\ICO-restart.png" 
				height="81px" 
				width="81px">
			</img>
			</a>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="View DEFAULT Blurb" class="explainRight"> 
			Look at the default picture.
		</div>

        <div id="view DEFAULT Pic" class="picLeft">
        	<a href="Loop01.php">
			<img src = "ICON-SUPPLY\ICO-viewDEFAULT.png" 
				height="81px" 
				width="81px">
			</img>
			</a>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="Adjust DEFAULT Blurb" class="explainRight"> 
			Change params for the default picture.
		</div>

        <div id="Adjust DEFAULT Pic" class="picLeft">
			<a href="Loop02.php">
			<img src = "ICON-SUPPLY\ICO-adjustDEFAULT.png" 
				height="81px" 
				width="81px">
			</img>
		    </a>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="Process BOTH Blurb" class="explainRight"> 
			Update the picture(/s) using the params.
		</div>

        <div id="Process Pic" class="picLeft">
        	<a href="Loop03.php">
			<img src = "ICON-SUPPLY\ICO-processBOTH.png" 
				height="81px" 
				width="81px">
			</img>
		    </a>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="PostChoice Blurb" class="explainRight"> 
			Decide which version of the pictures to keep.
		</div>

		<div id="Choice Box" class="picLeft">
			<ul class="showNothing">
				<li class="showBox">
					<a href="Loop4a.php">PREFER default</a>
				</li>
				<li class="showBox">
					<a href="Loop4b.php">PREFER latest</a>
				</li>
			</ul>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="View LATEST Blurb" class="explainRight"> 
			Look at the latest picture.
		</div>

        <div id="view LATEST Pic" class="picLeft">
			<a href="Loop05.php">
			<img src = "ICON-SUPPLY\ICO-viewLATEST.png" 
				height="81px" 
				width="81px">
			</img>
			</a>
	 	</div>
		
        <!-- ==== ==== ==== ==== ==== ==== ==== ==== -->
		<div id="View LATEST Blurb" class="explainRight"> 
			Publish the default picture.
		</div>


        <div id="view LATEST Pic" class="picLeft">
			<a href="Loop06.php">
			<img src = "ICON-SUPPLY\ICO-publish.png" 
				height="81px" 
				width="81px">
			</img>
			</a>
	 	</div>
		
</body>
</html>
