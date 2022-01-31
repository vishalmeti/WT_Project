<?php

session_start();
$con = new mysqli('localhost','root','','todo');

if($con->connect_errno){
    echo "Failed".$con->connect_error;
    exit();
}
if(isset($_POST['signup'])){
    $email = $_POST['email'];
    $password = $_POST['password1'];
    try {
        $con->query("INSERT INTO user_account(EMAIL, PASSWORD) VALUES('$email', '$password')");
        $_SESSION['message'] = "Account Created Successfully try login..!!";
        header('location:login.php');
    } catch (\Throwable $th) {
        $_SESSION['message'] = "Email Already Exist";
        header('location:signup.php');
    }
}


if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $count=0;
    $taksNo = 0;
    // echo $email.$password;
    try {
        $result = $con->query("SELECT * FROM user_account WHERE EMAIL = '$email' AND PASSWORD = '$password'");
        while ($row = $result -> fetch_row()) {
            $count = $count +1;
        }
        if($count == 0){
            $_SESSION['message'] = "Email and Password Does not Match";
            header('location:login.php');
        }
        else{
            $_SESSION['message'] = "Welcome";
            $tasks = $con->query("SELECT * FROM tasks WHERE EMAIL ='$email'");
            while($row = $tasks->fetch_assoc()){
                $taksNo = $taksNo + 1;
            }
            $_SESSION['taskNo'] = $taksNo;
            header('location:tasks.php');
            $_SESSION['email'] = $email;
        }

        
    } catch (\Throwable $th) {
        echo $con->error;
    }
}

?>