		<?php
			include 'autoload.php';
			/*
				Overhaul peachRoad as replacement for Lino-6
				It is a mneumonic for ParentChildRowColumn
 			*/
			
		class FlowBrick {  
			private $waitingList; # Collects for the output DataBase table 
 
			private $allTypeNumbered; # How many times was an output LEVEL used

			private $objFindBrick;
			private $isShowingTrace; # Value passed in to ENABLE debugging
			private $useInternalTestData;# True -> DOSNT need ext. data
			private $workRectangle; # Property that generates each Level Rectangle

			private $levelsRemain; # BOOLEAN Property: false -> groups of lines 
			                                             #      ended or invalid
			
			private $apexGroup; # receives ALL lines from the apex BEFORE 
								# nextRegularLevel() can be used

			public function	completedList() {
				
				$childTop = $this->apexGroup[0];
				$this->appendToWaitingList('apex',$childTop);

				if (sizeof($this->apexGroup)==2) {
					$children = $this->apexGroup[1];
					$this->appendToWaitingList('apex',$children);
				} # End If INTERMEDIATE LINE Required

				while($this->levelsRemain()==true) {
					$this->alterNumberUpdate();
					$children = $this->dataToSend(); 
					$this->appendToWaitingList('regular',$children);
					$this->RebuildUsingParents();
				} # End Loop

				return $this->waitingList;
			} # End Method

			public function levelsRemain() {
				return $this->levelsRemain;
			} # End Method


			function __construct($brickParam,$tableFeed=[]) {
				$this->waitingList=[]; # Ready to start work
				$this->allTypeNumbered =-1000;
				$this->isShowingTrace=$brickParam["ShowTrace"];
				$this->useInternalTestData=$brickParam["LocalData"];
				$feed = $this->feedingTheCons($tableFeed);
				$this->TotalLinesOut = 0 ; # No Lines have gone out yet
				$fink = new FindBrick($feed,False);
				$parent = $fink->get_Orphans();
				$this->objFindBrick = $fink;
				
				$this->apexGroup = $this->apexBringAll();

				$this->workRectangle  = $this->rectangleFromParent($parent);
			} # End Construct

			private function alterNumberUpdate(){
				if ($this->allTypeNumbered <0 ){
					$this->allTypeNumbered = 1;
				} else { 
					$this->allTypeNumbered+=1;
				} # End if
			} # End Func

			private function appendToWaitingList($label,$linesWithinLevel){
				$this->waitingListTitleTrace($label); # when demanded
				foreach ($linesWithinLevel as $key => $singleLine) {
					array_push($this->waitingList, $singleLine);
					$this->appendActionTrace($singleLine); # when demanded
				} # End looping the WHOLE LEVEL
			} # End func

			private function waitingListTitleTrace($onwards){
				if ($this->isShowingTrace==true) {
					if ($onwards == 'apex') {
						$desc = 'Single Row';
						if($this->allTypeNumbered>1) {
							$desc = 'Double Rows';
						}
						echo '<br>DBG apex is - ' . $desc;
					} else {
						echo '<br>DBG L.C regular - ' . $this->allTypeNumbered;
					} # End if onwards via apex
				} # End if Trace
				
			} # End Func

			private function appendActionTrace($singleLine){
				if($this->isShowingTrace==true){
					$prefix = "<br> . . .APPENDING . VALUES . . . . . . ==> ";
					$out = $prefix . "< ". $singleLine[0] . ' > . . . . ';
					$out = $out . ' written to . [';
					$out = $out . $singleLine[1]. $singleLine[2] . '] ';
					$out = $out . '. .from . . . ' . $singleLine[3];
		    		echo $out;
		    	} # End if
			} # End func

			private function apexBringAll() {  
				$childTop=[];
				$fink = $this->objFindBrick;
	            $parentData = $fink->get_Orphans();
	            $theCork = array('WHOLE-THING','A',1,'ITSELF');

	            $apexGroup=[];
            	$childTop=$theCork;
				$this->alterNumberUpdate();

	            if (sizeof($parentData)==1) {
	            	$childTop[0]=$parentData[0];
	            	array_push($apexGroup,array($childTop)); # ONLY 1 Orphan
	            } else {
	            	array_push($apexGroup,array($childTop)); # ONLY 1 Pseudo-Orphan
	            	# $children = $this->apexContinued($parentData);
	            	$this->alterNumberUpdate();
		        	array_push($apexGroup,$this->apexContinued($parentData));
		        	# The 2nd Member holds all the Other Orphans
	            } # end if

				return $apexGroup;
			} # End Function

			private function apexContinued($parentData) {
	            $retAdoptedByWhole = [];
	            $pos = 64; # ONE BELOW 'A'
	            	
	            foreach ($parentData as $key => $content) {
	            	$pos = $pos +1;
		            
		            $element = array( $content,
                    					chr($pos),
                    					2,
										'WHOLE-THING', );

		            array_push($retAdoptedByWhole, $element);
	            } # End Loop

	            return $retAdoptedByWhole;	
			} # End Func

			private function dataCompletion(){
                $rectangle = $this->workRectangle; 
                $chain = $rectangle[0];
                $putemBack=[]; # Empty
                $marker =  "*E*L*S*E*W*H*E*R*E";
                $pos = 63; # TWO BELOW 'A'

                $suffix = $this->allTypeNumbered;

                foreach ($rectangle as $key => $chain) {
					$chain[5]=$suffix;
                    $tnLeft =  $chain[4];
                    $tnRight =  $chain[2]; 

                    if ($marker <> $tnRight){
                   		$pos += 2; # skip b4 incrementing
                       	$marker =  $tnRight;
                    } else {
                    	$pos +=1; # increment the letter
                    } # end if
					$chain[3] =	chr($pos);
					
					array_push($putemBack, $chain);

                }; # End CALC loop

                $this->workRectangle=[]; # Empty
                foreach ($putemBack as $key => $chain) {
					array_push($this->workRectangle, $chain);
					$this->navelAttRCoTrace($chain); # When demanded
				} # End Writing loop

        } // End func

		private function navelAttRCoTrace($chain){
			if ($this->isShowingTrace == true){
				$prefix = "<br>DBG workRectangle --->";
				$out = $chain[2] . ' | ' . strval($chain[3]);
				$out = $out .  ' | ' .  $chain[4];
				$out = $out .  ' | ' .  $chain[5];
				echo $prefix . $out;
			} # End if Debugging
        } // End func


		private function dataToSend(){
			$this->dataCompletion();
			$dataList = [];
			$rectangle = $this->workRectangle;
			foreach ($rectangle as $key => $cameFrom) {
				$colFix=array($cameFrom[4],   /* DBKey =childName  */
								$cameFrom[3], /* ltr = col in LNUM  */
								$cameFrom[5], /* LEVEL NUMBER */
								$cameFrom[2], /* Parent of DB-Key */
							);
				array_push($dataList, $colFix);
			} # End Loop
		   	return $dataList;

		} // End Func

		private function RebuildUsingParents(){
			$replaceParent = $this->discoverFutureParents(); 
			$this->workRectangle = $this->rectangleFromParent($replaceParent);
			$this->levelsRemain = (sizeof($this->workRectangle)>0);
		} # End Func


		private function rectangleFromParent($parentData){
	        $lino_six = array(0,0,'LH-DATA',0,'RH-DATA','--FLAGS--'); 
	        $fink = $this->objFindBrick;
	        $rows_used = -1;
	        $outPlate = [];
	           
	        # $parentData = $fink->get_Orphans();
	      		
	       foreach ($parentData as $key => $parentItem) {
	            $rhList = $fink->spreadFromParent($parentItem);
	            foreach ($rhList as $key => $childItem) {
	                $out = $lino_six;
	                $out[2] = $parentItem;
	                $out[4] = $childItem;

	                $rows_used = $rows_used +1;
	                $outPlate[$rows_used] = $out;
	                }// End For
	            }// End For 

	        return $outPlate;
        } // End Func
	    
        private function discoverFutureParents() {
        	/* Delivers list of all current children who 
        	   will LATER REPLACE the parents of the current
        	   generation
        	*/
          		$replaceParent=[];

          		$fink = $this->objFindBrick;

				$rectangle = $this->workRectangle;
	            foreach ($rectangle as $key => $chain) {
		        	$rolled = strval($chain[4]);
		        	if ($fink->hasChild($rolled)==true) {
						array_push($replaceParent, $rolled);
		        	} # End if
	            } // End Loop

	            return $replaceParent;
	        } # End Func

	        private function feedingTheCons($tableFeed){
	        	$this->levelsRemain=true;
				$localData = $this->useInternalTestData;

				if ($localData==true) {
					$feed=$this->accepted_feed();
				} else {
					$feed=$this->$tableFeed;
				} # End if LOCAL DATA 

				if (sizeof($feed)<2) {
					$this->levelsRemain=false;
				} # End if 

				return $feed;

	        } # End Func

			private function accepted_feed() {
				#return $this->afNothingThere();
				#return $this->afTinyForestData();
				#return $this->afWholeBodyData();
				#return $this->afLetterData();
				return $this->afOneTopAnimalData();
			} # End func
			
			private function afNothingThere() {
				return [
						array('Data','Missing')];
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

			private function afTinyForestData() {
				return [
						array('The Trees','Timber'),
						array('The Trees','Fruit'),
						array('The Trees','Artwork'),];
		    } // End Func

   			private function afOneTopAnimalData() {
				return [
						array('Animal','Mammal'),
						array('Animal','Reptile'),
						array('Mammal','Big Furry'),
						array('Big Furry','Ape'),
						array('Bear','Bear'),
						array('Big Furry','Polar B'),
						array('Big Furry','Brown B'),
						array('Big Furry','Tiger'),
						array('Mammal','Small Furry'),
						array('Small Furry','Rabbit'),
						array('Small Furry','Mouse'),
						array('Mammal','Non Furry'),
						array('Animal','Bird',),
						array('Bird','Eagle',),
						array('Bird','Raven',),
						array('Bird','Duck',),
						array('Bird','Swan'),];

		    } // End Func

	} # End class
			
	?>
