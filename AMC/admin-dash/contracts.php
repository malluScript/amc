<html>
    <head>
    <style>
    /* Style for the Customers section */
    .section#customers {
        padding: 20px;
    }

    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    /* Style for table headers */
    th {
        background-color: #007BFF;
        color: white;
        font-weight: bold;
        padding: 10px;
        text-align: left;
    }

    /* Style for alternating rows */
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Style for table cells */
    td {
        padding: 10px;
    }

    /* Hover effect for rows */
    tr:hover {
        background-color: #007BFF;
        color: white;
    }
</style>

    </head>
    <body>



<div class="section" id="contracts">
    <h2>Contracts</h2>
    <!-- Add your contracts content here -->
</div>
<div class="section" id="contracts">
    <h2>Contracts</h2>

    <?php
    // Establish a database connection (replace with your credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve contract data from the database
    $sql = "SELECT * FROM contracts"; // Replace 'contracts' with your actual table name
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Contract ID</th><th>Customer</th><th>Start Date</th><th>End Date</th><th>	
        Selected Plan</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["contract_id"] . "</td>"; // Replace with your column names
            echo "<td>" . $row["customer"] . "</td>"; // Replace with your column names
            echo "<td>" . $row["start_date"] . "</td>"; // Replace with your column names
            echo "<td>" . $row["end_date"] . "</td>"; // Replace with your column names
            echo "<td>" . $row["selected_plan"] . "</td>"; // Replace with your column names
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No contracts found.";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>
</body>

</html>