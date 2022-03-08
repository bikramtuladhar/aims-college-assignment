<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP Forms</title>
</head>
<body>
<?php
$errors = [];

function maxValue(&$errors, $fieldName, $limit, $value)
{
    if ( strlen($value) > $limit ) {
        $errors[$fieldName][] = "{$fieldName} should not exceed $limit.";
    }
}

function minValue(&$errors, $fieldName, $limit, $value)
{
    if ( strlen($value) < $limit ) {
        $errors[$fieldName][] = "{$fieldName} should exceed $limit.";
    }
}

function required(&$errors, $fieldName, $value)
{
    if ( empty($_POST[$fieldName]) ) {
        $errors[$fieldName][] = "{$fieldName} is required";
    }
}

function getError($errors, $fieldName)
{
    if ( isset($errors[$fieldName]) ) {
        return $errors[$fieldName];
    }

    return [];
}

function email(&$errors, $fieldName, $value)
{
    $re  = '/([a-zA-Z-0-9]+)(@)([a-zA-Z-0-9]+)\.([a-zA-Z-0-9]+)/';
    $str = $_POST[$fieldName];

    preg_match_all($re, $str, $matches, PREG_SET_ORDER, 0);
    $email = $matches[0][0] ?? '';
    if ( $email !== $str ) {
        $errors[$fieldName][] = "{$fieldName} is not a valid email address";
    }
}

function validation(&$errors)
{
    $rules = [
        'first_name' => ['required', 'maxValue:20', 'minValue:3'],
        'last_name'  => ['required', 'minValue:2', 'maxValue:30'],
        'email'      => ['required', 'email'],
        'phone'      => ['required'],
    ];
    foreach ( $rules as $fieldName => $rulesArray ) {
        foreach ( $rulesArray as $rule ) {
            $ruleName = explode(':', $rule, 2)[0];
            $params   = [&$errors, $fieldName, explode(':', $rule, 2)[1] ?? ''];

            if ( isset($_POST[$fieldName]) ) {
                $params[] = $_POST[$fieldName];
            } else {
                $params[] = '';
            }
            call_user_func_array($ruleName, $params);
        }
    }
}

if ( !empty($_POST) ) {
    validation($errors);
}

?>
<form method="post" action="forms.php">
    <div>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $_POST['first_name'] ?? '' ?>">
        <?php foreach ( getError($errors, 'first_name') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>
    <div>
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $_POST['last_name'] ?? '' ?>">
        <?php foreach ( getError($errors, 'last_name') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">
        <?php foreach ( getError($errors, 'email') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone" value="<?php echo $_POST['phone'] ?? '' ?>">
        <?php foreach ( getError($errors, 'phone') as $error ) { ?>
            <br>
            <span style="color: darkred;"><?php echo $error ?></span>
            <br>
        <?php } ?>
    </div>

    <div>
        <input type="submit" name="submit">
    </div>
</form>

<div>
    <table border="1">
        <thead>
        <th>Field</th>
        <th>Value</th>
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
</div>
</body>
</html>
