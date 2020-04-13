	<?php	# the new class name is BlockFind - formerly it was: ToolBox
	class FindBrick {
				private $parent_finder; # dictionary finds parent from child
				private $isShowingTrace; # TRUE means echos are shown

				# = These are LOCAL constants =
				const FLAG_PANT = 1; # Is a PARENT becuase it has at least one child
				const FLAG_LEAF = 2; # Is a LEAF becuase it is a child and NEVER a parent
				const FLAG_LOST = 99; # Is a LOST becuase it is NEITHER a parent NOR child

				public function	spyOnFLAG($candidate){
					$ret = "dataOK"; # in case it GETS IGNORED

					if ($this->hasChild($candidate)) {
						$ret = "PANT";
					}

					if ($this->isLeaf($candidate)) {
						$ret = 'LEAF';
					}

					if ($this->notFound($candidate)) {
						$ret = 'LOST';
					}

					return $ret;
		   		} # END Method

		   		public function	hasChild($candidate){
		   			$code = $this->evalRelate($candidate);
					return ($code==self::FLAG_PANT);
		   		} # END Method

		   		public function isLeaf($candidate){
		   			$code = $this->evalRelate($candidate);
					return ($code==self::FLAG_LEAF);
		   		} # END Method

		   		public function notFound($candidate){
		   			$code = $this->evalRelate($candidate);
					return ($code==self::FLAG_LOST);
		   		} # END Method

				public function get_Orphans() {
				    return $this->findOrphanSet();
				} # END Method

				public function get_ParentOf($candidate) {
					return $this->parent_finder[$candidate];
				} # END Methof

				public function spreadFromParent($targetParent) {
					$giveBack = [];

					foreach ($this->child_set as $key => $candidate) {
							$gotPant = $this->parent_finder[$candidate];
							if ($gotPant==$targetParent) {
								array_push($giveBack, $candidate);
							}							
						}
					return $giveBack;
				} # END Method

				function __construct($feed,$isShowingTrace=false) {
					$this->isShowingTrace=$isShowingTrace;

					$this->feed = $feed;
					$this->build_parentset();
					$this->parent_finder = $this->dict_keyas_child();
					$this->child_set = $this->findChildSet();
				}

				private function build_parentset() {
		            $this->parent_set=[];
	                if ($this->isShowingTrace) {
	                	echo("This is the Parent-Set:<br>");	
	                } # End If
		            foreach ($this->feed as $key => $line) {
		            	$pant = $line[0];
	                    $found = in_array ( $pant , $this->parent_set);
						if($found==false) {
							array_push($this->parent_set, $pant);
							if ($this->isShowingTrace) {
								echo(" >  " . $pant . "<br>");
							} # Enf If
						}; # End If
					}; # End Loop
		        } // End func

				private function dict_keyas_child() {
					$dict = []; # Empty Dictionary
					foreach ($this->feed as $ref => $line) {
						$value = $line[0]; # ORIGINALLY 0
						$key = $line[1]; # ORIGINALLY 1
						$dict[$key] = $value;
					}; # End Loop
					return $dict;
				} // End Func

				private function evalRelate($candidate){
					$ret = "dataOK";
					$isPant = in_array($candidate, $this->parent_set);
					$isChild = in_array($candidate, $this->child_set);

					if (!$isChild and !$isPant) {
						$ret = self::FLAG_LOST;
					}

					if ($isChild and !$isPant) {
						$ret = self::FLAG_LEAF;
					}

					if ($isPant==true) {
						$ret = self::FLAG_PANT;
					}

					return $ret;
		   		} # END


				private function findChildSet() {
					$child_set=[];
					if ($this->isShowingTrace) {
						echo "<br>These are the children:<br>";
					} # End if
					foreach ($this->feed as $ref => $line) {
						$member = $line[1];
						array_push($child_set, $member);
						if ($this->isShowingTrace) {
							echo(" >  " . $member . "<br>");
						} # End if
					}; # End Loop

					return $child_set;
				} // End Func


				private function findOrphanSet() {
					$child_set = $this->child_set;
					$orphanList=[];
				    foreach ($this->parent_set as $ref => $candidate) {
				    	$found = in_array ( $candidate , $child_set);
				    	if($found==false) {
							array_push($orphanList, $candidate);
				    	} # End If
				    } # End Loop
				    return $orphanList;
				} // End func

		} # End Class  Toolbox		
	?>
