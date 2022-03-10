<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Forms</title>
</head>
<body>
<?php
$errors = [];

include 'validation.php';
include "database.php";
$postData = $_POST;
if ( isset($_GET['edit']) && isset($_GET['id']) ) {
    $result   = query($pdo, 'students', "id={$_GET['id']}");
    $postData = $result[0] ?? [];
}
?>
<form method="post" action="forms.php">
    <div>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $postData['first_name'] ?? '' ?>">
        <?php foreach ( getError($errors, 'first_name') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>
    <div>
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $postData['last_name'] ?? '' ?>">
        <?php foreach ( getError($errors, 'last_name') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $postData['email'] ?? '' ?>">
        <?php foreach ( getError($errors, 'email') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone" value="<?php echo $postData['phone'] ?? '' ?>">
        <?php foreach ( getError($errors, 'phone') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <?php

    if ( isset($_GET['edit']) && isset($_GET['id']) ) {
        echo "<input type='hidden' value='true' name='edit'>";
    }
    ?>

    <div>
        <input type="submit" name="submit">
    </div>
</form>

<div>
    <table border="1">
        <caption>Current submitted values</caption>
        <thead>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        </thead>
        <tbody>
        <?php if ( count(array_values($_POST)) ) {
            foreach ( $_POST as $key => $value ) { ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="2">form has not been submitted yet.</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <br>
    <div>
        Click
        <button onclick="window.location.href='/'">Here to see all the stored students</button>
    </div>
</div>
</body>
</html>
