		<?php
			include 'autoload.php';
			# Study  38 -- 62, *155 and 274 # connected with FINAL element -1000, is col holder
				
		class LinoBrick {  
			private $apexLinesCurrent; # REQUIRED to juggle 2 apex popsitions
			private $apexLast;  # returns MAX index of $apexGroup 
			private $got_LevelList; # How many times was g_LLL actually called

			private $objFindBrick;
			private $isShowingTrace; # Value passed in to ENABLE debugging
			private $useInternalTestData;# True -> DOSNT need ext. data
			private $EndOfDisplay; # Put back as CONST
			private $workBench; # Property that generates each Level Rectangle

			private $levelsRemain; # BOOLEAN Property: false -> groups of lines 
			                                             #      ended or invalid
			
			
			private $apexGroup; # receives ALL lines from the apex BEFORE 
								# nextLevel() can be used

			public function	get_LevelLineList(){
				$showTrace = $this->isShowingTrace;
				if ($this->got_LevelList <0 ){
					$this->got_LevelList = 1;
				} else { 
					$this->got_LevelList+=1;
				} # End if

				if ($this->apexLinesCurrent <= $this->apexLast) {
					$levelLineList = $this->apexGroup[$this->apexLinesCurrent];
					$levelLineList = $this->apexRelevelled($levelLineList);
					if ($showTrace==true) {
						#echo '<br>DEBUG LINECOUNT AC- ' . $this->apexLinesCurrent;
						echo '<br>DEBUG LINECOUNT AC- ' . $this->got_LevelList;
					} # End if
					$this->apexLinesCurrent =$this->apexLinesCurrent+1;


				} else {
					$levelLineList = $this->nextLevel();
					if ($showTrace==true) {
						echo '<br>DEBUG LINECOUNT TL- ' . $this->got_LevelList;
					} # End if
				}; # End if Still using apexLines

				return $levelLineList;
			} # End Method

			public function levelsRemain() {
				return $this->levelsRemain;
			} # End Method
			
			private function apexRelevelled ($levelLineToFix){
				$levelLineList = []; # Empty
				foreach ($levelLineToFix as $key => $element) {
					$element[2] = $this->got_LevelList;
					array_push($levelLineList, $element);
				}
				return $levelLineList;
			} # End Func

			private function prepareApexAssemble() {  
				$apexGroup=[];
				$apexExtra = $this->prepareApexContinue();
				$this->apexLast=0;

				if (sizeof($apexExtra)==1) {
					$apexGroup[0] = $apexExtra;
				} else {
					$this->apexLast=1;
					$theCork = array('WHOLE-THING','A',0,'ITSELF'); 
					$apexGroup[0] =array($theCork);
					$apexGroup[1]= $apexExtra; # SOMEHOW OVERWRITE with 1 instead of Zero
				} # End if
				$this->apexLinesCurrent = 0;
				return $apexGroup;
			} # End Method

			private function nextLevel(){
				$showTrace = $this->isShowingTrace;
				$trackFullWidth = $this->levelPresent();
				$replaceParent = $this->levelRollover(); 
				if ($showTrace == true) {
					$this->spyOnBench();
				} # End if
				$rectangle = $this->bringRectangle($replaceParent);
				$this->workBench = $rectangle;
				$temp=true;
				if (sizeof($trackFullWidth)==0) $temp=false;	
				$tempDBG = "FALSE";
				if($temp==true) $tempDBG = "TRUE";

				# echo "DEBUG ... End of nextLevel levelsRemain should be:".$tempDBG;
				$this->levelsRemain = $temp;
				return $trackFullWidth;
			} # End Method

			private function spyOnBench(){
	            $rectangle = $this->workBench;
	            if (sizeof($rectangle) > 0) {
					echo '<br> This is the contents of workBench <br> <br>';
				} # End if

	            foreach ($rectangle as $key => $chain) {
		            $line = "==> ";
		            foreach ($chain as $linKey => $link) {
		               $line = $line . $link . "|";
		            }
	            echo $line . '<br>'; 
	            } // End of chain
	        } # End Method

    		private function firstLevels() {
				# Soon to be replaced by firstReserves
				$apexGroup=[];
				$apexExtra = $this->prepareApexContinue();

				if (sizeof($apexExtra)==1) {
					$apexGroup[0] = $apexExtra;
				} else {
					$theCork = array("A","WHOLE-THING","ITSELF");
					$apexGroup[0] =array($theCork);
					$apexGroup[1]= $apexExtra;
				} # End if
				
				return $apexGroup;
			} # End Method

			function __construct($brickParam,$tableFeed=[]) {
				
				$this->got_LevelList =-1000;
				$this->isShowingTrace=$brickParam["ShowTrace"];
				$this->useInternalTestData=$brickParam["LocalData"];
				$feed = $this->feedingTheCons($tableFeed);
				$this->TotalLinesOut = 0 ; # No Lines have gone out yet
				$fink = new FindBrick($feed,False);
				$this->EndOfDisplay = '}'; 	
				$this->objFindBrick = $fink;
				$this->apexGroup = $this->prepareApexAssemble();
				# echo 'DEBUG LINE 240 Populated by this-apexGroup';

				$parent = $this->bringOrphans();
				$rectangle = $this->bringRectangle($parent);
				$this->workBench = $rectangle;	
			} # End Construct

			private function prepareApexContinue() {
				$fink = $this->objFindBrick;
	            $parentData = $fink->get_Orphans();
	            $pos = 64 ; # One before capital ** A **
	            
	            $trackElement = [];
	            $apexExtra = [];

	            foreach ($parentData as $key => $content) {
	                $pos = $pos +1;
	                # Consider using fink function called "isOrphan" ?
	                $owner = $fink->get_ParentOf($content);
	                if (strlen($owner)==0){
	                	$owner="WHOLE-THING";
	                }
	                
                    $addr= strval(chr($pos));
                    $tramLineEdge = array($content,$owner);
                    #  SIMPLIFY
                    $letter = chr($pos);
                    $trackElement = array( $tramLineEdge[0],
                    					$letter,
                    					$this->got_LevelList,
										$tramLineEdge[1], );

                    array_push($apexExtra,$trackElement);

	            }// End for

	            return $apexExtra;
			} # End Func

		    private function bringOrphans() {
		        $fink = $this->objFindBrick;
	            return $fink->get_Orphans();
		    } # End Func

		    private function bringRectangle($parentData){
	            $EOD = $this->EndOfDisplay;
	            $lino_six = array(0,0,'LH-DATA',0,'RH-DATA',$EOD); # EOD means End of Data
	            $fink = $this->objFindBrick;
	            $rows_used = -1;
	            $outPlate = [];
	            
	            # $parentData = $fink->get_Orphans();
	      		
	            foreach ($parentData as $key => $lhValue) {
	                $rhList = $fink->spreadFromParent($lhValue);
	                foreach ($rhList as $key => $rhValue) {
	                    $out = $lino_six;
	                    $out[2] = $lhValue;
	                    $out[4] = $rhValue;

	                    $rows_used = $rows_used +1;
	                    $outPlate[$rows_used] = $out;
	                }// End For
	            }// End For 

	            return $outPlate;
          	} // End Func
			
			private function indexedLevel(){
                $EOK = $this->EndOfKey; # LAST TIME current tnRight appears

                $tramLine =[];
                $rectangle = $this->workBench; 
                $chain = $rectangle[0];
                $marker =  "*E*L*S*E*W*H*E*R*E";

                foreach ($rectangle as $key => $chain) {
                    $tnLeft =  $chain[4];
                    $tnRight =  $chain[2]; 
                    $tramLineEdge = array($tnLeft,$tnRight); # SIMPLIFY

                    if ($marker <> $tramLineEdge[1]){
                          array_push($tramLine,$EOK);
                          $marker =  $tramLineEdge[1];
                    };// end if

                    array_push($tramLine,$tramLineEdge);

                };// End for

                array_shift($tramLine); # removes the only leading DELIMITER
                return $tramLine;
        	} // End func

	        private function feedingTheCons($tableFeed){
	        	$this->levelsRemain=true;
				$showTrace = $this->isShowingTrace;
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

        private function levelPresent() {
	            $EOK = $this->EndOfKey;

	            $pushedLevel =$this->indexedLevel();
	            $trackFullWidth = [];
	            $pos = 64 ; # One before capital ** A **
	            $trackElement = [];

	            foreach ($pushedLevel as $key => $tramLineEdge) {
	                $pos = $pos +1;
	                $letter = strval(chr($pos));
	                if ($tramLineEdge<>$EOK) {
						$trackElement = array( $tramLineEdge[0],
											$letter,
											$this->got_LevelList,
											# WAS TotalLinesOut towards LEVEL NUMBER?
											$tramLineEdge[1], );

	                    array_push($trackFullWidth, $trackElement);
	                } // End if
	            }// End for

            	return $trackFullWidth;
          	} // End Func

          	private function levelRollover() {
          		$replaceParent=[];

          		$fink = $this->objFindBrick;
          		echo "<br>";
				$rectangle = $this->workBench;
	            foreach ($rectangle as $key => $chain) {
		        	$rolled = strval($chain[4]);
		        	if ($fink->hasChild($rolled)==true) {
						# echo "Next Left will contain: - " . $rolled . "<br>"; 
						array_push($replaceParent, $rolled);
		        	} # End if
	            } // End Loop

	            return $replaceParent;
	        } # End Func

			private function accepted_feed() {
				#return $this->afNothingThere();
				#return $this->afTinyForestData();
				return $this->afWholeBodyData();
				#return $this->afLetterData();
				#return $this->afOneTopAnimalData();
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
