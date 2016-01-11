<link rel="stylesheet" href="views/css/table.css">
<?php
$grades = $this->showAllStudentGrades();
$courses = $this->showAllCourses();
function showExamPaper($studentId, $courseId) {
    $compartment = "ExamPaper-StudentId " . $studentId . "-" . "CourseId " .  $courseId;
    $files = glob( 'exam-papers/*');
    if (count($files) > 0)
        foreach ($files as $file)
        {
            $info = pathinfo($file);
            $file1 = $compartment ."." .$info['extension'];
            if($info["basename"] === $file1){
           //     echo $info["basename"] .   $file1  ."</br>";
                return true;
            }
            else return false;
        }
}
function getPaperFileName($studentId, $courseId) {
    $compartment = "ExamPaper-StudentId " . $studentId . "-" . "CourseId " .  $courseId;
    $files = glob( 'exam-papers/*');
    if (count($files) > 0)
        foreach ($files as $file)
        {
            $info = pathinfo($file);
            $file1 = $compartment ."." .$info['extension'];
            if($info["basename"] === $file1){
                return $info["basename"];
            }
            else return "";
        }
}

?>
<div style='overflow:auto;  ' class="scroll">
    <table class="table-style-three">
        <thead>
        <tr>
            <th>Course Id</th>
            <th>Course Name</th>
            <th>Course Grade</th>
            <th>Exam Paper </th>
        </tr>
        </thead>
        <tbody>
        <?php

        while ($grade = mysql_fetch_assoc($grades)) {
            echo "<tr>";
            while ($course = mysql_fetch_assoc($courses)) {
                if ($course['courseId'] == $grade['course_courseId'])  {
                    echo "<td>" . $course['courseId'] . "</td>";
                    echo "<td>" . $course['courseName'] . "</td>";
                    if(showExamPaper($grade['users_userId'] ,$course['courseId'])) {
                        $file = getPaperFileName($grade['users_userId'] ,$course['courseId']);
                        echo "<td> <a target='_blank' href='exam-papers/". $file . "'>Download  </a></td>";
                    }
                    else echo "<td> Unavailable </td>";

                    mysql_data_seek($courses, 0);

                    break;
                }

            }

            echo "<td>"  . $grade['grade'] . "</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>