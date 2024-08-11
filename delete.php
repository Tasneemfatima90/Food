<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];
    $sql="DELETE FROM entry_details WHERE id='$id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        //echo "Deleted Successfully";
        header('location:display.php');
}
else
{
    die(mysqli_error($conn));
}
}
?>
