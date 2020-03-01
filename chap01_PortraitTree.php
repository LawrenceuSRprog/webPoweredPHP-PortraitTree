<!DOCTYPE html>
<html>
     <head>
             <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
             <title>MiddleOut PortraitBench</title>
     </head>
     <body>

        <?php # [LinoBlock] is the first OBJECT being targetted
		      #   Trying to eliminate savedWork
		      # ==============================================================
              #     spyOn_Bench() helps see what's inside


        class LinoBlock{
       // Properties
            private $workBench; # Working area for calculations
            private $EndOfKey;  # This acts as a CONSTANT but NOT defined by current obj
            private $hardWired_apexFromOrphanSet; # until the private obj is READY
            private $Just4NowFeed; # for later use

    
        public function __construct($feed){
            $this->EndOfKey = 'L*E*A*F*';
            $this->EndOfDisplay = '}'; # This is a local CONSTANT
            $this->hardWired_apexFromOrphanSet = array('a','b','c'); // Real Version
            //$this->hardWired_apexFromOrphanSet = array('a','b','c','ant','adder'); // Demo Version
            $this->workBench = $this->bringWork($feed);

          } // End construct

        private function hardWired_spreadAlong($picked){
            $EOK = $this->EndOfKey;
            $giveBack=[];

            switch ($picked) {
                case "a":
                    $giveBack=array("ant","adder");
                    break;
                    
                case "b":
                    $giveBack=array("brick","banjo","bank");
                    break;

                case "c":
                    $giveBack=array("cello","catcher","candle",
                                    "coral","cake");
                    break;

                case "ant":
                    $giveBack=array("antler","antivirus","ant hill");
                    break;

                case "adder":
                    $giveBack=array("address","adding","addition");
                    break;

                default:
                    $giveBack=array($EOK);

            }; // End switch
          return $giveBack;
        } // End hardWired_spreadAlong

        private function bringWork($feed){
            $EOD = $this->EndOfDisplay;
            $lino_six = array(0,0,'LH-DATA',0,'RH-DATA',$EOD);
            $rows_used = -1;
            $outPlate = [];

            $parentData = $this->hardWired_apexFromOrphanSet;

            foreach ($parentData as $key => $lhValue) {
                $rhList = $this->hardWired_spreadAlong($lhValue); 
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


        public function spyOn_Bench(){
            echo '<br> This is the contents of workBench <br> <br>';
            foreach ($this->workBench as $key => $chain) {
            $line = "==> ";
            foreach ($chain as $linKey => $link) {
               $line = $line . $link . "|";
            }
            echo $line . '<br>'; 
            } // End of chain
          } // End Func

 
        public function nextLevel(){
            $EOK = $this->EndOfKey;

            $pushedLevel =$this->indexedLevel();
            $delivaryPair = [];
            $pos = 64 ; # One before capital ** A **
            $addrContent = [];

            foreach ($pushedLevel as $key => $content) {
                $pos = $pos +1;
                if ($content<>$EOK) {
                      $addr= strval(chr($pos));
                      $addrContent = array($addr,$content);    
                      array_push($delivaryPair, $addrContent);
                } // End if
            }// End for

            return $delivaryPair;
          } // End Func

        private function indexedLevel(){
                $EOK = $this->EndOfKey;

                $sequencedRHdata =[];
                $rectangle = $this->workBench; 
                $chain = $rectangle[0];
                $marker =  "*E*L*S*E*W*H*E*R*E";

                foreach ($rectangle as $key => $chain) {
                    $owner =  $chain[2];
                    $member =  $chain[4];
                    if ($marker <> $owner){
                          array_push($sequencedRHdata,$EOK);
                          $marker =  $owner;
                       };// end if
                    array_push($sequencedRHdata,$member);
                };// End for
                #array_push($sequencedRHdata,$member);

                array_shift($sequencedRHdata); # removes the only leading DELIMITER
                $endGroupDelimittedSuffix = $sequencedRHdata;
                return $endGroupDelimittedSuffix;
          } // End func

} // End Class

$feed = array('Still',' Not','Using','it');
$objX = new LinoBlock($feed);
$objX->spyOn_Bench();
$delivaryPair = $objX->nextLevel();

echo '<br> This is one of the LEVELS ======';
$prefix = "<br>==> ";
foreach ($delivaryPair as $key => $devPair) {
    $out = $prefix . "< ". $devPair[0] . " >".$devPair[1];
    echo $out;
} // End Foreach

echo "<br><br>Ok up to here";
?>
<div>
    The code for public function nextLevel<br>
    needs to be copied to some equivalent firstLevel.<br>
    Every private function that firstLevel uses should have a name containing Apex<br>

</div>
</body>
</html>