<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
<div class= "form-container">
    <form action="" method="post">
        <h3>Register </h3>
        <input type="button" value='Vendor' onClick = "location.href = 'vendor_register.php'" class= 'btn'>
        <input type="button" value='Customer' onClick = "location.href = 'customer_register.php'" class= 'btn'>
        <input type="button" value='Shipper' onClick = "location.href = 'shipper_register.php'" class= 'btn'>
        <p> Already have an account? <a href= "login.php"> Login now </a> </p>
    </form>
</body>
</html>