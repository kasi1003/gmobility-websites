<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">G-Mobility Admin Site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="../html/index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../php/productPage.php">Add/Edit Product</a>
                        </li>
                       
                    </ul>
                    
                    
                </div>
            </div>
        </div>
    </nav>
    <?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a marker exists in the session or a cookie to prevent resubmission
    if (!isset($_SESSION['form_submitted'])) {
        // Database connection details for inserting data
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gmdb";

        // Create a connection for inserting data
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection for inserting data
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form fields are set before extracting data
        if (isset($_POST['productName'], $_POST['productDescription'], $_POST['price'])) {
            // Extract data from the form
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];

            $category = $_POST['category'];
            $quantity = $_POST['quantity'];

            // Insert data into the products table
            $sql = "INSERT INTO products (productName, productDescription, price, category, quantity) VALUES ('$productName', '$productDescription', '$price', '$category', '$quantity')";

            if ($conn->query($sql) === TRUE) {
                // Insertion successful, set the marker
                $_SESSION['form_submitted'] = true;

                // Redirect to the same page to avoid resubmission
                header("Location: " . $_SERVER['REQUEST_URI']);
                exit(); // Terminate the script after the redirect
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection for inserting data
        $conn->close();
    }
}

// Rest of your PHP code for displaying the table data goes here
?>
    <div style="display: flex; justify-content: center; align-items: center; margin-top: 5em">

        <div class="card w-75">
            <div class="card-body">
                <h5 class="card-title">Products table</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th><!--column productName should display here-->
                                <th scope="col">Product Description</th><!--column productDescription should be displayed here-->
                                <th scope="col">Product Price</th><!--column price-->
                                <th scope="col">Category</th>
                                <th scope="col">In Stock</th>
                            </tr>
                        </thead>
                        <tbody id="cemeteriesTableBody">
                            <tr data-toggle="modal" data-target="#exampleModal" style="cursor: pointer"
                                data-cemetery-id="CemeteryID" data-region="Region" data-town="Town"
                                data-num-sections="NumberOfSections" data-total-graves="TotalGraves"
                                data-available-graves="AvailableGraves">
    <?php
    // Establish a database connection (Replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "gmdb";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Execute SQL query to retrieve data
    $sql = "SELECT productName, productDescription, price, category, quantity FROM products";
    $result = $conn->query($sql);
    $categorySql = "SELECT categoryName FROM categories";
    $categoryResult = $conn->query($categorySql);
    if ($result->num_rows > 0) {
        // Loop through query results and generate table rows
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['productName'] . '</td>';
            echo '<td>' . $row['productDescription'] . '</td>';
            echo '<td>' . $row['price'] . '</td>';
            echo '<td>'. $row['category'] . '</td>'; // Placeholder for Quantity (you can add this data if available)
            echo '<td>'. $row['quantity'] . '</td>'; // Placeholder for In Stock (you can add this data if available)

            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3">No products found</td></tr>';
    }

    // Close the database connection
    $conn->close();
    ?>


                            </tr>
                        </tbody>


                    </table>
                </div>
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">Add Product</button>


            </div>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product to Table</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../php/productPage.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Product Name</label>
                            <input type="text" name="productName" class="form-control" id="exampleInputName"
                                aria-describedby="productNameHelp" placeholder="Enter Product Name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputDescription" class="form-label">Product Description</label>
                            <input type="text" name="productDescription" class="form-control" id="exampleInputDesctiption"
                                aria-describedby="productDescriptionHelp" placeholder="Enter Product Description">
                        </div>
                        
                        <?php
                                $mysqli = new mysqli("localhost", "root", "", "gmdb");

                                // Check connection
                                if ($mysqli->connect_error) {
                                    die("Connection failed: " . $mysqli->connect_error);
                                }
                                $sql = "SELECT categoryName FROM categories";
                                $result = $mysqli->query($sql);

                                $categoryOptions = array();
                                while ($row = $result->fetch_assoc()) {
                                $categoryOptions[] = $row['categoryName'];
                                }
                                echo '<div class="mb-3">
                                        <label for="exampleInputCategory" class="form-label">Product Category</label>
                                        <select class="form-select" aria-label="Default select example" name="category">
                                        <option selected>Select Category</option>';
                                foreach ($categoryOptions as $category) {
                                echo '<option value="' . htmlspecialchars($category) . '">' . htmlspecialchars($category) . '</option>';
                                }
                                echo '</select>
                                </div>';


                                ?>
  
                        <div class="mb-3 form-check">
                                <label for="exampleInputQuantitiy" class="form-label">Quantity in Stock</label>
                                <input type="number" name="quantity" class="form-control" aria-label="quantityInStock">
                        </div>

                        <div class="mb-3 form-check">
                            <label for="exampleInputEmail1" class="form-label">Product Price</label>

                            <div class="input-group mb-3 w-100">
                                <span class="input-group-text">$</span>
                                <input type="number" name="price" step="0.01" min="0" max="1000" class="form-control" aria-label="Amount">

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="dismissModal()">Add New Product</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>



    <script src="../js/productPage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>



