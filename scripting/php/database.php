<?php
$params = [
    'host'     => '127.0.0.1',
    'port'     => '5432',
    'database' => 'aims',
    'user'     => 'postgres',
    'password' => 'secret',
];
$conStr = sprintf(
    "pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
    $params['host'],
    $params['port'],
    $params['database'],
    $params['user'],
    $params['password']
);

$pdo = new \PDO($conStr);

$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);


function createTable($pdo, $tableName, $columns)
{
    $sqlList =
        "CREATE TABLE IF NOT EXISTS $tableName (
                        id serial PRIMARY KEY,
                        ";
    foreach ( $columns as $column => $attributes ) {
        $sqlList .= "$column "."$attributes,";
    }
    $sqlList = trim($sqlList, ',');

    $sqlList .= ");";

    $pdo->exec($sqlList);
}

function insert($pdo, $tableName, $rows)
{
    $sql = "INSERT INTO $tableName(".implode(",", array_keys($rows)).") VALUES (:".implode(",:", array_keys($rows)).")";

    $stmt = $pdo->prepare($sql);

    foreach ( $rows as $key => $row ) {
        $stmt->bindValue(":".$key, $row);
        $stmt->bindValue(":".$key, $row);
    }

    $stmt->execute();

    return $pdo->lastInsertId("$tableName"."_id_seq");
}

function read($pdo, $tableName)
{
    $sql = "select * from  $tableName";

    $stmt = $pdo->query($sql);

    $results = [];

    while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
        $tmp = [];
        foreach ( $row as $key => $value ) {
            $tmp[$key] = $value;
        }
        $results[] = $tmp;
    }

    return $results;
}

function query($pdo, $tableName, $condition)
{
    $sql = "select * from  $tableName where $condition";

    $stmt = $pdo->query($sql);

    $results = [];

    while ( $row = $stmt->fetch(\PDO::FETCH_ASSOC) ) {
        $tmp = [];
        foreach ( $row as $key => $value ) {
            $tmp[$key] = $value;
        }
        $results[] = $tmp;
    }

    return $results;
}


if ( !empty($_POST) ) {
    createTable($pdo, 'students', [
        'first_name' => 'VARCHAR(200)',
        'last_name'  => 'VARCHAR(200)',
        'email'      => 'VARCHAR(200)',
        'phone'      => 'VARCHAR(200)',
    ]);

    $isEdit   = array_pop($_POST);
    $isSubmit = array_pop($_POST);

    if ( isset($_GET['edit']) && isset($_GET['id']) ) {
        $result   = query($pdo, 'students', "id={$_GET['id']}");
        $postData = $result[0] ?? [];
    }

    if ( strtolower($isSubmit) === 'submit' && !$isEdit ) {
        insert($pdo, 'students', $_POST);
    }

}
