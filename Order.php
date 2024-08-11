<?php
include 'connect.php';
if(isset($_POST['submit']))
{
    $id=$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $food_item=$_POST['food_item'];
    $quantity=$_POST['quantity'];
    $comments=$_POST['comments'];
    $sql_query="INSERT INTO entry_details (id,name,email,phone,food_item,quantity,comments)
    VALUES ('$id','$name','$email','$phone','$food_item','$quantity','$comments')";
    if(mysqli_query($conn,$sql_query)){
        //echo "Data inserted successfully";
        header("Location: display.php");
    }
    else{
        echo "Error: ".mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Now - Flavor Dash</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
        }

        header img {
            height: 50px;
        }

        nav a:hover {
            background-color: #3498db;
            border-radius: 4px;
        }

        .s-bar input[type="text"] {
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #ecf0f1;
            color: #2c3e50;
            padding: 5px 10px;
        }

        .s-bar input[type="text"]::placeholder {
            color: #7f8c8d;
        }

        .s-bar button {
            background-color: #3498db;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
            padding: 5px 10px;
        }

        .s-bar button:hover {
            background-color: #2374d6b3;
        }

        .order-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: lightgray;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #2c3e50;
            color: white;
        }
    </style>
</head>
<body>

<header class="d-flex align-items-center justify-content-between p-3">
    <img src="logo.png" alt="Flavor Dash Logo">
    <h1 class="h4">Order Now</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Flavor Dash</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="Home.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="Menu.html">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Order</a></li>
                <li class="nav-item"><a class="nav-link" href="Feedbackpage.html">Feedback</a></li>
                <li class="nav-item"><a class="nav-link" href="About_us.html">About Us</a></li>
            </ul>
            <form class="form-inline my-2 my-lg-0 s-bar">
                <input class="form-control mr-sm-2" type="text" placeholder="Search...">
                <button class="btn my-2 my-sm-0" type="button" onclick="search()">Search</button>
            </form>
            
        </div>
    </div>
</nav>

<section class="container my-5">
    <div class="order-form">
        <h2>Place Your Order</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" class="form-control" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="food_item">Select Food Item:</label>
                <select class="form-control" id="food_item" name="food_item" required>
                    <option value="" disabled selected>Select an item</option>
                    <option value="Biryani">Biryani</option>
                    <option value="Burger">Burger</option>
                    <option value="Chowmein">Chowmein</option>
                    <option value="Pizza">Pizza</option>
                    <option value="Butter_Chicken">Butter Chicken</option>
                    <option value="Ice Shake">Ice Shake</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="form-group">
                <label for="comments">Additional Comments:</label>
                <textarea class="form-control" id="comments" name="comments" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" id="submitBtn" name="submit">Place Order</button>
        </form>
    </div>
</section>

<script>
    function search() {
        var searchTerm = document.querySelector('input[type="text"]').value;
        alert('You searched for: ' + searchTerm);
    }

    // Adding event listeners
    document.getElementById('name').addEventListener('input', validateName);
    document.getElementById('email').addEventListener('input', validateEmail);
    document.getElementById('phone').addEventListener('input', validatePhone);
    document.getElementById('quantity').addEventListener('input', validateQuantity);
    document.getElementById('submitBtn').addEventListener('click', submitForm);

    function validateName() {
        var nameInput = document.getElementById('name');
        var nameValue = nameInput.value.trim(); // Remove leading and trailing whitespaces

        if (nameValue === '') {
            nameInput.setCustomValidity('Name is required');
        } else {
            nameInput.setCustomValidity('');
        }
    }

    function validateEmail() {
        var emailInput = document.getElementById('email');
        var emailValue = emailInput.value.trim(); // Remove leading and trailing whitespaces

        if (emailValue === '') {
            emailInput.setCustomValidity('Email is required');
        } else {
            emailInput.setCustomValidity('');
        }
    }

    function validatePhone() {
        var phoneInput = document.getElementById('phone');
        var phoneValue = phoneInput.value.trim(); // Remove leading and trailing whitespaces

        if (phoneValue === '') {
            phoneInput.setCustomValidity('Phone number is required');
        } else {
            phoneInput.setCustomValidity('');
        }
    }

    function validateQuantity() {
        var quantityInput = document.getElementById('quantity');
        var quantityValue = parseInt(quantityInput.value); // Parse the quantity value as an integer

        if (isNaN(quantityValue) || quantityValue <= 0 || quantityValue % 1 !== 0) {
            quantityInput.setCustomValidity('Quantity must be a positive integer');
        } else {
            quantityInput.setCustomValidity('');
        }
    }

    function submitForm() {
        // Add logic to submit the form if all validations pass
        // For now, we'll just alert a message
        alert('Form submitted successfully!');
    }
</script>

<footer class="text-center py-3">
    <p>&copy; 2024 Food Ordering Web. All rights reserved.</p>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
