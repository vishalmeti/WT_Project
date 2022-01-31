<?php
session_start();

    $con = new mysqli('localhost','root','','todo');
    if($con->connect_errno){
        echo "Failed".$con->connect_error;
        exit();
    }

    if(isset($_POST['addTask'])){
        $label = $_POST['name'];
        $due = $_POST['due'];
        $email = $_SESSION['email'];
        $today = date("Y-m-d");
        $taksNo = 0;

        try {
            $con->query("INSERT INTO tasks(EMAIL, LABEL, ADDED_ON, LAST_DATE) VALUES('$email','$label','$today','$due')");
            $_SESSION['message'] = "Task Added Successfully";
            $tasks = $con->query("SELECT * FROM tasks WHERE EMAIL ='$email'");
            while($row = $tasks->fetch_assoc()){
                $taksNo = $taksNo + 1;
            }
            $_SESSION['taskNo'] = $taksNo;
            header('location: tasks.php');

        } catch (\Throwable $th) {

            $_SESSION['message'] = "Failed to add Task";
            header('location: tasks.php');

        }

    }

    if(isset($_POST['done'])){
        $id = $_POST['ID'];
        try {
            
            $con->query("UPDATE tasks SET DONE = 1 WHERE id = $id");
            $_SESSION['message'] = "Task Marked Done";
            // echo $id;
            header('location: tasks.php');
        } catch (\Throwable $th) {
            echo $con->error;
        }
    }

    if(isset($_POST['delete'])){
        $taksNo = 0;
        $id = $_POST['ID'];
        try {
            
            $con->query("DELETE FROM tasks WHERE id = $id");
            $_SESSION['message'] = "Task Deleted Successfully";
            $tasks = $con->query("SELECT * FROM tasks WHERE EMAIL ='$email'");
            while($row = $tasks->fetch_assoc()){
                $taksNo = $taksNo + 1;
            }
            $_SESSION['taskNo'] = $taksNo;
            // echo $id;
            header('location: tasks.php');
        } catch (\Throwable $th) {
            echo $con->error;
        }
    }

    if(isset($_POST['update'])){
        $label = $_POST['name'];
        $due = $_POST['due'];
        $id = $_POST['ID'];
        $today = date('Y-m-d');
        try {
            $con->query("UPDATE tasks SET LABEL = '$label', LAST_DATE = '$due', UPDATED_ON = '$today' WHERE id = $id ");
            $_SESSION['message'] = "Task Updated Successfully";
            header('location: tasks.php');
        } catch (\Throwable $th) {
            echo $con->error;
        }
    }


?>