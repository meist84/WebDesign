<?php
session_start();
include_once 'mysql_connect.php';

if(isset($_SESSION['userSession'])!=""){
    header("Location: index.php");
}

require ('header.php');

// Check if form is submitted
if(isset($_POST['submit'])) {
    
    $username = $MySQLi_CON->real_escape_string(trim($_POST['username']));
    $email = $MySQLi_CON->real_escape_string(trim($_POST['email']));
    $password = $MySQLi_CON->real_escape_string(trim($_POST['pwd1']));

    // Change password into encrypted password using hash
    $new_password = password_hash($password, PASSWORD_DEFAULT);

    $check_username = $MySQLi_CON->query("SELECT username FROM user WHERE username='$username'");                 
    $check_email = $MySQLi_CON->query("SELECT email FROM user WHERE email='$email'");	
    $count=$check_username->num_rows;             
    $count1=$check_email->num_rows;
    
    // Get the time registered by user
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $current_datetime = date("Y-m-d H:i:s");
	
    // Check if the username and email is available
    if($count==0 && $count1==0){
        
        $query = "INSERT INTO user(username,email,password,created_since) VALUES('$username','$email','$new_password','$current_datetime')";
		
        if($MySQLi_CON->query($query)){	        
            $msg = "<div class='alert alert-success'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !</div>";		
        }
        else {               
            $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !</div>";                      
        }                 
    }              
    else{                           
        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry username or email already taken !</div>";                                 
    }
}

$MySQLi_CON->close();
?>

<div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="sign_up.php" method="post" onsubmit="return checkForm(this);">
            
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>SIGN UP</strong>                  
                </h1>                 
                <hr>        
            </div>
            
                <?php 
                if(isset($msg)){         
                    echo $msg;   
                }         
                ?>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="text" name="email" class="form-control" placeholder="Email Address">
            </div>
            
            <div class="form-group">
                <label for="pwd1">Password</label>
                <input type="password" name="pwd1" class="form-control" placeholder="Password">
            </div>
            
            <div class="form-group">
                <label for="pwd2">Confirm Password</label>
                <input type="password" name="pwd2" class="form-control" placeholder="Password">
            </div>
            
            <button type="submit" name="submit" class="btn btn-success">Create Your Account</button>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>