<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <title>Burial Records</title>
</head>

<body>
<?php
    // Initialize variables to hold selected values
    $selectedCemetery = "";
    $selectedSection = "";

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedCemetery = $_POST["cemetery"];
        $selectedSection = $_POST["section"];
    }

    // Replace with your database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "htdb";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select CemeteryName from your table
    $sql = "SELECT CemeteryName FROM cemeteries";

    $result = $conn->query($sql);
    ?>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/index.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../html/gravePurchases.html">Grave Purchases</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Manage Graves
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="../html/addGraveyard.html">Create Cemeteries</a>
            <a class="dropdown-item" href="../html/editGraveyard.html">Edit Cemeteries</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="card mx-auto mt-4" style="width: 85%">
    <div class="card-header" style="font-size: 2em">All Burial Records</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Full Name</th>
              <th scope="col">Region</th>
              <th scope="col">Town/City</th>
              <th scope="col">Section</th>
              <th scope="col">Grave Number</th>
              <th scope="col">Burial Date</th>
              <th scope="col">Date of Death</th>

            </tr>
          </thead>
          <tbody>
            <tr></tr>
          </tbody>
        </table>
      </div>
      <button type="button" class="btn btn-dark" id="addBurialRecord">Add Records</button>
    </div>
  </div>

  <div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Burial Records</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../php/burialRecords.php" method="post">

            <div class="form-group">
              <label for="exampleInputPassword1">Graveyard Name</label>
              <select class="custom-select" id="inputGroupSelect01">
                <option selected>Select Cemetery</option>
                <?php

                // Assuming you've already established a database connection ($conn)  

                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cemeteryName = $row['CemeteryName'];
                        // Output an <option> element for each CemeteryName
                        echo '<option value="' . $cemeteryName . '"';
                        if ($selectedCemetery == $cemeteryName) {
                            echo ' selected';
                        }
                        echo '>' . $cemeteryName . '</option>';
                    }
                } else {
                    echo "No cemeteries found in the database.";
                }
                ?>
  
            </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Graveyard Section</label>
              <select class="custom-select" id="inputGroupSelect02">
                <option selected>Select Section</option>
                <?php
            // Check if a CemeteryName is selected
          if (isset($_POST['cemetery'])) {
            // Get the selected CemeteryName from the form
            $selectedCemetery = $_POST['cemetery'];

            // Prepare and execute a query to fetch SectionCode values based on CemeteryName
            $sql = "SELECT s.SectionCode
                    FROM sections s
                    JOIN cemeteries c ON s.CemeteryID = c.CemeteryID
                    WHERE c.CemeteryName = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $selectedCemetery);
            $stmt->execute();
            $resultSections = $stmt->get_result();

            // Output options for the second select element
            while ($rowSection = $resultSections->fetch_assoc()) {
                $sectionCode = $rowSection['SectionCode'];
                echo '<option value="' . $sectionCode . '">' . $sectionCode . '</option>';
            }
            $stmt->close();
        }
        ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Grave Number</label>
              <select class="custom-select" id="inputGroupSelect03">
                <option selected>Select Grave Number</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Full Name of Buried Person</label>
              <input type="text" class="form-control" id="exampleInputFullName" placeholder="Full Name">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Date of Burial</label>
              <input type="text" class="form-control" id="exampleInputBurialDate" placeholder="Date of Burial">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Date of Death</label>
              <input type="text" class="form-control" id="exampleInputDeathDate" placeholder="Date of Death">
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Add Record</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <script src="../js/burialRecords.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>
