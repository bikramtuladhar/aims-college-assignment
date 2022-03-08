<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Array</title>
</head>
<body>

<?php
$friends            = ['ram','shyam','hari','bikash'];
$friendsWithAddress = [
						['name'=>'ram','address'=>'ktm'],
						['name'=>'shyam','address'=>'drn'],
						['name'=>'hari','address'=>'htd'],
						['name'=>'gopal','address'=>'ltp'],
						['name'=>'sita','address'=>'bkt'],
					  ];
?>

<div>
	<table border="1">
<caption>Name</caption>
	<thead>
		<th>SN</th>
		<th>Name</th>
	</thead>
	<tbody>
        <?php foreach ($friends as $key => $friend) { ?>
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $friend ?></td>
		</tr>
        <?php } ?>
	</tbody>
</table>
</div>


<div>
	<table border="1">
	<caption>Name with address</caption>
	<thead>
		<th>SN</th>
		<th>Name</th>
		<th>Address</th>
	</thead>
	<tbody>
        <?php foreach ($friendsWithAddress as $key => $friendWithAddress) { ?>
		<tr>
			<td><?php echo $key+1 ?></td>
			<td><?php echo $friendWithAddress['name'] ?></td>
			<td><?php echo $friendWithAddress['address'] ?></td>
		</tr>
        <?php } ?>
	</tbody>
</table>
</div>

</body>
</html>