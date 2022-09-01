<?php 
require_once('same_register_2.php')
?>
<?php
    $business_namephpErr = $business_addressphpErr = "";
    $business_namephp = $business_addressphp = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Form validation
        if ($finduser == true) {
            echo "";
        }  else { 
        $myfile2 = fopen("C:/fullstack/account.db","r");
        $finduser2 = false;
        while (!feof($myfile2))
        {
            $line2 = fgets($myfile2);
            $array2 = explode (",", $line2);
            if (trim($array2[3]) == $_POST["business_name"]) {
                $finduser2 = true;
                break;
            }
        }
        fclose($myfile2);

        if ($finduser2 == true) {
            echo "Already existed business name. Please register again"."\n";
        } else {
            if (empty($_POST["business_name"])) {
                $business_namephpErr = "Business name must not be empty";
            }
            else{
                $business_namephp = test_input($_POST["business_name"]);
                if (strlen($_POST["business_name"]) < 5) {
                    $business_namephpErr = "Business name must contain at least 5 characters";
                } 
                else {
                    echo "Business name:".$business_namephp;
                    echo "<br>";
                }
            }    
            $myfile3 = fopen("C:/fullstack/account.db","r");
            $finduser3 = false;
            while (!feof($myfile3))
            {
            $line3 = fgets($myfile3);
            $array3 = explode (",", $line3);
            if (trim($array3[4]) == $_POST["business_address"]) {
                $finduser3 = true;
                break;
            }
            }
            fclose($myfile3);

            if ($finduser3 == true) {
                echo "Already existed business address. Please register again"."\n";
            } else {
                if (empty($_POST["business_address"])) {
                    $business_addressphpErr = "Business address must not be empty";
                }
                else{
                    $business_addressphp = test_input($_POST["business_address"]);
                    if (strlen($_POST["business_address"]) < 5) {
                    $business_addressphpErr = "Business name must contain at least 5 characters";
                    }
                }

                // Display user's input
                echo "Business address:".$business_addressphp;

                // File handling
                $file = fopen("C:/fullstack/account.db", "a") or die("Unable to open file!");
                fwrite($file, "\n". $usernamephp.",".$passwordphphash.",".$target_file.",".$business_namephp.",".$business_addressphp);
                fclose($file);
                }
            }
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
                <label for="business_name">Your business name</label>
            </div>
            <div class="form_field">
                <input type="text" name="business_name" required class="box" id="business_name" onfocusout = "validateBusinessName()"/>
                <span><?php echo $business_namephpErr ?></span>
            </div>
        </div>

        <div class="form_row">
            <div class="form_label">
                <label for="business_address">Your business address</label>
            </div>
            <div class="form_field">
                <input type="text" name="business_address" required class="box" id="business_address" onfocusout = "validateBusinessAddress()"/>
                <span><?php echo $business_addressphpErr ?></span>
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
