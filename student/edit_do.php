
<?php

date_default_timezone_set('America/Denver');

$method = $_POST['method'];
if ($method == 'edit_student_do'){
    edit_student_do();
}elseif($method == 'update_grade'){
    update_grade();
}elseif($method == 'delete_enrollment'){
    delete_enrollment();
}elseif($method == 'get_course'){
    get_course();
}elseif($method == 'get_session'){
    get_session();
}elseif($method == 'add_enrollment'){
    add_enrollment();
}elseif($method == 'report_by_student'){
    report_by_student();
}
function edit_student_do(){
    include '../mysql.php';
//    include 'mysql.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
//    $program_id = $_POST['program'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "update student set name='$name',password='$password',email='$email',tel='$tel',address='$address',dob='$dob' where student_id=$id";
//    $sql = "update student set program_id='$program_id',name='$name',password='$password',email='$email',tel='$tel',address='$address',dob='$dob' where student_id=$id";
    if(mysqli_query($conn,$sql))
    {
        echo ' Updated succesfully!';
        header("refresh:1;url=index_student.php?year=2021&semester=Fall");
        print('Loading...<br>Will redirect to homepage after 1 seconds');
    }else{
        echo 'No data';
        header("refresh:1;url=index_student.php?year=2021&semester=Fall");
        print('Loading...<br>Will redirect to homepage after 1 seconds');
    }
}

function update_grade(){
    include 'mysql.php';
    $enrollment_id = $_POST['enrollment_id'];
    $grade = $_POST['grade'];
    $sql = "update enrollment set grade='$grade' where enrollment_id=$enrollment_id";
    if(mysqli_query($conn,$sql))
    {
       echo json_encode(['code'=>200]);
    }else{
        echo json_encode(['code'=>500]);
    }
}


function delete_enrollment(){
    include 'mysql.php';
    $enrollment_id = $_POST['enrollment_id'];
    $date = date('Y-m-d');
    $sql = "update enrollment set date_dropped='$date' where enrollment_id=$enrollment_id";
    if(mysqli_query($conn,$sql))
    {
        echo json_encode(['code'=>200]);
    }else{
        echo json_encode(['code'=>500]);
    }
}


function get_course(){
    include 'mysql.php';
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $sql = "select * from course where year = $year and semester = '$semester'";
    $year_result = mysqli_query($conn,$sql);
    if($year_result)
    {
        $data = [];
        while ($row = mysqli_fetch_assoc($year_result)) {
            $data[] =[
                'course_id'=>$row['course_id'],
                'course_anme'=>$row['course_name']
            ];
        }
        echo json_encode($data);
    }else{
        echo json_encode(['code'=>500]);
    }
}

function get_session(){
    include 'mysql.php';
    $courseid = $_POST['courseid'];
    $sql = "select * from session where course_id = $courseid ";
    $year_result = mysqli_query($conn,$sql);
    if($year_result)
    {
        $data = [];
        while ($row = mysqli_fetch_assoc($year_result)) {
            $data[] =[
                'session_id'=>$row['session_id'],
                'session_name'=>$row['session_name']
            ];
        }
        echo json_encode($data);
    }else{
        echo json_encode(['code'=>500]);
    }
}

function add_enrollment(){
    include 'mysql.php';
    $student_id = $_POST['student'];
    $grade = $_POST['grade'] ?: 0;
    $course_id = $_POST['course'];
    $session_id= $_POST['session'];
    $date = date('Y-m-d');
    $sql_has = "select * from enrollment where student_id='$student_id' and course_id='$course_id' ";
    $has_result = mysqli_query($conn,$sql_has);
    if ($row = mysqli_fetch_assoc($has_result)){
        if (empty($row['date_dropped'])){
        echo ' error! The course has been registered!';
        header("refresh:3;url=index_student.php?year=2021&semester=Fall&id=$student_id");
//        print('Loading...<br>Will redirect to homepage after 3 seconds');
        return ;
        }else{
            $sqlhas = "delete from enrollment where student_id='$student_id' and course_id='$course_id' ";
            mysqli_query($conn,$sqlhas);
        }
        }
            $sql = "insert into enrollment (student_id,grade,course_id,session_id,date_enrolled)  values ('$student_id','$grade','$course_id','$session_id','$date')";
    if(mysqli_query($conn,$sql))
            {
                echo ' Updated succesfully!';
                header("refresh:1;url=index_student.php?year=2021&semester=Fall&id=$student_id");
                print('Loading...<br>Will redirect to homepage after 1 seconds');
            }else{
                echo 'No data';
                header("refresh:1;url=index_student.php?year=2021&semester=Fall&id=$student_id");
                print('Loading...<br>Will redirect to homepage after 1 seconds');
            }


}


function report_by_student(){
    include 'mysql.php';
    $courseid = $_POST['courseid'];
    $gpa1 = $_POST['gpa1'];
    $gpa2 = $_POST['gpa2'];
    $sql_GPA = "select sum( grade * credit)/sum(credit) as gpa,enrollment_id from enrollment  left join course on enrollment.course_id =course.course_id  where  enrollment.course_id  = $courseid group by enrollment.student_id";
    $resultGPA = mysqli_query($conn,$sql_GPA);
    $gpa=0;
    $eids = [];
    if ($resultGPA){
        while ($resultGPARow = mysqli_fetch_assoc($resultGPA)) {
            $gpa = bcdiv($resultGPARow['gpa'] ?? 0,1,2);
            if ($gpa>$gpa1 && $gpa<$gpa2){
                $eids[$resultGPARow['enrollment_id']]=$gpa;
            }
        }
    }
    $eidids = implode(',', array_keys($eids));
    $sql = "select student.student_id,grade,student.name,program_id from enrollment left join student on enrollment.student_id = student.student_id where enrollment_id in ($eidids)";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
                $data[] =[
                    'student_name'=>$row['name'],
                    'program'=>$row['program_id'],
                    'grade'=>$row['grade'],
                    'program_id'=>$row['program_id']
                ];
            echo json_encode($data);
        }
    }else{
        $data = [];
        echo json_encode($data);
    }

}