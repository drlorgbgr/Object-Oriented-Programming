<?php

$a = 0;
$b = 1;

for ($i = 0; $i < 10; $i++) {

    echo $a . "<br>";

    $hasil = $a + $b;
    $a = $b;
    $b = $hasil;
}
?>
