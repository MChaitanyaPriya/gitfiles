<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fileName=$_FILES['myfile']['name'];
    $tempName=$_FILES['myfile']['tmp_name'];
    $uploadFolder="uploads/";
    if(move_uploaded_file($tempName,$uploadFolder.$fileName)){
        echo "<p style='color:green;'>file uploaded successfully</p>";
        #downloading the file link
        echo "<a href='download.php?file=$fileName'><button>Download File</button></a>";
    }
    else{
        echo "<p style='color:red'>file not uploaded</p>";
    }






    $streetaddress = htmlspecialchars($_POST['streetaddress'] ?? '');
    $line = htmlspecialchars($_POST['line'] ?? '');
    $city = htmlspecialchars($_POST['city'] ?? '');
    $state = htmlspecialchars($_POST['state'] ?? '');
    $zip = htmlspecialchars($_POST['zip'] ?? '');
    $country = htmlspecialchars($_POST['country'] ?? '');

    if(empty($streetaddress) || empty($city) || empty($state) || empty($zip) || empty($country)) {
        $message = "Please fill in all required fields.";
    } else {
        $conn = new mysqli("localhost", "root", "", "booking");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO guests (streetaddress, line, city, state, zip, country) VALUES (?, ?, ?, ?, ?, ?)");
        if($stmt){
            $stmt->bind_param("ssssss", $streetaddress, $line, $city, $state, $zip, $country);
            if($stmt->execute()){
                $message = "✅ Registration Successful! Your details have been saved.";
            } else {
                $message = "❌ Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = "❌ Prepare failed: " . $conn->error;
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Reservation</title>
<style>
body { 
font-family: Arial, sans-serif;
 background: #f0f0f0; 
 }
.form { 
display: flex;
 max-width: 800px; 
 margin: 30px auto; 
 background: #fff;
  padding: 20px; 
  border-radius: 10px;
   box-shadow: 0 0 10px #aaa; 
}
.form img {
 width: 300px; 
 border-radius: 10px; 
 margin-right: 20px; 
 }
.form form { 
flex: 1; 
}
input, select { 
width: 100%;
padding: 8px;
margin: 5px 0 15px 0;
border-radius: 5px;
border: 1px solid #ccc;
}
button { 
padding: 10px 20px;
background: #007BFF;
color: #fff; 
border: none; 
border-radius: 5px; 
cursor: pointer; 
}
button:hover { 
background: #0056b3; 
}
p { 
font-weight: bold; 
}
</style>
</head>
<body>

<div class="form">
    <div>
        <img src="cofee.jpg" alt="sleeping">
    </div>
    <form action="register.php" method="post" enctype="multipart/form-data">
        <h1>Hotel Guest Registration Form</h1>
        <?php if($message) echo "<p>$message</p>"; ?>

        <label>Street Address:</label>
        <input type="text" name="streetaddress">
        <label>Street Address Line 2:</label>
        <input type="text" name="line">
        <label>City:</label>
        <input type="text" name="city">
        <label>State:</label>
        <select name="state">
            <option>Andhra Pradesh</option>
            <option>Arunachal Pradesh</option>
            <option>Bihar</option>
            <option>Chasithgardh</option>
            <option>Odisha</option>
        </select>
        <label>Zip Code:</label>
        <input type="number" name="zip">
        <label>Country:</label>
        <input type="text" name="country">
        <label>Upload Adhar proof</label>
        <input type="file" name="myfile"required>
        
        <button type="submit" name="submit">Submit</button>
    </form>
</div>

</body>
</html>