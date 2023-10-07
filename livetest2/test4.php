<?php
//task 1
class Person {
    // attributes
    public $name;
    public $age;

    // constructor
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    // method
    public function introduce() {
        echo "My name is {$this->name} and I am {$this->age} years old.";
    }
}

// Example usage:
$person = new Person("John", 30);
$person->introduce();

//task 2
class Student extends Person {
    // additional attribute
    public $mark;

    // constructor
    public function __construct($name, $age, $mark) {
        parent::__construct($name, $age);
        $this->mark = $mark;
    }

    // method override
    public function introduce() {
        echo "My name is {$this->name}, I am {$this->age} years old.\n";
    }

    // additional method
    public function calculate_grade_percentage() {
        // Assume that the mark is out of 100
        $gradePercentage = (floatval($this->mark) / 100) * 100;
        return "{$gradePercentage}%";
    }
}

// Example usage:
$student = new Student("Robert", 18, "85");
$student->introduce();
$gradePercentage = $student->calculate_grade_percentage();
echo "My grade percentage is {$gradePercentage}\n";

