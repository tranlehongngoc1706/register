<?php
    $usernamephpErr = $passwordphpErr = $c_passwordphpErr = "";
    $usernamephp = $passwordphp = $passwordphphash = $c_passwordphp = $target_file = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check uniqueness
        $myfile = fopen("C:/fullstack/account.db","r");
        $finduser = false;
        while (!feof($myfile))
        {
            $line = fgets($myfile);
            $array = explode (",", $line);
            if (trim($array[0]) == $_POST["username"]) {
                $finduser = true;
                break;
            }
        }
        fclose($myfile);

        // Image upload
        if ($finduser == true) {
            echo "Already existed username. Please register again"."\n";
        }  else {
        $target_dir = "C:/fullstack/uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["act"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // upload file
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
        }

        // Form validation
        function test_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if (empty($_POST["username"])) {
            $usernamephpErr = "Username must not be empty";
        }
        else{
            $usernamephp = test_input($_POST['username']);
            if (!preg_match("/^[a-zA-Z0-9]+$/", $usernamephp)) {
                $usernamephpErr = "Username must contain only letters and digits";
            }
            elseif (strlen($_POST["username"]) < 8) {
                $usernamephpErr = "Username must contain at least 8 characters";
            }
            elseif (strlen($_POST["username"]) > 15) {
                $usernamephpErr = "Username must contain at most 15 characters";
            }
        }

        if (empty($_POST["password"])) {
            $passwordphpErr = "Password must not be empty";
        }
        else{
            $passwordphp = test_input($_POST["password"]);
            if (!preg_match("/[a-zA-z0-9]+[!|@|#|$|%|^|&|*]+$/", $passwordphp)) {
                $passwordErr = "Password must contain  must contain at least one upper case letter, at least one lower case letter, at least one digit, at least one special letter in the set !@#$%^&* and NO other kind of characters";
            }
            elseif (strlen($_POST["password"]) < 8) {
                $passwordErr = "Password must contain at least 8 characters";
            }
            elseif (strlen($_POST["password"]) > 20) {
                $passwordErr = "Password must contain at most 20 characters";
            }
            else {
                $passwordphphash = password_hash($passwordphp, PASSWORD_DEFAULT);
            }
        }

        if (empty($_POST["c_password"])) {
            $c_passwordphpErr = "Confirm password must not be empty";
        }
        else{
            $c_passwordphp = test_input($_POST["c_password"]);
            if ($passwordphpErr !== "") {
                $c_passwordphpErr = "Password must be valid";
            }
            elseif (($_POST["password"] !== $_POST["c_password"])){
                $c_passwordphpErr = "Passwords must match";
            }
        }


        // Display user's input
        echo "<h1> Registration Information </h1>";
        echo "Username:".$usernamephp;
        echo "<br>";
        echo "Password:".$passwordphp;
        echo "<br>";
        echo "Profile picture name:".$target_file;
        echo "<br>";
        }
    }
?>