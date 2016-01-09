<link rel="stylesheet" href="views/css/table.css">
<?php
$grades = $this->showAllStudentGrades();
$courses = $this->showAllCourses();
?>
<div style='overflow:auto;  ' class="scroll">
    <table class="table-style-three">
        <thead>
        <tr>
            <th>Course Id</th>
            <th>Course Name</th>
            <th>Course Grade</th>
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