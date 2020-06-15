		<?php
			include 'autoload.php';
			# This is a Test-Driver for BlockFind formerly:ToolBox
				
		class BrickTester {
			/*
			# ####  ####  ####  ####  ####  ####  ####  ######  ####  ####  ####  #### 
			#
			# This BlockFind Holder assumes the CLASS BlockFind exists 
			# see line 48                       ===============   
			#
			# ####  ####  ####  ####  ####  ####  ####  ###### ####  ####  ####  #### 
			*/
			private $objFindBrick;
			private $pickFromLeft;
			private $pickFromRight;

			public function demoNudgingIn(){
				$fink = $this->$objFindBrick;
				$apex = $fink->get_Orphans();

				echo "<br><br>This apex is based on the ORPHANS:<br>";
				foreach ($apex as $key => $apeMember) {
					echo(" APEX  " . $apeMember . "<br>");
					
					$memberList = $fink->spreadFromParent($apeMember);
					foreach ($memberList as $key => $member) {
						echo(" -- -- -- -- >  " . $member . "<br>");
					}
				}

			} # End Method

			public function demoChekingOut(){

				$this->reportTheTrio($this->pickFromLeft);

				$runner = array("Lion","Witch","Wardrobe");
				$this->reportTheTrio($runner);
				
				$this->reportTheTrio($this->pickFromRight);

			} # End Method


			function __construct() {
				$feed=$this->accepted_feed();
				$fink = new FindBrick($feed,true);
				$this->$objFindBrick = $fink;

				$this->populateBoth($feed);
				echo "<br><br>  ##   ##  ##   ##   ##  ##   ##   ##  ##  ##   ##   ##  ## <br><br>";
  				echo "  # ##  Code runs AFTER fink was CREATED  ## # <br><br>";
				echo "  ##   ##  ##   ##   ##  ##   ##   ##  ##  ##   ##   ##  ## <br><br>";
				
			} # End Construct of ToolBox Holder

			private function populateBoth($feed) {
				$this->pickFromLeft = [];
				$this->pickFromRight = [];
				foreach ($feed as $key => $twoPart) {
					array_push($this->pickFromRight, $twoPart[1]);
					$candidate = $twoPart[0];
					$found = in_array($candidate, $this->pickFromLeft);
					if ($found==false) {
						array_push($this->pickFromLeft, $candidate);				
					} # End If
				} # End Loop
			} # End func

			private function accepted_feed() {
				# return $this->afTinyForestData();
				return $this->afWholeBodyData();
				# return $this->afLetterData();
			} # End func

			private function afTinyForestData() {
				return [
						array('The Trees','Timber'),
						array('The Trees','Fruit'),
						array('The Trees','Artwork'),];
		    } // End Func

			private function afWholeBodyData() {
				return [
						array('UpBody','RightArm'),
						array('UpBody','LeftArm'),
						array('UpBody','Chest'),
						array('Head','Face'),
						array('Head','Ears'),
						array('Head','Rest of Head'),
						array('Face','Nose'),
						array('Face','Eyes'),
						array('Face','Mouth'),
						array('MidBody','Center'),
						array('LowBody','LeftLeg'),
						array('LowBody','RightLeg')];
		    } // End Func

			private function afLetterData() {
				return [
						array('a','ant'),
						array('a','adder'),
						array('b','brick'),
						array('b','banjo'),
						array('b','bank'),
						array('c','cello'),
						array('c','catcher'),
						array('c','candle'),
						array('c','coral'),
						array('c','cake'),
						array('ant','antler'),
						array('ant','ant thill'),
						array('adder','address'),
						array('adder','adding'),
						array('adder','addition')];
		    } // End Func



		    private function reportTheTrio($runner){
		    	$fink = $this->$objFindBrick;
		    	$spacer = " . . #### . . ||";

		    	foreach ($runner as $key => $ran) {
					echo  "<br>" . $fink->spyOnFLAG($ran) . $spacer . $ran;
				} # End For
				
		    } # End Func

		    private function trioCheckBox($a1,$a2,$a3){
		    	$b1 = "[.]";
		    	if ($a1) $b1="[#";
		    	$b2 = "[.]";
		    	if ($a2) $b2="[#";
		    	$b3 = "[.]";
		    	if ($a3) $b3="[#";

		    	return "<br> ". $b1 . $ $b2 . $b3;

		    }# End Func

	} # End class
	?>
