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

include "database.php";
?>

<fieldset>

    <legend>Introduction</legend>
    <div>
        <label>Full Name</label>: <span><?php echo $fullName ?></span>
    </div>

    <div>
        <label>Age:</label> <span><?php echo $age ?></span>
    </div>

    <?php if ( $age < 10 ) { ?>
        <span>Age is less than ten.</span>
    <?php } else { ?>
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

<fieldset>

    <legend>List of students fetched from Database</legend>
    <div>
        <button onclick="window.location.href='/forms.php'">Create New</button>
    </div>
    <br>
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ( read($pdo, 'students') as $item => $value ) { ?>
            <tr>
                <td><?php echo $value['id']; ?></td>
                <td><?php echo $value['first_name']; ?></td>
                <td><?php echo $value['last_name']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><?php echo $value['phone']; ?></td>
                <td>
                    <button onclick="window.location.href='<?php echo "forms.php?id={$value["id"]}&edit=true"; ?>'" style="color: blue">Edit</button>
                    <button style="color: red">Delete</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</fieldset>

</body>
</html>
