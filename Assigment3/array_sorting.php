<?php
$grades = [85, 92, 78, 88, 95];

function sortGradesDescending($gradesArray) {
    rsort($gradesArray);
    print_r($gradesArray);
}

sortGradesDescending($grades);
?>
