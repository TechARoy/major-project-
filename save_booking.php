<?php
$servername = "localhost";
$username = "root"; // XAMPP default
$password = "";     // XAMPP default
$dbname = "travel_book";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$dob = $_POST['dob'];
$travelDate = $_POST['travelDate'];
$returnDate = $_POST['returnDate'];
$numAdults = $_POST['adults'];
$numChildren = $_POST['children'];
$paymentMethod = $_POST['paymentMethod'];

// Insert into database
$sql = "INSERT INTO bookings (full_name, email, phone, address, dob, travel_date, return_date, num_adults, num_children, payment_method)
VALUES ('$fullName', '$email', '$phone', '$address', '$dob', '$travelDate', '$returnDate', '$numAdults', '$numChildren', '$paymentMethod')";


if ($conn->query($sql) === TRUE) {
    echo "✅ Booking saved successfully!";
} else {
    echo "❌ Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
