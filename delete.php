<?php
include('db.php');
if(isset($_GET['delete'])){
    // print_r($_GET);
    $id = $_GET['delete'];
    $deleteQuery = "DELETE FROM tasks WHERE id=$id";
    $runQuery = mysqli_query($db,$deleteQuery);
    if($runQuery){
    echo "<script>window.location.href ='index.php';</script>";
        
    }else{
        echo "record not deleted";
    }
}
?>