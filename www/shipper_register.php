<?php 
require_once('same_register_2.php')
?>
<?php
    $distribution_hubphp = "";
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($finduser == true) {
            echo "";
        }  else {
        $distribution_hubphp = $_POST["distribution_hub"];
        // Display user's input
        echo "Distribution hub:".$distribution_hubphp;

        // File handling
        $file = fopen("C:/fullstack/account.db", "a") or die("Unable to open file!");
        fwrite($file, $usernamephp.",".$passwordphphash.",".$target_file.",".$distribution_hubphp."\n");
        fclose($file);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Register</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="register.js"> </script>
</head>
<body>
<div class= "form-container">
    <form action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="form" enctype= "multipart/form-data" novalidate>
        <?php
        require_once('same_register.php');
        ?>
        <div class="form_row">
            <div class="form_label">
                <label for="distribution_hub">Distribution hub</label>
            </div>
            <div class="form_field">
                <select name= "distribution_hub">
                    <option value="District_1"> District 1 </option>
                    <option value="District_4"> District 4 </option>
                    <option value="District_7"> District 7 </option>
                </select>
            </div>
        </div>
           
        <div class="form_row">
            <input type="submit" name= "act" class="btn" value= "Register now">
        </div>

        <p> Already have an account? <a href= "login.php"> Login now </a> </p>
    </form>
</div>
</body>
</html>
