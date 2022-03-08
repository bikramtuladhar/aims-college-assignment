<?php


function fullName($firstName, $secondName){
	echo sprintf("<b>First parameter: </b> %s <br>",$firstName);
	echo sprintf("<b>Second parameter: </b> %s <br>",$secondName);

	echo "<b>Concated parameters: </b> {$firstName} {$secondName}";
}


function unlimitedConcact(...$args){
	echo "<br>";
	echo implode(" ", $args);
}

function defaultConcacted($street1="Bungamati-22",$sreet2="Lalitpur"){
		echo "<br><b>Default concated parameters: </b> {$street1} {$sreet2}";
}


fullName("aims","college");

unlimitedConcact("Bikram", "Tuladhar", "Bigyan", "Gautam");

defaultConcacted();