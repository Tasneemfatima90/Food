<?php
include 'connect.php';

$id = $_GET['updateid'];

// Fetch the existing data to populate the form
$query = "SELECT * FROM entry_details WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$food_item = $row['food_item'];
$quantity = $row['quantity'];
$comments = $row['comments'];

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $food_item = $_POST['food_item'];
    $quantity = $_POST['quantity'];
    $comments = $_POST['comments'];

    $sql_query = "UPDATE entry_details SET name=?, email=?, phone=?, food_item=?, quantity=?, comments=? WHERE id=?";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("sssissi", $name, $email, $phone, $food_item, $quantity, $comments, $id);

    if ($stmt->execute()) {
        header("Location: display.php");
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Now - Flavor Dash</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #2c3e50;
            padding: 10px 20px;
            color: white;
        }

        section {
            padding: 20px;
        }

        .order-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: lightgray;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, select, textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #16a085;
        }
    </style>
</head>
<body>

<header>
    <h1>Update Now</h1>
</header>

<section>
    <div class="order-form">
        <h2>Update Your Order</h2>
        <form action="" method="post">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" readonly required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>" required>

            <label for="food_item">Select Food Item:</label>
            <select id="food_item" name="food_item" required>
                <option value="" disabled>Select an item</option>
                <option value="Biryani" <?php echo ($food_item == 'Biryani') ? 'selected' : ''; ?>>Biryani</option>
                <option value="Burger" <?php echo ($food_item == 'Burger') ? 'selected' : ''; ?>>Burger</option>
                <option value="Chowmein" <?php echo ($food_item == 'Chowmein') ? 'selected' : ''; ?>>Chowmein</option>
                <option value="Pizza" <?php echo ($food_item == 'Pizza') ? 'selected' : ''; ?>>Pizza</option>
                <option value="Butter_Chicken" <?php echo ($food_item == 'Butter_Chicken') ? 'selected' : ''; ?>>Butter Chicken</option>
                <option value="Ice Shake" <?php echo ($food_item == 'Ice Shake') ? 'selected' : ''; ?>>Ice Shake</option>
            </select>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo $quantity; ?>" min="1" required>

            <label for="comments">Additional Comments:</label>
            <textarea id="comments" name="comments" rows="4"><?php echo $comments; ?></textarea><br>

            <input type="submit" id="submitBtn" name="submit" value="Update">
        </form>
    </div>
</section>

</body>
</html>
