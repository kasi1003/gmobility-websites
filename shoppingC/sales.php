<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gmdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product name and quantity from the form
    $productName = $_POST["product_name"];
    $quantity = $_POST["quantity"];
    $productPrice = $_POST["product_price"];

    // Calculate the total price
    $totalPrice = $productPrice * $quantity;

    // You should validate and sanitize user input here to prevent SQL injection.

    // Find the product_id based on the product name
    $findProductIDSQL = "SELECT product_id FROM products WHERE productName = '$productName'";
    $result = $conn->query($findProductIDSQL);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productID = $row["product_id"];

        // Insert the data into the shopping_cart table
        $insertSQL = "INSERT INTO shopping_cart (product_id, quantity, price) VALUES ('$productID', '$quantity', '$totalPrice')";

        if ($conn->query($insertSQL) === TRUE) {
            // Redirect to the same page to prevent form resubmission
            header("Location: sales.php");
            exit();
        } else {
            echo "Error: " . $insertSQL . "<br>" . $conn->error;
        }
    } else {
        echo "Product not found.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>GMobility-Service</title>
    <style>
        @font-face {
            font-family: 'Digital-7';
            src: url('fonts/digital-7 (mono italic).ttf') format('truetype');
        }

        @font-face {
            font-family: 'wlm';
            src: url('fonts/wlm_1f_block_sans.ttf') format('truetype');
        }
    </style>


    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">


    <link href="img/favicon.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar  -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="sales.html" class="navbar-brand p-0">
                <h1 class="m-0"><img class="w-100" src="img/logo.png" alt="logo" style="max-width: 60px"></i>GMIT</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="software.html" class="nav-item nav-link">Software Dev</a>
                    <a href="technical.html" class="nav-item nav-link">Technical</a>
                    <a href="sales.html" class="nav-item nav-link">Sales</a>
                    <a href="printing.html" class="nav-item nav-link">Printing</a>
                    <div class="cart-container">
                        <a class="nav-item nav-link">
                            <svg id="cart-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960"
                                width="24">
                                <path
                                    d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                            </svg>
                        </a>
                    </div>




                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal"
                    data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
            </div>
        </nav>
        <!-- Navbar End -->

        <div class="container-fluid bg-primary py-5 bg-header" style="margin-bottom: 90px;">
            <div class="row py-5">
                <div class="col-12 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white animated zoomIn">Sales</h1>
                    <a href="" class="h5 text-white">Home</a>
                    <i class="far fa-circle text-white px-2"></i>
                    <a href="" class="h5 text-white">Sales</a>

                </div>
            </div>
        </div>
    </div>



    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3"
                            placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Full Screen Search End -->


    <!-- Service Start -->
    <div class="list-group w-25 custom-list-group">
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">Cart</h5>
            </div>
            <?php
            // Display the cart items only when the request method is GET
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gmdb";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Assuming you have a connection to the database
                $cartItemsSQL = "SELECT cart_id, product_id, quantity, price FROM shopping_cart";
                $cartResult = $conn->query($cartItemsSQL);

                if ($cartResult->num_rows > 0) {
                    while ($cartRow = $cartResult->fetch_assoc()) {
                        $cartID = $cartRow["cart_id"];

                        $productID = $cartRow["product_id"];
                        $quantity = $cartRow["quantity"];
                        $price = $cartRow["price"];

                        // Use the product_id to query the products table and get productName
                        $productNameSQL = "SELECT productName FROM products WHERE product_id = '$productID'";
                        $productResult = $conn->query($productNameSQL);
                        if ($productResult->num_rows > 0) {
                            $productRow = $productResult->fetch_assoc();
                            $productName = $productRow["productName"];
                        } else {
                            $productName = "Product Not Found";
                        }

                        // Display the cart item details in the list group
                        echo '
                        <div class="list-group-item" data-cart-id="' . $cartID . '">
                <p class="mb-1">Product Name: <span class="cart-product-name">' . $productName . '</span></p>
                <p class="mb-1">Quantity: <span class="cart-quantity">' . $quantity . '</span></p>
                <p class="mb-1">Price: $<span class="cart-price">' . $price . '</span></p>
                <button class="btn btn-sm btn-danger delete-button" data-cart-id="' . $cartID . '">Delete</button>
                </div>
                ';
                    }
                } else {
                    echo "Your cart is empty.";
                }
            }
            ?>
        </a>
    </div>

    <div class="row row-cols-1 row-cols-md-3" style="display: flex; justify-content: center;">

        <?php
        // Display the list of products
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gmdb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT productName, productDescription, price, img FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageData = $row["img"];
                echo '
                <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card mt-3">
                    <img class="card-img-top" src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title">' . $row["productName"] . '</h5>
                        <p class="card-text">' . $row["productDescription"] . '</p>
                        <p class="card-text">Price: $' . $row["price"] . '</p> <!-- Add this line -->
                        <form action="sales.php" method="post">
                            <input type="hidden" name="product_name" value="' . $row["productName"] . '">
                            <label for="quantity">Quantity to Buy:</label>
                            <input type="number" id="quantity" name="quantity" min="0" value="0">
                            <input type="hidden" name="product_price" value="' . $row["price"] . '">
                            <input type="submit" class="btn btn-primary w-100 mt-4" value="Buy Now">
                        </form>
                    </div>
                </div>
            </div>
            ';
            }
        } else {
            echo "No products found.";
        }

        $conn->close();
        ?>
    </div>
    
    <script>
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('delete-button')) {
                // Get the cart_id associated with the clicked button
                var cartID = e.target.getAttribute('data-cart-id');

                // Send an AJAX request to a PHP script for deleting
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'deleteCartItem.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    // Check if the item was successfully deleted
                    if (xhr.status === 200) {
                        // Remove the deleted item from the list group
                        e.target.parentElement.remove();
                    }
                };
                xhr.send('cartID=' + cartID);
            }
        });
    </script>
    <!-- Service End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Get In Touch</h3>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0"> Fab House, Unit 10, 414 Independence Ave, Windhoek, Khomas Region,
                                    Namibia</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">info@gmobility.com.na</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+264 85 663 1980</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="#"><i
                                        class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i
                                        class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i
                                        class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square" href=""><i
                                        class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Quick Links</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="index.html"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="software.html"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Software Dev</a>
                                <a class="text-light mb-2" href="technical.html"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Technical</a>
                                <a class="text-light mb-2" href="sales.html"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Sales</a>
                                <a class="text-light mb-2" href="printing.html"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Printing</a>
                                <a class="text-light" href="#"><i
                                        class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
                        Powered by <a class="text-white border-bottom"> GMobility</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>