<?php
session_start();
include "config.php"; // Database connection

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['package_id'];
    $package_name = $_POST['package_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE packages SET package_name=?, description=?, price=? WHERE package_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $package_name, $description, $price, $package_id);
    $stmt->execute();
    $stmt->close();
}

// Fetch package details for editing
$package = null;
if (isset($_GET['package_id'])) {
    $package_id = $_GET['package_id'];
    $sql = "SELECT * FROM packages WHERE package_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $package_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $package = $result->fetch_assoc();
    $stmt->close();
}

// Fetch all packages for selection
$packages = [];
$sql = "SELECT package_id, package_name FROM packages";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $packages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Package</title>
    <link rel="stylesheet" href="css/package.css">
    <link rel="stylesheet" href="css/styless.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
<?php include "sidebar.php"; ?>
<!-- ===== Heading Section ===== -->
<div class="main-content">

<div class="heading">
    <h2>Update package</h2>
</div>
<div class="container">


    <!-- Package Selection Form -->
    <form method="get" class="package-selection">
        <label for="package_id">Select Package:</label>
        <select id="package_id" name="package_id" onchange="this.form.submit()">
            <option value="">Select a package</option>
            <?php foreach ($packages as $pkg): ?>
                <option value="<?php echo htmlspecialchars($pkg['package_id']); ?>" 
                        <?php if ($package && $package['package_id'] == $pkg['package_id']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($pkg['package_name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>

    <?php if ($package): ?>
        <!-- Package Update Form -->
        <form method="post" class="update-form">
            <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package['package_id']); ?>">

            <label for="package_name">Package Name:</label>
            <input type="text" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($package['description']); ?></textarea>

            <label for="price">Price ($):</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($package['price']); ?>" required>

            <label for="font_style">Font Style:</label>
            <select id="font_style" onchange="updatePreviewStyle()">
                <option value="'Poppins', sans-serif">Poppins</option>
                <option value="'Arial', sans-serif">Arial</option>
                <option value="'Courier New', monospace">Courier New</option>
                <option value="'Georgia', serif">Georgia</option>
            </select>

            <label for="font_size">Font Size:</label>
            <input type="range" id="font_size" min="12" max="30" value="16" oninput="updatePreviewStyle()">
              <!-- Delete Package Button -->
              <button type="button" class="delete-btn" onclick="confirmDelete(<?= $package['package_id']; ?>)">Delete Package</button>
           
            <button type="submit" name="update">Update Package</button>
            <button type="button" onclick="resetStyle()">Reset Style</button>
        </form>

        <!-- Live Preview Section -->
        <div class="preview" id="preview">
            <h2 id="preview_name"><?php echo htmlspecialchars($package['package_name']); ?></h2>
            <p id="preview_desc"><?php echo htmlspecialchars($package['description']); ?></p>
            <p><strong>Price: $<span id="preview_price"><?php echo htmlspecialchars($package['price']); ?></span></strong></p>
        </div>
    <?php endif; ?>
</div>
</div>
</div>
<script>
      function confirmDelete(packageId) {
        if (confirm("Are you sure you want to delete this package?")) {
            window.location.href = "delete-package.php?package_id=" + packageId;
        }
    }
    // Load stored settings
    document.addEventListener("DOMContentLoaded", function() {
        let fontStyle = localStorage.getItem("fontStyle") || "'Poppins', sans-serif";
        let fontSize = localStorage.getItem("fontSize") || "16px";

        document.getElementById("font_style").value = fontStyle;
        document.getElementById("font_size").value = parseInt(fontSize);

        let preview = document.getElementById("preview");
        preview.style.fontFamily = fontStyle;
        preview.style.fontSize = fontSize;
    });

    function updatePreviewStyle() {
        let fontStyle = document.getElementById("font_style").value;
        let fontSize = document.getElementById("font_size").value + "px";

        let preview = document.getElementById("preview");
        preview.style.fontFamily = fontStyle;
        preview.style.fontSize = fontSize;

        // Store values in localStorage
        localStorage.setItem("fontStyle", fontStyle);
        localStorage.setItem("fontSize", fontSize);
    }

    function resetStyle() {
        localStorage.removeItem("fontStyle");
        localStorage.removeItem("fontSize");
        document.getElementById("font_style").value = "'Poppins', sans-serif";
        document.getElementById("font_size").value = "16";
        updatePreviewStyle();
    }
</script>
<script src="script.js"></script>
</body>
</html>
