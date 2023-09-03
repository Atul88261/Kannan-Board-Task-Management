<?php
include('db.php');
if(isset($_POST['add'])){
$task_title = $_POST['task_title'];
$description = $_POST['task_description'];
$createQuery = "INSERT INTO tasks (task_title,task_description) ";
$createQuery.=" VALUES ('$task_title','$description')";
$createRun = mysqli_query($db,$createQuery);
if($createRun){
    echo "<script>window.location.href ='index.php';</script>";
}else{
    echo "database not added !";
}
}
?>