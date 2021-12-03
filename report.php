<?php
include 'mysql.php';

$sql = "select * from course";
$result = mysqli_query($conn,$sql);
$courses =  [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] =$row;
}
$year_sql = "select * from course";
$year_result = mysqli_query($conn,$year_sql);
$year = $semester = [];
while ($row = mysqli_fetch_assoc($year_result)) {
    $year[] =$row['year'];
    $semester[]=$row['semester'];
}
$year = array_unique($year);
$semester = array_unique($semester);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>reports</title>
    <style>
        .adds-stu-wrap{
            width: 700px;
            height: auto;
            margin: 0 auto;
            margin-top: 100px;

        }
        .adds-stu{
            float: left;
            width: 100%;
            height: auto;
            background-color: #eee;
            padding: 15px 10px;
        }
        .adds-stu div{
            float: left;
            width: 100%;
            margin-bottom: 20px;
        }
        .adds-stu div>p{
            float: left;
            width: 150px;
            margin: 0 10px 0 0;
            text-align: right;

        }
        .adds-stu div>input{
            float: left;
            width: 150px;
        }
    </style>
    <script src="https://cdn.staticfile.org/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
</head>
<body id="app4">
<div class="adds-stu-wrap" style="display: block">
    <h2 class="head" style="text-align:center">reports </h2>
    <div class="adds-stu"  id="list_stu">
        <form action="edit_student_do.php" method="post">
            <div style="text-align: center;margin-top: 80px">
                course:
                <select name="course" onchange="report_by_student()" id="courseid">
                    <?php
                    foreach ($courses as $item){
                        ?>
                        <option value ="<?php echo  $item['course_id'];  ?>"  ><?php echo  $item['course_name'];  ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <p>GPA:</p>
                <input type="text" name="gpa1" id="gpa1"  onchange="report_by_student()" value="1">
                <input type="text" name="gpa2" id="gpa2"  onchange="report_by_student()" value="5">
            </div>
        </form>
        <table  border="1"    style="text-align: center">
            <tr>
                <th>student_name</th>
                <th>program</th>
                <th>grade</th>
            </tr>
            <tbody id="tbody">
            </tbody>
        </table>
    </div>

    <div class="adds-stu"  style="margin-top: 50px">
        <form action="edit_student_do.php" method="post">
            <div style="text-align: center;margin-top: 80px">
                <label for="studentName">Year:</label>
                <select name="year" onchange="report_by_student1()" id="year" >
                    <?php
                    foreach ($year as $item){
                        ?>
                        <option value ="<?php echo  $item;  ?>" ><?php echo  $item;  ?></option>
                        <?php
                    }

                    ?>
                </select>
                semester:
                <select name="semester"  onchange="report_by_student1()" id="semester" >
                    <?php
                    foreach ($semester as $item){
                        ?>
                        <option value ="<?php echo  $item;  ?>"><?php echo  $item;  ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div >
                <p>enrollment_count:</p>
                <input type="text" name="count1"  onchange="report_by_student1()" id="count1" value="">
                <input type="text" name="count2" onchange="report_by_student1()" id="count2"  value="">
            </div>
        </form>
        <table  border="1"    style="text-align: center">
            <tr>
                <th>course_name</th>
                <th>credit</th>
                <th>department_id</th>
                <th>enrollment_count</th>
            </tr>
            <tbody id="tbody1">
            </tbody>
        </table>
    </div>
</div>
</body>
<script>
    function report_by_student(){
                var $gpa1 = $("#gpa1").val(),
                    $courseid  = $("#courseid").val(),
                    $gpa2  = $("#gpa2").val()
                $.ajax({
                    type: "POST",
                    url: "edit_student_do.php",
                    data: {method:"report_by_student",gpa1:$gpa1,gpa2:$gpa2,courseid:$courseid},
                    dataType: "json",
                    success: function(data){
                        console.log(data)
                        $("#tbody").html("");
                        for (var i=0;i<data.length;i++)
                        {
                            console.log(data[i])
                           var tr = " <tr><td>"+data[i]['student_name']+"</td><td>"+data[i]['program']+"</td><td>"+data[i]['grade']+"</td></tr>"
                            $("#tbody").append(tr)
                        }

                    }
                })
            }

    function report_by_student1(){
        var $year = $("#year").val(),
            $semester  = $("#semester").val(),
            $count1  = $("#count1").val(),
            $count2  = $("#count2").val()
        $.ajax({
            type: "POST",
            url: "edit_student_do.php",
            data: {method:"report_by_student1",year:$year,semester:$semester,count1:$count1,count2:$count2},
            dataType: "json",
            success: function(data){
                console.log(data)
                $("#tbody1").html("");
                for (var i=0;i<data.length;i++)
                {
                    console.log(data[i])
                    var tr = " <tr><td>"+data[i]['course_name']+"</td><td>"+data[i]['credit']+"</td><td>"+data[i]['department_id']+"</td><td>"+data[i]['enrollment_count']+"</td></tr>"
                    $("#tbody1").append(tr)
                }

            }
        })
    }
</script>
</html>