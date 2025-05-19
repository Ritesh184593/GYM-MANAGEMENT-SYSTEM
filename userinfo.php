<?php
session_start();
$_SESSION['test'] = "Session is working";
echo $_SESSION['test'];
?>

<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "saurabh";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch latest announcements
$sql = "SELECT title, message, created_at FROM announcements ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home</title>
    <link rel="stylesheet" href="style.css">
        <style>
        .announcement-box {
            margin-top: 40px;
            background: #f8f9fa;
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
        .announcement-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        .announcement-date {
            font-size: 12px;
            color: gray;
        }
        .announcement-message {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>



<div class='bx bx-menu' id="menu-icon"></div>

<ul class="navbar">
    <li> <a href="userhome.php">Home</a></li>
    <li> <a href=".php">Home</a></li>
    <li> <a href="#about">About Us</a></li>
    <li> <a href="logout.php">logout</a></li>
   
</ul>
    <h2>Welcome to Your Dashboard</h2>

    <h3>📢 Admin Announcements</h3>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='announcement-box'>";
            echo "<div class='announcement-title'>" . htmlspecialchars($row['title']) . "</div>";
            echo "<div class='announcement-date'>Posted on: " . $row['created_at'] . "</div>";
            echo "<p class='announcement-message'>" . htmlspecialchars($row['message']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No announcements available.</p>";
    }
    $conn->close();
    ?>
</body>
</html>

<a class="navbar-brand" href="index.php">Gym Management</a>
       
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav ms-auto">
              
           <li class="nav-item">
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileModal">Update Profile</button>
               </li>
               <li class="label">
                   <a class="nav-link" href="logout.php">Logout</a>
               </li>
           </ul>
       </div>
   </div>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container"></div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    .btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3); /* Gradient Blue */
    color: white;
    border: none;
    padding: 1rem 2.8rem;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
    display: inline-block;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
.model{
    padding-left: 10px;
}

.containers{
padding-top: 100px;
width: 100vw;  /* Full width of the viewport */
height: 100vh; /* Full height of the viewport */
background-color: rgb(243, 188, 106)
}
.lable{
font-size: 20px;
margin-top: 50px;
padding: 20px;

}
.block{font-size: 20px;
padding: 20px;

}
.block a{
    color: red;
}
.block h3{
    color: #080c11;
}
.lable h3{
    color: black;
}
.announcement-card { background:rgb(26, 210, 2); padding: 15px; border-radius: 10px; margin-bottom: 15px; }
.package-card { background:rgb(103, 82, 238); padding: 15px; border-radius: 10px;font-size: 20px; }
* {
    font-family: 'Poppins', sans-serif;
margin:0;
padding: 0;
box-sizing: border-box;
text-decoration: none;
list-style: none;
border: none;
outline: none;
scroll-behavior: smooth;


}

:root  {
--bg-color: #850707f0;
--snd-bg-color:#111;
--text-color:#fff;
--main-color:#45ffca;
--service:rgba(147, 211, 248, 0.995);
}


body {
background: var(--bg-color);
color:var(--text-color)   
}
/* Header Section code */
section {
min-height: 100vh;

width: 100%;
}
h2{
text-align: center;
font-size: 30px;
color: #111;
}
html{
font-size: 62.5%;
overflow-x:hidden;
}
header{
position: fixed;

width: 100%;
top:0;
right: 0;
z-index: 1000;
display: flex;
justify-content: space-between;
align-items: center;
padding: 2rem 9%;
background: rgba(0, 0, 0, 0.5);
backdrop-filter: blur(10px);
transition:all 0.5s ease;

}
.logo {
font-size: 3rem;
color: var(--text-color);
font-weight: 800;
cursor:pointer;
transition: 0.3s ease-in-out;
}

.logo:hover{
transform: scale(1.1);
}

span{
color: var(--main-color);

}
.navbar{
display:flex;
}

.navbar a{
font-size: 1.8rem;
font-weight: 500;
color:var(--text-color);
margin-left: 4rem;
transition:  all 0.5s ease;
border-bottom:3px solid transparent;
}
.navbar a:hover,
.navbar a.active{
color:var(--main-color);
border-bottom: 3px solid var(--main-color);
}
.nav-btn{
display: inline-block;
padding: 1rem 2.8rem;
background:transparent;
color:var(--main-color);
border: 2px solid var(--main-color);
border-radius: 1rem;
font-size:1.6rem;
font-weight:600;
transition: all 0.5s ease;
}

.nav-btn:hover{
background: var(--main-color);
color: var(--text-color);
box-shadow: 0 0 18px var(--main-color);
}
/* Update Profile Button */

.btn-primary {
    background: linear-gradient(135deg, #eb880f, #f47236); /* Gradient Blue */
    color: white;
    border: none;
    padding: 1rem 2.8rem;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    transition: 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
    display: inline-block;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
/* Hover Effect */



#menu-icon {
font-size: 3.6rem;
color:var(--main-color);
cursor: pointer;
}
/*update profile*/

/* Style the modal background */
.modal-content {
    text-align: center;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    padding: 20px;
}
.modal-title{
    margin-bottom: 0%;
}
/* Modal header styling */
.modal-header {
    text-align: center;
    background: #007bff;
    color: white;
  font-size: 30px;
  padding-top: 10px;
  padding-bottom: 10px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

/* Modal close button */
.modal-header .btn-close {
    background: white;
    border-radius: 50%;
    opacity: 1;
}

/* Form styling */
.modal-body {
    padding: 20px;
}

/* Input fields */
.modal-body .form-control {
    border: 2px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    transition: border-color 0.3s;
    width: 30%;
}

.modal-body .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Label styles */
.modal-body .form-label {
    font-weight: bold;
    color: #333;
    font-size: 20px;
}

/* Save Changes button */
.modal-body .btn-success {
    background: #28a745;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    width: 20%;
    border-radius: 5px;
    transition: background 0.3s;
}

.modal-body .btn-success:hover {
    background: #218838;
}

/* Responsive modal */
@media (max-width: 100%) {
    .modal-dialog {
        max-width: 100%;
    }
}


<?php
if (isset($_SESSION['selected_package'])) {
    unset($_SESSION['selected_package']); // Clear old selection
}

session_start();
include "includes/config.php"; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Debugging: Check what package ID is being retrieved
if (isset($_SESSION['selected_package'])) {
    unset($_SESSION['selected_package']); // Clear session cache
}
// Fetch user's selected package
$sql = "SELECT p.package_name, p.description, p.price 
        FROM user_packages up 
        JOIN packages p ON up.package_id= p.package_id
        WHERE up.user_id = ?
        ORDER BY up.id DESC LIMIT 1"; // Get the latest package

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$package = $result->fetch_assoc();
$stmt->close();

// Debugging: Check what package ID is being retrieved
error_log("Fetched package ID: " . ($package ? $package['package_name'] : "None"));
// Fetch the latest announcement
$sql_latest_announcement = "SELECT id, title, message, created_at FROM announcements ORDER BY created_at DESC LIMIT 1";
$result_latest_announcement = $conn->query($sql_latest_announcement);

$latest_announcement = null;
if ($result_latest_announcement->num_rows > 0) {
    $latest_announcement = $result_latest_announcement->fetch_assoc();
}

// Delete older announcements (keep only the latest one)
if ($latest_announcement) {
    $latest_id = $latest_announcement['id'];
    $sql_delete_old = "DELETE FROM announcements WHERE id != ?";
    $stmt = $conn->prepare($sql_delete_old);
    $stmt->bind_param("i", $latest_id);
    $stmt->execute();
    $stmt->close();
}


$userQuery = "SELECT username, dob, mobile, email FROM userinfo WHERE id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userResult = $stmt->get_result();
$user = $userResult->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home | Gym Management</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/userhome.css">

   
</head>
<body>

<!-- Navbar -->
<header>
        <a href="#home" class="logo">Powerhouse<span>Fitness</span></a>

        <div class='bx bx-menu' id="menu-icon"></div>

        <ul class="navbar">
            <li> <a href="index.php#home">Home</a></li>
            
            <li> <a href="index.php#plans">Pricing</a></li>
            <li><a href="logout.php">Logout</a></li>
           
            </ul>
            <div class="top-btn">
            <a href="#" class="nav-btn "  data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a>
        </div>
        
        


        
</header>


       

<section class="content">
<!-- Main Content -->
<div class="containers">
    <h2 class="text-center">Welcome to Your Dashboard</h2>

   <!-- Announcements Section -->
<div class="lable">
    <h3>📢 Latest Announcement</h3>
    <?php if ($latest_announcement): ?>
        <div class="announcement-card">
            <h5><?= htmlspecialchars($latest_announcement['title']); ?></h5>
            <p><?= htmlspecialchars($latest_announcement['message']); ?></p>
            <small class="text-muted">Posted on: <?= $latest_announcement['created_at']; ?></small>
        </div>
    <?php else: ?>
        <p>No announcements at the moment.</p>
    <?php endif; ?>
</div>


    <!-- User Package Section -->
    <div class="block">
        <h3><a>🎟 </a>Your Selected Package</h3>
        <?php if ($package): ?>
            <div class="package-card">
                <h5><?= htmlspecialchars($package['package_name']); ?></h5>
                <p><?= htmlspecialchars($package['description']); ?></p>
                <p><strong>Price:</strong> ₹<?= number_format($package['price'], 2); ?></p>
                <form action="change-package.php" method="POST">
                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                <button type="submit" class="btn-primary">Change Package</button>
            </form>            </div>
        <?php else: ?>
            <p>You have not selected a package yet.</p>
        <?php endif; ?>
    </div>
</div>
    </section>
<!-- Profile Update Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body">
                <form id="updateProfileForm">
                    <input type="hidden" name="id" value="<?= $user_id ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="<?= htmlspecialchars($user['dob']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="<?= htmlspecialchars($user['mobile']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password (optional)</label>
                         <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                     </div>

                    <div class="mb-3">
                       <label for="confirm_password" class="form-label">Confirm Password</label>
                          <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                 </div>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById("updateProfileForm").addEventListener("submit", function(event) {
    event.preventDefault();
    
    let username = document.getElementById("username").value.trim();
    let dob = document.getElementById("dob").value;
    let mobile = document.getElementById("mobile").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;
    let today = new Date();
    let birthDate = new Date(dob);
    let age = today.getFullYear() - birthDate.getFullYear();
    let errorMessage = "";

    // Validate Username
    if (username.length < 3) {
        errorMessage += "❌ Username must be at least 3 characters long.\n";
    }

    // Validate Date of Birth (User must be 18+)
    if (age < 18) {
        errorMessage += "❌ You must be at least 18 years old.\n";
    }

    // Validate Mobile Number (10 digits)
    if (!/^\d{10}$/.test(mobile)) {
        errorMessage += "❌ Mobile number must be exactly 10 digits.\n";
    }

    // Validate Email Format
    if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
        errorMessage += "❌ Please enter a valid email address.\n";
    }
    // Password validation
    if (password.length > 0 && password.length < 6) {
        errorMessage += "❌ Password must be at least 6 characters long.\n";
    }

    // Confirm password match
    if (password && password !== confirmPassword) {
        errorMessage += "❌ Passwords do not match.\n";
    }

    // Display error message if any
    if (errorMessage) {
        alert(errorMessage);
        return;
    }

    // If all validations pass, submit the form via AJAX
    let formData = new FormData(this);
    
    fetch("update-profile.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        window.location.reload();
    })
    .catch(error => console.error("Error:", error));
});
</script>



</body>
</html>


.modal-content {
    text-align: center;
    background: #ed65a2;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    padding: 20px;
}
.modal-title{
    margin-bottom: 0%;
}
/* Modal header styling */
.modal-header {
    text-align: center;
    background: #007bff;
    color: white;
  font-size: 30px;
  padding-top: 10px;
  padding-bottom: 10px;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
}

/* Modal close button */
.modal-header .btn-close {
    background: white;
    border-radius: 50%;
    opacity: 1;
}

/* Form styling */
.modal-body {
    padding: 20px;
}

/* Input fields */
.modal-body .form-control {
    border: 2px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    transition: border-color 0.3s;
    width: 30%;
}

.modal-body .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Label styles */
.modal-body .form-label {
    font-weight: bold;
    color: #333;
    font-size: 20px;
}

/* Save Changes button */
.modal-body .btn-success {
    background: #28a745;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    width: 20%;
    border-radius: 5px;
    transition: background 0.3s;
}

.modal-body .btn-success:hover {
    background: #218838;
}

/* Responsive modal */
@media (max-width: 100%) {
    .modal-dialog {
        max-width: 100%;
    }
}





.container {
  
  grid-template-columns: repeat(auto-fit, minmax(300px,auto));
  align-items: center;
 gap:0;
  margin-top: 4.1rem;
 display: grid;
 background:transparent;
 
}

 

/* Section Title */
h1 {
  font-size: 25px;
  color: #333;
  margin-bottom: 20px;
}


/* Package Cards */
.package {
  background: linear-gradient(135deg, #161855, #1a9ea4);

  padding: 50px;
  width: 300px; /* Ensures consistent width */
  border-radius: 12px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  text-align: center;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  /* Ensures packages stay in a row */
}

/* Hover Effect */
.package:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(36, 223, 240, 0.3);
}

/* Package Title */
.package h2 {
  font-size: 25px;
  margin-bottom: 10px;
}

/* Package Description */
.package p {
  font-size:20px;
  line-height: 1.6;
}

/* Price Styling */
.package strong {
  font-size:20px;
  display: block;
  margin-top: 15px;
}

/* Hide scrollbar but allow scrolling */
.plans::-webkit-scrollbar {
  display: none;
}

.select-btn {
  display: inline-block;
  background: #08f30b; /* Vibrant button color */
  color: #fff;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
  border: none;
  border-radius: 5px;
  transition: 0.3s ease;
  cursor: pointer;
  text-decoration: none;
}

.select-btn:hover {
  background: #3bdd0a; /* Slightly brighter orange */
  box-shadow: 0 0 20px rgba(47, 224, 248, 0.8), 
              0 0 40px rgba(2, 239, 216, 0.6), 
              0 0 60px rgba(28, 232, 161, 0.4); /* Stronger glow effect */
  transform: scale(1.05); /* Slight zoom effect */
}