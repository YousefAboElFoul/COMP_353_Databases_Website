<?php

session_start();
// Process delete operation after confirmation

    // Include config file
    require_once '../config.php';
	
    // Prepare a delete statement
    $sql = "DELETE FROM Contract WHERE id = ?";
	//$sql2 = "SELECT COUNT(*) FROM Contract" ;

    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $_GET["id"];
        
		if($param_id > "1")
		{
			  // Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt))
			{
            // Records deleted successfully. Redirect to landing page
				header("location: welcome.php");
            //exit();
			} else{		
				echo "Oops! Something went wrong. Please try again later.";
				echo $_GET["id"];
			}	
		}
		else
		{
			$count = mysqli_query($conn,$sql2);
			//echo $count;
			
			if($count > "1")
			{
				
			}
		}
    }
	 
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
?>
