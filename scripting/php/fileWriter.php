<?php

$file     = fopen("students.txt", "wr");
$students = ["ram", "shyam", "hari"];
foreach ( $students as $student ) {
    fwrite($file, $student.PHP_EOL);
}

foreach ( file("students.txt",) as $line ) {
    echo $line.'<br />';
}
