<?php

// Task 1: Print the Age
$student = ['name' => 'Alice', 'age' => 22, 'grade' => 'A'];
echo $student['age'];

// Task 2: Check for 'grade' Key

$student = ['name' => 'Alice', 'age' => 22, 'grade' => 'A'];
if (array_key_exists('grade', $student)) {
    echo "The 'grade' key exists in the array.";
} else {
    echo "The 'grade' key does not exist in the array.";
}


// Task 3 : print values in array 
$numbers = [100, 200, 50, 40, 50];
foreach ($numbers as $value) {
    echo $value . "\n";
}

// Task 4: Filter Names Starting with 'M'

$names = ['Talha', 'Afnan', 'Mashrufa', 'Zia', 'Iqbal', 'Habib', 'Airin', 'Moni'];

function startsWithM($name) {
    return strpos($name, 'M') === 0;
}

$filteredNames = array_filter($names, 'startsWithM');

foreach ($filteredNames as $name) {
    echo $name . "\n";
}

// Task 5 : reverse a string 

$originalString = 'Hello, World!';
$reversedString = strrev($originalString);
echo $reversedString;