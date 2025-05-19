<?php
session_start();
include "config.php"; // Database connection

if (!isset($_SESSION["admin"])) {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];

    // Prevent deletion of admin accounts for security
    $check_admin_query = "SELECT * FROM admins WHERE id = ?";
    $stmt = $conn->prepare($check_admin_query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $admin_result = $stmt->get_result();

    if ($admin_result->num_rows > 0) {
        echo "<script>alert('❌ Cannot delete an admin account!'); window.location='members.php';</script>";
        exit();
    }

    // Delete user securely
    $delete_query = "DELETE FROM userinfo WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $user_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('✅ User deleted successfully!'); window.location='members.php';</script>";
    } else {
        echo "<script>alert('❌ Error deleting user!'); window.location='members.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
