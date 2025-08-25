<?php
session_start();              // ✅ Start session ONLY here
include('server.php');        // ✅ DB connection ($conn)

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) $errors[] = "Username is required";
    if (empty($password)) $errors[] = "Password is required";

    if (count($errors) === 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            header('Location: mainpage.html');
            exit();
        } else {
            $errors[] = "Wrong username/password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="post" action="">
        <label>Username</label>
        <input type="text" name="username" required><br>
        <label>Password</label>
        <input type="password" name="password" required><br>
        <button type="submit" name="login_user">Login</button>
        <?php if (!empty($errors)) {
            foreach ($errors as $error) echo "<p style='color:red;'>$error</p>";
        } ?>
    </form>
</body>
</html>
