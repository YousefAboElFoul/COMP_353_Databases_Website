<?php
// Include config file
require_once '../config.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $name = $phonenumber = $email = $postalcode = $province = $city = "";
$username_err = $password_err = $confirm_password_err = $name_err = $phonenumber_err = $email_err = $postalcode_err = $province_err = $city_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM account WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
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
        
        // Prepare an insert statement
        $sql = "INSERT INTO account (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
				$id = mysql_insert_id();
				$sql2 = "INSERT INTO client (name, phonenumber, email, city, province, postal_code, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt2 = mysqli_prepare($conn, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt2, "ssssssi", $param_name, $param_phonenumber, $param_email, $param_city, $param_province, $param_postal_code, $param_user_id);
            
            // Set parameters
			$param_name = $name;
			$param_phonenumber = $phonenumber; 
			$param_email = $email;
			$param_city = $_POST['city'];
			$param_province = $_POST['province'];
			$param_postal_code = $postal_code;
			$param_user_id = $id;
            
            // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt2)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
				}
			}
		}
	}
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Create Client Account</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name"class="form-control" value="<?php echo $name; ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($phonenumber_err)) ? 'has-error' : ''; ?>">
                <label>Phone Number</label>
                <input type="text" name="phonenumber"class="form-control" value="<?php echo $phonenumber; ?>">
                <span class="help-block"><?php echo $phonenumber_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email"class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group "<?php echo (!empty($province_err)) ? 'has-error' : ''; ?>">
				<label>Province</label>
            <select name="province" id="province">
			<option value="">Select Province</option>
	        <option value="AB">Alberta</option>
	        <option value="BC">British Columbia</option>
	        <option value="MB">Manitoba</option>
	        <option value="NB">New Brunswick</option>
	        <option value="ON">Ontario</option>
	        <option value="QC">Quebec</option>
        	<option value="SK">Saskatchewan</option>
            </select>
			<span class="help-block"><?php echo $province_err; ?></span>
            </div>
			
			<div class="form-group "<?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
				<label>City</label>		
			<select disabled="disabled" class="subcat" id="city" name="city">
        <option value>Select city</option>
        <!-- Alberta -->
        <optgroup data-rel="AB">
          <option value="Calgary">Calgary</option>
          <option value="Edmonton">Edmonton</option>
          <option value="Lethbridge">Lethbridge</option>
          <option value="Red Deer">Red Deer</option>
          <option value="St. Albert">St. Albert</option>
        </optgroup>
        <!-- British Columbia -->
        <optgroup data-rel="BC">
          <option value="Abbotsford">Abbotsford</option>
          <option value="Burnaby">Burnaby</option>
          <option value="Richmond">Richmond</option>
          <option value="Surrey">Surrey</option>
          <option value="Vancouver">Vancouver</option>
        </optgroup>
        <!-- Manitoba -->
        <optgroup data-rel="MB">
          <option value="Brandon">Brandon</option>
          <option value="Portage la Prairie">Portage la Prairie</option>
          <option value="Steinbach">Steinbach</option>
          <option value="Thompson">Thompson</option>
          <option value="Winnipeg">Winnipeg</option>
        </optgroup>
		 <!-- New Brunswick -->
        <optgroup data-rel="NB">
          <option value="Dieppe">Dieppe</option>
          <option value="Fredericton">Fredericton</option>
          <option value="Miramichi">Miramichi</option>
          <option value="Moncton">Moncton</option>
          <option value="Saint John">Saint John</option>
        </optgroup>
        <!-- Ontario -->
        <optgroup data-rel="ON">
          <option value="Brampton">Brampton</option>
          <option value="Hamilton">Hamilton</option>
          <option value="Mississauga">Mississauga</option>
          <option value="Ottawa">Ottawa</option>
          <option value="Toronto">Toronto</option>
        </optgroup>
		 <!-- Quebec -->
        <optgroup data-rel="QC">
          <option value="Gatineau">Gatineau</option>
          <option value="Laval">Laval</option>
          <option value="Longueuil">Longueuil</option>
          <option value="Québec">Québec</option>
          <option value="Montreal">Montreal</option>
        </optgroup>
      </select>

			<span class="help-block"><?php echo $city_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($postalcode_err)) ? 'has-error' : ''; ?>">
                <label>Postal Code</label>
                <input type="text" name="postalcode"class="form-control" value="<?php echo $postalcode; ?>">
                <span class="help-block"><?php echo $postalcode_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
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
        </form>
    </div>    
</body>


</html>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
 $(function() {

  var $cat = $("#province"),
    $subcat = $(".subcat");

  var optgroups = {};

  $subcat.each(function(i, v) {
    var $e = $(v);
    var _id = $e.attr("id");
    optgroups[_id] = {};
    $e.find("optgroup").each(function() {
      var _r = $(this).data("rel");
      $(this).find("option").addClass("is-dyn");
      optgroups[_id][_r] = $(this).html();
    });
  });
  $subcat.find("optgroup").remove();

  var _lastRel;
  $cat.on("change", function() {
    var _rel = $(this).val();
    if (_lastRel === _rel) return true;
    _lastRel = _rel;
    $subcat.find("option").attr("style", "");
    $subcat.val("");
    $subcat.find(".is-dyn").remove();
    if (!_rel) return $subcat.prop("disabled", true);
    $subcat.each(function() {
      var $el = $(this);
      var _id = $el.attr("id");
      $el.append(optgroups[_id][_rel]);
    });
    $subcat.prop("disabled", false);
  });

});
</script>
