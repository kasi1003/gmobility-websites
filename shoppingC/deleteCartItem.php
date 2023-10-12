<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartID = $_POST['cartID'];

    // Perform the necessary SQL query to delete the item from the "shopping_cart" table
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gmdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $deleteSQL = "DELETE FROM shopping_cart WHERE cart_id = '$cartID'";
    if ($conn->query($deleteSQL) === TRUE) {
        echo "Item deleted successfully";
    } else {
        echo "Error deleting item: " . $conn->error;
    }

    $conn->close();
}
?>