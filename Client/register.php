<?php
// Include config file
session_start();
require_once '../config.php';

// Define variables and initialize with empty values
$username = $name=$email=$phone_number=$postal_code=$province=$city=$password = $confirm_password = "";
$username_err =$name_err=$email_err=$phone_number_err=$postal_code_err=$province_err=$city_err=$password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement

        $sql = "SELECT id FROM Account WHERE username = ?";

        if($stmt = mysqli_prepare($conn, $sql)) {
            //echo "working 0";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }


    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter a username.";
    } else {
        $name = trim($_POST["name"]);
    }
	/*
	// Validate name
    if(empty(trim($_POST["phone_number"]))){
        $phone_number_err = "Please enter a phone number.";
    } else {
        $phone_number = trim($_POST["phone_number"]);
    }
	//Validate email
	 if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }
	//Vladiate City
	 if(empty(trim($_POST["city"]))){
        $city_err = "Please choose a city.";
    } else {
        $city = trim($_POST["city"]);
    }
	//Vladiate Province
	 if(empty(trim($_POST["province"]))){
        $province_err = "Please choose a provine.";
    } else {
        $province = trim($_POST["province"]);
    }
	//Vladiate Postal_code
	 if(empty(trim($_POST["postal_code"]))){
        $postal_code_err = "Please enter a postal code.";
    } else {
        $postal_code = trim($_POST["postal_code"]);
    }*/
	
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        echo "no errors";
        $type=5;
        // Prepare an insert statement
        $sql = "INSERT INTO Account (username, password, account_type) 
		VALUES (?, ?, 5)";

        if($stmt = mysqli_prepare($conn, $sql)){
           echo "working1";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set paramesters
            $param_username = $username;
            //$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_password = $password;
           // $param3 = 3;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                echo "working V";
                $sql = "SELECT * FROM Account WHERE username = ?";
                if($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "s", $param1);
                    $param1 = $username;
                    if(mysqli_stmt_execute($stmt)) {
                        //echo "Working z";
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) == 1){
                            $row =  mysqli_fetch_assoc($result);
                            $user_id = $row['id'];
                            $sql = "INSERT INTO Client(name,phone_number,email,city,province,postal_code,user_id) VALUES(?,?,?,?,?,?,?,)";
                            if($stmt = mysqli_prepare($conn, $sql)){
                                //echo "working2";
                                mysqli_stmt_bind_param($stmt, "sisssss", $param1, $param2, $param3, $param4, $param5, $param6 ,$param7);
                                $param1 = $name;
								$param2 = $phone_number;
								$param3 = $email;
								$param4 = $city;
								$param5 = $province;
								$param6 = $postal_code;
                                $param7 = $user_id;
								
                                if(mysqli_stmt_execute($stmt)){
                                    header("location: login.php");
                                }
                            }
                        }
                    }
                }
            }

            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 450; padding: 20px; margin auto;}
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Sign Up</h2>
    <p>Please fill this form to create an account.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>

        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <label>Name</label>
            <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
            <span class="help-block"><?php echo $name_err; ?></span>
        </div>
		
        <div class="form-group <?php echo (!empty($phone_number_err)) ? 'has-error' : ''; ?>">
            <label>Phone-Number</label>
            <input type="text" name="name"class="form-control" value="<?php echo $phone_number; ?>">
            <span class="help-block"><?php echo $phone_number_err; ?></span>
        </div>
		
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>email</label>
            <input type="text" name="name"class="form-control" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
		
        <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
            <label>City</label>
            <input type="text" name="name"class="form-control" value="<?php echo $city; ?>">
            <span class="help-block"><?php echo $city_err; ?></span>
        </div>
		
		<div class="form-group <?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
            <label>Province</label>
            <input type="text" name="name"class="form-control" value="<?php echo $province; ?>">
            <span class="help-block"><?php echo $province_err; ?></span>
        </div>
		<div class="form-group <?php echo (!empty($postal_code_err)) ? 'has-error' : ''; ?>">
            <label>Postal Code</label>
            <input type="text" name="name"class="form-control" value="<?php echo $postal_code; ?>">
            <span class="help-block"><?php echo $postal_code_err; ?></span>
        </div>
		

        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
            <span class="help-block"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <input type="reset" class="btn btn-default" value="Reset">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</div>
</body>
</html>