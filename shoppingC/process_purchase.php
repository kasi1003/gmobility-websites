<?php
// Assuming you have a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gmdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_item"])) {
    $productID = $_POST["product_id"];

    // Perform the deletion from the shopping_cart table
    $deleteSQL = "DELETE FROM shopping_cart WHERE product_id = '$productID'";

    if ($conn->query($deleteSQL) === TRUE) {
        // Redirect back to the sales.php page with a success message
        header("Location: sales.php?success=1");
        exit(); // Ensure no further processing occurs
    } else {
        // Redirect back to the sales.php page with an error message
        header("Location: sales.php?error=1");
        exit(); // Ensure no further processing occurs
    }
}

$conn->close();
?>