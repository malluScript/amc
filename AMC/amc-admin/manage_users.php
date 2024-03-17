<?php
// Include your database connection file
include("conn.php");



// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // If the admin is not authenticated, redirect to the admin login page
    header("Location: admin_login.php"); // Change this to the admin login page URL
    exit;
}
?>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .content {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .content h2 {
            font-size: 24px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

        <div class="content">
            <h2>Manage Users</h2>

            <table>
                <tr>
                    <th>Company ID</th>
                    <th>Company Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Query the database to fetch user data
                $usersQuery = "SELECT company_id, company_name, email FROM amc_users";
                $usersResult = mysqli_query($conn, $usersQuery);

                if ($usersResult && mysqli_num_rows($usersResult) > 0) {
                    while ($row = mysqli_fetch_assoc($usersResult)) {
                        $companyID = $row['company_id'];
                        $companyName = $row['company_name'];
                        $email = $row['email'];
                ?>
                <tr>
                    <td><?php echo $companyID; ?></td>
                    <td><?php echo $companyName; ?></td>
                    <td><?php echo $email; ?></td>
                    <td>
                        <!-- Add action buttons for managing users, e.g., edit, delete -->
                        <a href="edit_user.php?company_id=<?php echo $companyID; ?>">Edit</a>
                        <a href="delete_user.php?company_id=<?php echo $companyID; ?>">Delete</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </table>
        </div>

