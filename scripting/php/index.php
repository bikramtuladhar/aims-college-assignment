<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lab Practise</title>
</head>
<body>
<?php

$firstName = "Bikram";
$lastName  = "Tuladhar";
$fullName  = "{$firstName} {$lastName}";
$age       = 29;
$street    = "Bugamati-22";
$city      = "Lalitpur";
?>

<fieldset>

	<legend>Introduction</legend>
	<div>
		<label>Full Name</label>: <span><?php echo $fullName ?></span>
	</div>

	<div>
		<label>Age:</label> <span><?php echo $age ?></span>	
	</div>

	<?php if($age < 10){ ?>
		<span>Age is less than ten.</span>
	<?php }else{ ?>
		<span>Age is greater than ten.</span>
	<?php } ?>

	<div>
		<label>Address:</label>
		<span><?php echo "{$street}, {$city}"; ?></span>
	</div>
	<div>
		<label>City:</label>
		<span><?php echo "{$city}"; ?></span>
	</div>

</fieldset>
</body>
</html>