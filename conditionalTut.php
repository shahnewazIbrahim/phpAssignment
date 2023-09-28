<?php
$number = 16;
$remainder = $number % 2;
$result = match ($remainder) {
    0 => "even",
    1 => "odd",
};
echo "$result";
