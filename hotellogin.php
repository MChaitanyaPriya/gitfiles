<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$conn = new mysqli("localhost","root","","booking");
if($conn->connect_error){
    die("Database connection failed: " . $conn->connect_error);
}
$message="";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $mail = trim($_POST['mail']);
    if(empty($username) || empty($password) || empty($mail)){
        $message = "All fields are required";
    } else {
        $sql = "SELECT * FROM user WHERE LOWER(username)=LOWER(?) AND LOWER(password)=(?) AND LOWER(mail)=LOWER(?) LIMIT 1";
        $stmt = $conn->prepare($sql);
        if($stmt){
            $stmt->bind_param("sss", $username, $password, $mail);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows >0){
                $user = $result->fetch_assoc();
                $message = "Login Successful!<br>Welcome, " . htmlspecialchars($user['username']);
            } else {
                $message = "Invalid login details";
            }
            $stmt->close();
        } else {
            $message = "SQL Prepare Error: " . $conn->error;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #077272;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .login-container input {
            width: 90%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container a {
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007bff;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .msg {
            background: white;
            color: black;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php if(!empty($message)) echo "<div class='msg'>$message</div>"; ?>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="mail" placeholder="E-mail" required>
        <button type="submit">Login</button>
    </form>
    <a href="#">Forgot Password?</a>
    <a href="hotel.html">Back to Home</a>
</div>

</body>
</html>