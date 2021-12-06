
<?php

date_default_timezone_set('America/Denver');
$method = $_POST['method'];
if ($method == 'edit_student_do'){
    edit_student_do();
}elseif($method == 'delete_enrollment'){
    delete_enrollment();
}elseif($method == 'get_course'){
    get_course();
}elseif($method == 'get_session'){
    get_session();
}elseif($method == 'add_enrollment'){
    add_enrollment();
}

function edit_student_do(){
    include 'mysql.php';
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    //$program_id = $_POST['program'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "update student set name='$name',password='$password',email='$email',tel='$tel',address='$address',dob='$dob' where student_id=$id";
    if(mysqli_query($conn,$sql))
    {
        echo ' Updated succesfully!';
        header("refresh:1;url=index_student.php?year=2021&semester=Fall&id=$id");
        print('Loading...<br>Will redirect to homepage after 1 seconds');
    }else{
        echo 'No data';
        header("refresh:1;url=index_student.php?year=2021&semester=Fall&id=$id");
        print('Loading...<br>Will redirect to homepage after 1 seconds');
    }
}


function delete_enrollment(){
    include '../mysql.php';
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
    include '../mysql.php';
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
    include '../mysql.php';
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
    include '../mysql.php';
    $student_id = $_POST['student'];
    $course_id = $_POST['course'];
    $session_id= $_POST['session'];
    $date = date('Y-m-d');
    $session_has = "select * from session where session_id=$session_id ";
    $session_has_result = mysqli_query($conn,$session_has);
    $max = 0;
    if ($maxrow = mysqli_fetch_assoc($session_has_result)){
        $max = $maxrow['quota'];
    }
    $session_old_has = "select count(*) as countid from enrollment where session_id=$session_id  and  date_dropped is null ";

    $session_old_has_result = mysqli_query($conn,$session_old_has);
    if ($session_old_row = mysqli_fetch_assoc($session_old_has_result)){
        if ($session_old_row['countid'] >= $max){
            echo ' the session is ful';
            header("refresh:1;url=index_student.php?year=2021&semester=Fall&id=$student_id");
            return ;
        }
    }
    $sql_has = "select * from enrollment where student_id='$student_id' and course_id='$course_id' ";
    $has_result = mysqli_query($conn,$sql_has);
    if ($row = mysqli_fetch_assoc($has_result)){
        if (empty($row['date_dropped'])){
        echo ' error! The course has been registered!';
        header("refresh:3;url=index_student.php?year=2021&semester=Fall&id=$student_id");
        return ;
        }else{
            $sqlhas = "delete from enrollment where student_id='$student_id' and course_id='$course_id' ";
            mysqli_query($conn,$sqlhas);
        }
        }
            $sql = "insert into enrollment (student_id,course_id,session_id,date_enrolled)  values ('$student_id','$course_id','$session_id','$date')";
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

