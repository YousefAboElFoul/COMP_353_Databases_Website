<?php
// Include config file
require_once '../config.php';
 
// Define variables and initialize with empty values
$acv = $initial_amount = $contract_type = "";
$acv_err = $initial_amount_err = $contract_type_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_acv = trim($_POST["acv"]);
    if(empty($input_acv)){
        $acv_err = "Please enter a acv.";
    }/* elseif(!filter_var(trim($_POST["acv"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $acv_err = 'Please enter a valid acv.';
    }*/ else{
        $acv = $input_acv;
    }
    
    // Validate address address
    $input_initial_amount = trim($_POST["initial_amount"]);
    if(empty($input_initial_amount)){
        $initial_amount_err = 'Please enter an initial amount.';     
    } else{
        $initial_amount = $input_initial_amount;
    }
    
    // Validate salary
    $input_contract_type = trim($_POST["contract_type"]);
    if(empty($input_contract_type)){
        $contract_type_err = "Please enter the contract type amount.";     
    } elseif(!ctype_digit($input_contract_type)){
        $contract_type_err = 'Please enter a positive integer value.';
    } else{
        $contract_type = $input_contract_type;
    }
    
    // Check input errors before inserting in database
    if(empty($acv_err) && empty($initial_amount_err) && empty($contract_type_err)){
        // Prepare an update statement
        $sql = "UPDATE Contract SET acv=?, initial_amount=?, contract_type=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_acv, $param_initial_amount, $param_contract_type, $param_id);
            
            // Set parameters
            $param_acv = $acv;
            $param_initial_amount = $initial_amount;
            $param_contract_type = $contract_type;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: welcome.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM Contract WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $acv = $row["acv"];
                    $initial_amount = $row["initial_amount"];
                    $contract_type = $row["contract_type"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($conn);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($acv_err)) ? 'has-error' : ''; ?>">
                            <label>ACV</label>
                            <input type="text" name="acv" class="form-control" value="<?php echo $acv; ?>">
                            <span class="help-block"><?php echo $acv_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($initial_amount_err)) ? 'has-error' : ''; ?>">
                            <label>Initial Amount</label>
                            <textarea name="initial_amount" class="form-control"><?php echo $initial_amount; ?></textarea>
                            <span class="help-block"><?php echo $initial_amount_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($contract_type_err)) ? 'has-error' : ''; ?>">
                            <label>Contract Type</label>
                            <input type="text" name="contract_type" class="form-control" value="<?php echo $contract_type; ?>">
                            <span class="help-block"><?php echo $contract_type_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="welcome.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
