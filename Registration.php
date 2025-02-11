<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect('localhost', 'root', 'root', 'cafeteria', 8889);

// Check database connection
if (!$conn) {
    die('Error: Database connection failed ' . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $User_Name = trim($_POST['User_Name']);
    $Email = trim($_POST['Email']);
    $Password = trim($_POST['Password']);

    // Ensure fields are not empty
    if (empty($User_Name)) {
        die("Error: Username is required!");
    }
    if (empty($Email)) {
        die("Error: Email is required!");
    }
    if (empty($Password)) {
        die("Error: Password is required!");
    }

    //  Check if the user already exists
    $sql_check = "SELECT userID FROM users WHERE email = '$Email' OR username = '$User_Name'";
    $result = mysqli_query($conn, $sql_check);

    if (!$result) {
        die("Error: Query failed" . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        die("Error: User already exists! Please use different credentials.");
    }

    // Hash the password before storing it
    $hashed_password = password_hash($Password, PASSWORD_DEFAULT);

    // Insert new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$User_Name', '$Email', '$hashed_password')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Registration successful!";
    } else {
        die("Error: Registration failed - " . mysqli_error($conn));
    }
}

//  Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
</head>
<body>
    <form action="Registration.php" method="POST">
        <input type="text" name="User_Name" placeholder="Enter your username:">
        <input type="email" name="Email" placeholder="Enter your email address:">
        <input type="password" name="Password" placeholder="Create a strong pasword:">
        <input type="submit" name="submit" value="Register">
    </form>
</body>
</html>
