<?php
/* Author : Amonchai Padchachai
   Date : 2019-11-29
   Issue: MAQE ROBOT
*/   
$posX 	  = 0;
$posY 	  = 0;
$point 	  = 0;
$compass  = 0;
$Dcompass = ['North', 'East', 'South', 'West'];

function DirectionCompass($compass){
    global $Dcompass;
    return $Dcompass[$compass];
}

function Forward($point) {
    global $compass;
    global $posX;
    global $posY;
    if(!is_numeric($point) || "" ) {
	    return false;
    }
	if(DirectionCompass($compass) == "North" ) {
		$posY+=$point;
	} else if(DirectionCompass($compass) == "South" ) {
		$posY-=$point;
	} else if(DirectionCompass($compass) == "East" ) {
		$posX+=$point;
	} else if(DirectionCompass($compass) == "West" ) {
		$posX-=$point;
	}
	return $point;
}
    
function TurnRight() {
    global $compass;
	if($compass==3) {
		$compass=0;
	} else {
		$compass+=1;
	}
	return DirectionCompass($compass);
}
    
function TurnLeft() {
    global $compass;
	if($compass==0)	{
		$compass=3;
	}
	else {
		$compass-=1;
	}
	return DirectionCompass($compass);
}

function Move($input) {   
    global $compass;
    global $posX;
    global $posY;
	$count=0;
	$input = preg_split("/(?=[a-z])/i",$input);
	
	for ($i=0; $i<= sizeof($input);$i++) {   
        $ch = $input[$i];
		if($ch == 'R') {
            TurnRight();    
		} else if( $ch=='L') {
            TurnLeft();
		} else if(substr( $ch, 0, 1) == "W"){
            $point = preg_split("/(,?\s+)|((?<=[a-z])(?=\d))|((?<=\d)(?=[a-z]))/i",$ch);
            Forward($point[1]);    
        }
    }
    echo " X : ". $posX 
       . " Y: ".$posY
       . " Direction : ".DirectionCompass($compass)
	   ."\n"; 
}


Move($argv[1]);


?>