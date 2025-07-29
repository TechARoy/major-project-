<?php
// ✅ Do NOT start session here — it's done in login.php

// Create database connection
$conn = mysqli_connect('localhost', 'root', '', 'project');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Error array to be used in login.php or register.php
$errors = array();
?>
