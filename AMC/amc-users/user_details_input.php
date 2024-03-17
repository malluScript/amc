<?php
$company_id = $_POST["company_id"];
$selectedPlan = $_POST["selected_plan"];

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Details</title>
</head>
<body>
    <h2>User Details</h2>
    <form action="checkout.php" method="post">
        <!-- Add a hidden input field to carry over the selected plan -->
        <input type="hidden" name="selected_plan" value="<?php echo $_POST['selected_plan']; ?>">
        <input type="hidden" name="company_id" value="<?php echo $_POST['company_id']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="4" required></textarea><br><br>

        <!-- Continue Button for User Details -->
        <input type="submit" value="Continue to Order Summary">
    </form>
</body>
</html>
