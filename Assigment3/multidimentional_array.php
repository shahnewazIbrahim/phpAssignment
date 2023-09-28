<?php
$studentGrades = [
    "Student 1" => ["Math" => 90, "English" => 85, "Science" => 88],
    "Student 2" => ["Math" => 92, "English" => 89, "Science" => 94],
    "Student 3" => ["Math" => 78, "English" => 92, "Science" => 86],
];

function calculateAverageGrades($gradesArray) {
    foreach ($gradesArray as $student => $grades) {
        $average = array_sum($grades) / count($grades);
        echo "$student: Average Grade = $average\n";
    }
}

calculateAverageGrades($studentGrades);
?>
