
<?php
// Database connection settings
include "includes/config.php"; 
$username =$dob=$mobile= $email = $password = "";
$errors = array();
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user inputs
    $username = trim($_POST['username']);
    $dob = trim($_POST['dob']);
    $mobile =trim($_POST['mobile']);
    $email =trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    

    // Validate inputs (basic example)
      // Validate inputs
      if (empty($username)) {
        $errors[]= "Username is required.";
    }
    // Validate Date of Birth (Must be 18+)
    $dobTimestamp = strtotime($dob);
    $minAgeTimestamp = strtotime('-18 years'); // 18 years ago from today
    if (!$dobTimestamp || $dobTimestamp > $minAgeTimestamp) {
        $errors[] = "Error: You must be at least 18 years old.";
    }
     // Validate Mobile Number (Must be exactly 10 digits)
     if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $errors[] = "Error: Mobile number must be exactly 10 digits.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         $errors[]="Error:invalid email format";
    }
    if (strlen($password) < 6) {
         $errors[]="Error:Password must be at least 6 characters long";
    }
    if ($password !== $confirm_password) {
        $errors[] = "Error: Password and Confirm Password do not match.";
    }
    
      // Prepare and execute the SELECT statement to check if email exists
$emailCheckSql = "SELECT COUNT(*) as count FROM userinfo WHERE email = ?";
$emailStmt = $conn->prepare($emailCheckSql);
$emailStmt->bind_param("s", $email);
$emailStmt->execute();
$emailStmt->bind_result($emailCount);
$emailStmt->fetch();
$emailStmt->close();

// Prepare and execute the SELECT statement to check if mobile number exists
$mobileCheckSql = "SELECT COUNT(*) as count FROM userinfo WHERE mobile = ?";
$mobileStmt = $conn->prepare($mobileCheckSql);
$mobileStmt->bind_param("s", $mobile);
$mobileStmt->execute();
$mobileStmt->bind_result($mobileCount);
$mobileStmt->fetch();
$mobileStmt->close();

// Check if the email or mobile number already exists
if ($emailCount > 0) {
    $errors[] = "Error: The email address is already registered.<br>";
}

if ($mobileCount > 0) {
    $errors[] = "Error: The mobile number is already registered.<br>";
}

    
    // If no errors, proceed to insert into database
    if(empty($errors)){
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
   

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO userinfo (username,dob,mobile,email,password) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss",$username,$dob,$mobile, $email,$hashed_password);

    // Execute the statement
    if($stmt->execute()) {
        echo "<script>alert('Registration successful!');</script>";
        echo "<script> window.location.href='login.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    }
   
    $conn->close();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> 
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/register.css">
<title></title>
<style>
    
body {
    background:url(img/1.jpg) ;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-attachment: fixed;
  align-items: center;
}



.error-message {
            color: red;
           text-align: center;
           padding: 10px;
           
           }
           .button:hover{
    color: #fff;
    box-shadow: 0 0 12px #05fbd2;
}

</style>
</head>



<header>
<a href="#home" class="logo">Powerhouse<span>Fitness</span></a>

<div class='bx bx-menu' id="menu-icon"></div>
        <ul class="navbar">
            <li> <a href="index.php#home">Home</a></li>
            <li> <a href="#services">Services</a></li>
            <li> <a href="#about">About Us</a></li>
           
        </ul>
 </header>

 <!-- Display error messages if any -->
 
 <div class="container">

    <form name="registration" method="post" action="registration.php" autocomplete="off">
        <h2 class="heading">Registration</h2>
        
 <?php if (!empty($errors)): ?>
        <div class="error-messages">
            <?php foreach ($errors as $error): ?>
                <div class="error-message">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

        <label>UserName</label>
        <input type="text" name="username" class="input-control" id="username"  placeholder="Your full name" value="<?php echo htmlspecialchars($username); ?>" required>

        <label>Date of Birth</label>
        <input type="date" name="dob" class="input-control"  id="dob"  placeholder="Your date of birth" value="<?php echo htmlspecialchars($dob); ?>" required>

        <label>Mobile No.</label>
        <input type="text" name="mobile" class="input-control"  id="mobile"   placeholder="Your mobile number"  value="<?php echo htmlspecialchars($mobile); ?>" required>

        <label>Email</label>
        <input type="text" name="email" class="input-control"  id="email"   placeholder="Your Email"  value="<?php echo htmlspecialchars($email); ?>" required>

        <label> Password</label>
        <input type="password" name="password" id="password" placeholder="Password" id="password"  class="input-control" required>
        
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="input-control" required>

   <div>
   
  <input type="submit" id="submit" name="submit" class="button" value="Register now">
   </div>
  
</form>
</div>
<script>
document.getElementById("submit").addEventListener("click", function(event) {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("❌ Password and Confirm Password do not match!");
        event.preventDefault(); // Stop form submission
    }
});
</script>

</body>
</html>

