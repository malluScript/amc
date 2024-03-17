<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMC Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">AMC Dashboard</div>
            <ul class="nav-items">
                <li class="nav-item active"><a href="?section=overview">Home</a></li>
                <li class="nav-item"><a href="?section=contracts">Contracts</a></li>
                <li class="nav-item"><a href="?section=customers">Customers</a></li>
                <li class="nav-item"><a href="?section=reports">Reports</a></li>
                <li class="nav-item"><a href="?section=settings">Settings</a></li>
            </ul>
        </div>
        <div class="content">
            <?php
            // Check if a section is selected
            if (isset($_GET['section'])) {
                $section = $_GET['section'];

                // Load the corresponding section based on the parameter
                switch ($section) {
                    case 'overview':
                        include('overview.php');
                        break;
                    case 'contracts':
                        include('contracts.php');
                        break;
                    case 'customers':
                        include('customers.php');
                        break;
                    case 'reports':
                        include('reports.php');
                        break;
                    case 'settings':
                        include('settings.php');
                        break;
                    default:
                        echo 'Invalid section selected.';
                        break;
                }
            } else {
                // Load the default section (e.g., home or overview)
                include('overview.php');
            }
            ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
