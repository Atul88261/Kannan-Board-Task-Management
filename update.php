<?php
include('db.php');
if(isset($_POST['update'])){
    // print_r($_POST);
$task_title = $_POST['task_title'];
$description = $_POST['task_description'];
$id = $_POST['id'];

$updateQuery = "UPDATE tasks SET task_title='$task_title',task_description='$description' WHERE id=$id";

$updateRun = mysqli_query($db,$updateQuery);
if($updateRun){
    echo "<script>window.location.href ='index.php';</script>";
}else{
    echo "database not updated !";
}
}
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

    $updateQuery = "UPDATE tasks SET task_status='$done'";

    $updateRun = mysqli_query($db,$updateQuery);
    if($updateRun){
        echo "<script>window.location.href ='index.php';</script>";
    }else{
        echo "Some error occured";
    }
}
?>