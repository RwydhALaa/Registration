<?php 

$conn = mysqli_connect('localhost','root','root','cafeteria',8889);

if (!$conn){
    echo 'Error: ' . mysqli_connect_error();
} 

$User_Name = $_POST ['User_Name'];
$Email = $_POST ['Email'];
$Password = $_POST ['Password'];

if (isset ($_POST ['submit'])){

$sql = "INSERT INTO users (username, email,password) VALUES ('$User_Name','$Email','$Password')";
    mysqli_query($conn, $sql);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title> Register page </title>
</head>
<body>
    
<form action="signup.php" method = "POST">
    <input type="text" name = "User_Name" id = "User_Name" placeholder="Enter Your Name:">
    <input type="text" name = "Email" id = "Email" placeholder="Enter Your Email:">
    <input type="text" name = "Password" id = "Password" placeholder="Enter Your Password:">
    <input type="submit" name="submit" value="send">

</form>
</body>
</html>
