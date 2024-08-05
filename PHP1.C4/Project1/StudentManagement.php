<?php
declare(strict_types=1);
$warningMessage1 = '';
$warningMessage2 = '';
$warningMessage3 = '';
$warningMessage4 = '';
$warningMessage5 = '';

$contentArray = [];

$regNoExist = false;
$regNoPattern = false;
$namePattern = false;
$gradePattern = false;
$classroomPattern = false;



$fileName = "./StudentData.json";

if (file_exists($fileName)) {

    $fileRead = file_get_contents('./StudentData.json', true);
    if (!empty($fileRead)) {

        $contentArray = json_decode($fileRead, true);

        if (!empty($_POST['delete-student'])) {
            unset($contentArray[$_POST['delete-student'] - 1]);

            $fileHandlerDelete = fopen("StudentData.json", "w+");
            fwrite($fileHandlerDelete, json_encode($contentArray));
            fclose($fileHandlerDelete);
        }

    }
} else {
    echo "file doesn't exists";
}

if (isset($_POST['registration-no'])) {
    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['registration-no'])) {
        $regNoPattern = true;
    } else {

        $warningMessage2 = "<div class=\"alert alert-danger\" role = \"alert\" >
            Letters and numbers are only eligible!
        </div >";
    }
}

if (isset($_POST['student-name'])) {
    if (preg_match('/^[a-zA-Z\s]+$/', $_POST['student-name'])) {
        $namePattern = true;
    } else {

        $warningMessage3 = "<div class=\"alert alert-danger\" role = \"alert\" >
            Letters and spaces are only eligible!
        </div >";
    }
}



if (isset($_POST['student-grade'])) {
    if ($_POST['student-grade'] == -1) {
        $warningMessage4 = "<div class=\"alert alert-danger\" role = \"alert\" >
            Grade cannot be empty!
        </div >";
    }
    else
    {
        $gradePattern = true;
    }
}

if (isset($_POST['student-classroom'])) {
    if ($_POST['student-classroom'] == -1) {
        $warningMessage5 = "<div class=\"alert alert-danger\" role = \"alert\" >
            Classroom cannot be empty!
        </div >";
    }
    else
    {
        $classroomPattern = true;
    }
}


if ($regNoPattern && $namePattern && $gradePattern && $classroomPattern) {
     foreach ($contentArray as $student) {
        if ($student[0] == $_POST['registration-no']) {
            $regNoExist = true;
        }
    }


    if ($regNoExist) {
        $warningMessage1 = "<div class=\"alert alert-danger\" role = \"alert\" >
            Registration No already exists. please enter different number!
        </div >";
    } else {
        $contentArray[] = [$_POST['registration-no'], $_POST['student-name'], $_POST['student-grade'], $_POST['student-classroom']];


        $fileHandler = fopen("StudentData.json", "w+");
        fwrite($fileHandler, json_encode($contentArray));

        $file = file_get_contents('./StudentData.json', true);
        fclose($fileHandler);
    }


}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
    </style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Student Registration</h1>
            <form action="StudentManagement.php" method="post">
                <?php echo $warningMessage1; ?><br>
                <label for="registration-no" class="form-label">Registration No<sup>*</sup></label>
                <?php echo $warningMessage2; ?><br>
                <input class="form-control" type="text" name="registration-no"><br/>
                <label class="form-label">Student Name<sup>*</sup></label>
                <?php echo $warningMessage3; ?><br>
                <input class="form-control" type="text" name="student-name"><br/>
                <label class="form-label">Grade<sup>*</sup></label>
                <?php echo $warningMessage4; ?><br>
                <select class="form-control" name="student-grade">
                    <option value="-1">Select Grade</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br/>
                <label class="form-label">Classroom<sup>*</sup></label>
                <?php echo $warningMessage5; ?><br>
                <select class="form-control" name="student-classroom">
                    <option value="-1">Select Classroom</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br/>
                <button class="btn btn-primary" type="submit">Add</button>
            </form>
        </div>
    </div>
    <div class="row text-center">

        <div class="col">
            <?php

            if(!empty($contentArray))
            {
                echo "<table class=\"table table-striped\">
                <tr>
                    <th>Registration No</th>
                    <th>Student Name</th>
                    <th>Grade</th>
                    <th>Class Room</th>
                    <th colspan=\"1\"></th>
                    <th></th>
                </tr>";
            }
            else
            {
                echo "<div class=\"alert alert-danger\" role = \"alert\" >
           There are no student's records in the database!
        </div >";
            }


            foreach ($contentArray as $key => $student) {

                echo "<tr><td>" . $student[0] . "</td><td>" . $student[1] . "</td><td>" . $student[2] . "</td><td>" . $student[3] . "</td>
<td>
<form action=\"StudentUpdate.php\" method=\"post\">
    <button class=\"btn btn-warning\" name=\"update-student\" value=\"" . ($key + 1) . "\">Update</button>
</form>
</td>
<td>
<form action=\"StudentManagement.php\" method=\"post\">
    <button class=\"btn btn-danger\" name=\"delete-student\" value=\"" . ($key + 1) . "\">Delete</button>
</form>
</td>
</tr>";
            }

            ?>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>
