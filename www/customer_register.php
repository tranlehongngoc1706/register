<?php
    require_once('same_register_2.php');
?>
<?php
    $your_namephpErr= $your_addressphpErr = "";
    $your_namephp = $your_addressphp = "";
    $success_message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check local uniqueness
        $file2=fopen("../name.db","r");
        $find_name=false;
        while(!feof($file2))
        {
            $line2 = fgets($file2);
            $array2 = explode(",",$line2);
            if(trim($array2[0]) == $_POST["your_name"])
            {
                $find_name=true;
            }
        }
        fclose($file2);
        
        $file3=fopen("../address.db","r");
        $find_address=false;
        while(!feof($file3))
        {
            $line3 = fgets($file3);
            $array3 = explode(",",$line3);
            if(trim($array3[0]) == $_POST["your_address"])
            {
                $find_address=true;
            }
        }
            fclose($file3);
        
            if ($find_name == true) {
                echo "Already existed name. Please register again.";
                echo "<br>";
            } 
        
            if ($find_address == true) {
                echo "Already existed address. Please register again.";
            } 
                
            else {
                    
                // Display user's input
                echo "<h1> Registration Information </h1>";
                echo "Username:".$usernamephp;
                echo "<br>";
                echo "Password:".$passwordphp;
                echo "<br>";
                echo "Profile picture name:".$_FILES["image"]["name"];
                echo "<br>";
        
                // Form validation
                if (empty($_POST["your_name"])) {
                    $your_namephpErr = "Your name must not be empty";
                } else{
                    $your_namephp = test_input($_POST["your_name"]);
                    if (strlen($_POST["your_name"]) < 5) {
                        $your_namephpErr = "Your name must contain at least 5 characters";
                    } 
                    else {
                        echo "Your name:".$your_namephp;
                        echo "<br>";
                    }
                }
        
                if (empty($_POST["your_address"])) {
                    $your_addressphpErr = "Your address must not be empty";
                } else{
                    $your_addressphp = test_input($_POST["your_address"]);
                    if (strlen($_POST["your_address"]) < 5) {
                        $your_namephpErr = "Your address must contain at least 5 characters";
                    } 
                    else {
                        echo "Your address:".$your_addressphp;
                        echo "<br>";
                    }
                }
                    if ($finduser == false && $find_address == false && $find_name == false) {
                    // File handling
                    $file = fopen("../account.db", "a") or die("Unable to open file!");
                    fputs($file,($usernamephp.";".$passwordphphash.";".$_FILES['image']['name'].";"."no".";"."no".";".$your_namephp.";".$your_addressphp.";"."no".";"."customer"."\r\n"));
                    fclose($file);
                        
                    $file2 = fopen("C:/fullstack/name.db", "a+");
                    fputs($file2,($your_namephp."\r\n"));
                    fclose($file2);
        
                    $file3 = fopen("C:/fullstack/address.db", "a+");
                    fputs($file3,($your_addressphp."\r\n"));
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
            <input type="submit" name= "act" class="btn" value= "Register now"> <br>
            <span class="message-success"><?php echo $success_message ?></span> <br>
        </div>
        <input type="hidden" name="customer">
        <p> Already have an account? <a href= "login.php"> Login now </a> </p>
    </form>
</div>
</body>
</html>
