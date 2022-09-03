<?php
    require_once('same_register_2.php');
?>
<?php
    $business_namephp = $business_addressphp = "";
    $business_namephpErr = $business_addressphpErr = "";
    $success_message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check local uniqueness
        $file2=fopen("../business_name.db","r");
        $find_business_name=false;
        while(!feof($file2))
        {
            $line2 = fgets($file2);
            $array2 = explode(",",$line2);
            if(trim($array2[0]) == $_POST["business_name"])
            {
                $find_business_name=true;
            }
        }
        fclose($file2);

        $file3=fopen("../business_address.db","r");
        $find_business_address=false;
        while(!feof($file3))
        {
            $line3 = fgets($file3);
            $array3 = explode(",",$line3);
            if(trim($array3[0]) == $_POST["business_address"])
            {
                $find_business_address=true;
            }
        }
        fclose($file3);

        if ($find_business_name == true) {
            echo "Already existed business name. Please register again.";
            echo "<br>";
        } 

        if ($find_business_address == true) {
            echo "Already existed business address. Please register again.";
            echo "<br>";
        } 
        
        else {
            
            // Display user's input
            echo "<h1> Registration Information </h1>";
            echo "Username:".$usernamephp;
            echo "<br>";
            echo "Password:".$passwordphp;
            echo "<br>";
            echo "Profile picture name:". basename($_FILES["image"]["name"]);
            echo "<br>";

            // Form validation
            if (empty($_POST["business_name"])) {
                $business_namephpErr = "Business name must not be empty";
            } else{
                $business_namephp = test_input($_POST["business_name"]);
                if (strlen($_POST["business_name"]) < 5) {
                    $business_namephpErr = "Business name must contain at least 5 characters";
                } 
                else {
                    echo "Business name:".$business_namephp;
                    echo "<br>";
                }
            }

            if (empty($_POST["business_address"])) {
                $business_addressphpErr = "Business address must not be empty";
            } else{
                $business_addressphp = test_input($_POST["business_address"]);
                if (strlen($_POST["business_address"]) < 5) {
                    $business_namephpErr = "Business address must contain at least 5 characters";
                } 
                else {
                    echo "Business address:".$business_addressphp;
                    echo "<br>";
                }
            }

            // File handling
            if ($finduser == false && $find_business_address == false && $find_business_name == false) {
                $file = fopen("../account.db", "a") or die("Unable to open file!");
                fputs($file,($usernamephp.";".$passwordphphash.";".basename($_FILES['image']['name']).";".$business_namephp.";".$business_addressphp.";"."no".";"."no".";"."no".";"."vendor"."\r\n"));
                fclose($file);
                    
                $file2 = fopen("../business_name.db", "a+");
                fputs($file2,($business_namephp."\r\n"));
                fclose($file2);

                $file3 = fopen("../business_address.db", "a+");
                fputs($file3,($business_addressphp."\r\n"));
                fclose($file3);
                $success_message ='Registered successfully!';
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
            <input type="submit" name= "act" class="btn" value= "Register now"> <br>
            <span class="message-success"><?php echo $success_message ?></span> <br>
        </div>
        <input type="hidden" name="vendor">
        <p> Already have an account? <a href= "login.php"> Login now </a> </p>
    </form>
</div>
</body>
</html>
