<?php

$input = [
    'languages' => [
        'PHP',
        'Javascript',
        'Python',
        'Java',
        'Go',
        'Lua',
        'C++',
    ],
    'student' => 'John Doe',
    'grade' => 'A',
];

// Extract the student's information from the array
$student = $input['student'];
$firstLanguage = $input['languages'][0]; // Access first language in the languages array
$grade = $input['grade'];

// Output the student's information using Heredoc
$output = <<<EOT
Student: $student
First Language: $firstLanguage
Grade: $grade
EOT;

echo $output;
?>
