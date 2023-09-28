<?php
$numbers = range(1, 10);

function removeEvenNumbers(&$numberArray) {
    $numberArray = array_filter($numberArray, function($value) {
        return $value % 2 != 0;
    });
    print_r($numberArray);
}

removeEvenNumbers($numbers);
?>
