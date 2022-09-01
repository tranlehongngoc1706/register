<?php 
require_once('same_register_2.php')
?>
<?php
    $your_namephpErr= $your_addressphpErr = "";
    $your_namephp = $your_addressphp = "";

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
            if (trim($array2[3]) == $_POST["your_name"]) {
                $finduser2 = true;
                break;
            }
        }
        fclose($myfile2);

        if ($finduser2 == true) {
            echo "Your name is similar to another one. Please register again"."\n";
        } else {
            if (empty($_POST["your_name"])) {
                $your_namephpErr = "Your name must not be empty";
            }
            else{
                $your_namephp = test_input($_POST["your_name"]);
                if (strlen($_POST["your_name"]) < 5) {
                    $your_namephpErr = "Your name must contain at least 5 characters";
                } 
                else {
                    echo "Your name:". $your_namephp;
                    echo "<br>";
                }
            }    
            $myfile3 = fopen("C:/fullstack/account.db","r");
            $finduser3 = false;
            while (!feof($myfile3))
            {
            $line3 = fgets($myfile3);
            $array3 = explode (",", $line3);
            if (trim($array3[4]) == $_POST["your_address"]) {
                $finduser3 = true;
                break;
            }
            }
            fclose($myfile3);

            if ($finduser3 == true) {
                echo "Your name is similar to another one. Please register again"."\n";
            } else {
                if (empty($_POST["your_address"])) {
                    $your_addressphpErr = "Your address must not be empty";
                }
                else{
                    $your_addressphp = test_input($_POST["your_address"]);
                    if (strlen($_POST["your_address"]) < 5) {
                    $your_addressphpErr = "Your name must contain at least 5 characters";
                    }
                }

                // Display user's input
                echo "Your address:".$your_addressphp;

                // File handling
                $file = fopen("C:/fullstack/account.db", "a") or die("Unable to open file!");
                fwrite($file, "\n". $usernamephp.",".$passwordphphash.",".$target_file.",".$your_namephp.",".$your_addressphp);
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
    <title>Customer Register</title>
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
                <label for="your_name">Your name</label>
            </div>
            <div class="form_field">
                <input type="text" name="your_name" required class="box" id="your_name" onfocusout = "validateYourName()"/>
                <span><?php echo $your_namephpErr ?></span>
            </div>
        </div>

        <div class="form_row">
            <div class="form_label">
                <label for="your_address">Your address</label>
            </div>
            <div class="form_field">
                <input type="text" name="your_address" required class="box" id="your_address" onfocusout = "validateYourAddress()"/>
                <span><?php echo $your_addressphpErr ?></span>
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
