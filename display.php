<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OPERATIONS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <button class="btn btn-primary"><a href="Order.php" class="text-light">Add Order</a></button>
        <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">Food Item</th>
      <th scope="col">Quantity</th>
      <th scope="col">Comments</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  
    <?php

    $sql="Select * from entry_details";
    $result=mysqli_query($conn,$sql);
    if($result){
        while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $name=$row['name'];
            $email=$row['email'];
            $phone=$row['phone'];
            $food_item=$row['food_item'];
            $quantity=$row['quantity'];
            $comments=$row['comments'];
            echo '
            <tr>
            <th scope="row"> '.$id.' </th>
            <td> '.$name.' </td>
            <td> '.$email.' </td>
            <td> '.$phone.' </td>
            <td> '.$food_item.' </td>
            <td> '.$quantity.' </td>
            <td> '.$comments.' </td>
<td>
    <button class="btn btn-info"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>

    </button><button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
</td>
            ';
        
        }

    }
    ?>

  </tbody>
</table>
    </div>
</body>
</html>