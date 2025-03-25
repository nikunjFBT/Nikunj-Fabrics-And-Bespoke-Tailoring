<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "measurements";

// Create connection
$conn = new mysqli($servername, $username, $password, "", $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $customer_name = trim(htmlspecialchars($_POST['customer_name']));
    $mobile_no = trim(htmlspecialchars($_POST['mobile_no']));
    $height = (int)$_POST['height'];
    $shoulder_to_waist = (int)$_POST['shoulder_to_waist'];
    $shoulder_to_thumb = (int)$_POST['shoulder_to_thumb'];
    $shoulder_to_knee = (int)$_POST['shoulder_to_knee'];
    $shoulder = (int)$_POST['shoulder'];
    $cross_back = (int)$_POST['cross_back'];
    $sleeve = (int)$_POST['sleeve'];
    $armhole = (int)$_POST['armhole'];
    $around_arm = (int)$_POST['around_arm'];
    $wrist = (int)$_POST['wrist'];
    $neck = (int)$_POST['neck'];
    $chest = (int)$_POST['chest'];
    $waist = (int)$_POST['waist'];
    $hips = (int)$_POST['hips'];
    $outer_length = (int)$_POST['outer_length'];
    $inner_length = (int)$_POST['inner_length'];
    $thigh = (int)$_POST['thigh'];
    $knee = (int)$_POST['knee'];
    $shoe_size = (int)$_POST['shoe_size'];

    // Validate mobile number (10-15 digits)
    if (!preg_match("/^[0-9]{10,15}$/", $mobile_no)) {
        die("<script>alert('Invalid mobile number format.'); window.history.back();</script>");
    }

    // SQL Query
    $stmt = $conn->prepare("INSERT INTO customer_measurements 
        (customer_name, mobile_no, height, shoulder_to_waist, shoulder_to_thumb, shoulder_to_knee, shoulder, cross_back, sleeve, armhole, around_arm, wrist, neck, chest, waist, hips, outer_length, inner_length, thigh, knee, shoe_size) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssiiiiiiiiiiiiiiiiiii", 
        $customer_name, $mobile_no, $height, $shoulder_to_waist, $shoulder_to_thumb, 
        $shoulder_to_knee, $shoulder, $cross_back, $sleeve, $armhole, 
        $around_arm, $wrist, $neck, $chest, $waist, 
        $hips, $outer_length, $inner_length, $thigh, $knee, 
        $shoe_size);

    if ($stmt->execute()) {
        echo "<script>alert('Measurement data saved successfully!'); window.location.href='index.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>