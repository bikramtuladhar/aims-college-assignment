<?php


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
