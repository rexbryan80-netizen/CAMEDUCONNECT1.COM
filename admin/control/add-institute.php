<?php
require_once "../db.php"; // Adjust path depending on folder
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Institute</title>
</head>
<body>
    <h2>Add New Institute</h2>
    <form method="POST" action="">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Address:</label><br>
        <input type="text" name="address"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"><br><br>

        <input type="submit" name="submit" value="Add Institute">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Collect data
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Insert into database
        $stmt = $conn->prepare("INSERT INTO institutes (name, address, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $address, $email, $phone);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Institute added successfully!</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
    ?>
</body>
</html>
