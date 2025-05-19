<?php
session_start();
include "config.php"; // Database connection

// Check if the admin is logged in
if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit();
}

// Get the user_id from the URL
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
if (!$user_id) {
    die("User ID is required.");
}

// SQL query to get booking history for the specific user
$sql = "SELECT booking_id, table_number, booking_date, status FROM bookings WHERE user_id = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History | Gym Management</title>
    <link rel="stylesheet" href="css/styless.css">
</head>
<body>

<?php include "sidebar.php"; ?>

<div class="main-content">
    <div class="container">
        <h2>Booking History for User ID: <?= htmlspecialchars($user_id); ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Table Number</th>
                    <th>Booking Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['booking_id']); ?></td>
                        <td><?= htmlspecialchars($row['table_number']); ?></td>
                        <td><?= htmlspecialchars($row['booking_date']); ?></td>
                        <td><?= htmlspecialchars($row['status']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
