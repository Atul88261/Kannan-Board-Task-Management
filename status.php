<?php
include('db.php');

if(isset($_POST['doing']))
{
        // print_r($_POST);
    $doing = "doing";

    $updateQuery = "UPDATE tasks SET task_status='$doing'";

    $updateRun = mysqli_query($db,$updateQuery);
    if($updateRun){
        echo "<script>window.location.href ='index.php';</script>";
    }else{
        echo "Some error occured";
    }
}

if(isset($_POST['done']))
{
        // print_r($_POST);
    $done = "done";

    $updateQuery = "UPDATE tasks SET task_status='$done',task_completed=current_timestamp()";

    $updateRun = mysqli_query($db,$updateQuery);
    if($updateRun){
        echo "<script>window.location.href ='index.php';</script>";
    }else{
        echo "Some error occured";
    }
}

?>