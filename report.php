<?php
include 'mysql.php';

$sql = "select * from course";
$result = mysqli_query($conn,$sql);
$courses =  [];
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] =$row;
}
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
            width: 100px;
            margin: 0 10px 0 0;
            text-align: right;

        }
        .adds-stu div>input{
            float: left;
            width: 260px;
        }
    </style>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
</head>
<body>
<div class="adds-stu-wrap" style="display: block">
    <h2 class="head" style="text-align:center">reports </h2>
    <div class="adds-stu">
        <form action="edit_student_do.php" method="post">
            <div style="text-align: center;margin-top: 80px">
                course:
                <select name="course" id="courseid" onchange="report_by_student()">
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
                <input type="text" name="gpa1" id="gpa1" @change="" onchange="report_by_student()" value="1">
                <input type="text" name="gpa2" id="gpa2" onchange="report_by_student()" value="5">
            </div>

        </form>
        <table border="1"    style="text-align: center">
            <tr>
                <th>student_name</th>
                <th>program</th>
            </tr>
            <tr id="list_stu" v-for="stu in stus">
                <td>  {{ stu.student_name }}</td>
                <td>  {{ stu.program }}</td>
            </tr>
        </table>
    </div>

</div>


</body>

<script>
    var app4 = new Vue({
        el: '#list_stu',
        data: {
            stus:[]
        },
        methods: {
            report_by_student () {
                alert(1111)
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
                        this.stus=data
                        console.log(this.stus)
                    }
                });
            }
        },
        mounted () {
            // we can implement any method here like
            this.report_by_student()
        },
    })

    // function report_by_student(){
    //     var $gpa1 = $("#gpa1").val(),
    //         $courseid  = $("#courseid").val(),
    //         $gpa2  = $("#gpa2").val()
    //     $.ajax({
    //         type: "POST",
    //         url: "edit_student_do.php",
    //         data: {method:"report_by_student",gpa1:$gpa1,gpa2:$gpa2,courseid:$courseid},
    //         dataType: "json",
    //         success: function(data){
    //             console.log(data)
    //             this.stus=data
    //             console.log(this.stus)
    //         }
    //     });
    // }
    // report_by_student()

</script>
</html>