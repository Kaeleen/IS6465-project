<?php
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
    include 'mysql.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "update student set name='$name',password='$password',email='$email',tel='$tel',address='$address',dob='$dob' where student_id=$id";
    if(mysqli_query($conn,$sql))
    {
        echo ' Updated succesfully!';
        header("refresh:1;url=edit_student.php?year=2021&semester=Fall&id=$id");
        print('Loading...<br>Will redirect to homepage after 1 seconds');
    }else{
        echo 'No data';
        header("refresh:1;url=edit_student.php?year=2021&semester=Fall&id=$id");
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
    $grade = $_POST['grade'];
    $course_id = $_POST['course'];
    $session_id= $_POST['session'];
    $date = date('Y-m-d');
    $sql_has = "select * from enrollment where student_id='$student_id' and course_id='$course_id' ";
    $has_result = mysqli_query($conn,$sql_has);
    if($has_result){
        while ($row = mysqli_fetch_assoc($has_result)) {
        if ($row){
            echo 'fail with has course';
        header("refresh:3;url=edit_student.php?year=2021&semester=Fall&id=$student_id");
        print('Loading...<br>Will redirect to homepage after 3 seconds');
        }
        }
    }else{
        $sql = "insert into enrollment (student_id,grade,course_id,session_id,date_enrolled)  values ('$student_id','$grade','$course_id','$session_id','$date')";
        if(mysqli_query($conn,$sql))
        {
            echo ' Updated succesfully!';
            header("refresh:1;url=edit_student.php?year=2021&semester=Fall&id=$student_id");
            print('Loading...<br>Will redirect to homepage after 1 seconds');
        }else{
            echo 'No data';
            header("refresh:1;url=edit_student.php?year=2021&semester=Fall&id=$student_id");
            print('Loading...<br>Will redirect to homepage after 1 seconds');
        }
    }
}


function report_by_student(){
    include 'mysql.php';
    $courseid = $_POST['courseid'];
    $gpa1 = $_POST['gpa1'];
    $gpa2 = $_POST['gpa2'];
    $sql = "select student_id from enrollment where course_id  = $courseid and grade > $gpa1 and grade < $gpa2";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
        $ids = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $ids[] =$row['student_id'];
        }
        $ids = '('.implode(',',$ids).')';
        $sql = "select * from student where student_id in $ids ";
        $result = mysqli_query($conn,$sql);
        if($result)
        {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] =[
                    'student_name'=>$row['name'],
                    'program'=>$row['program_id']
                ];
            }
            echo json_encode($data);
        }else{
            echo json_encode(['code'=>500]);
        }
    }else{
        echo json_encode(['code'=>500]);
    }

}