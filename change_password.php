<?php
session_start();
include_once 'mysql_connect.php';

// Check session is public or private session
if(!isset($_SESSION['userSession'])){
    header("Location: user_profile.php");
}

require ('header.php');

// Check if form is submitted
if (isset($_POST["submit"])){
    
    $password = $MySQLi_CON->real_escape_string(trim($_POST['password']));
    $new_password = $MySQLi_CON->real_escape_string(trim($_POST['pwd1']));
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $id = $_SESSION['userSession'];
    
    $query = $MySQLi_CON->query("SELECT * FROM user WHERE id='$id'");
    $row = $query->fetch_array();
    
    // Check if user input password is the same as the one in the database
    if(password_verify($password, $row['password'])){
          
        $result = $MySQLi_CON->query("UPDATE user SET password = '$new_password'WHERE id='$id'" );
            
        if($result){
            $msg = "<div class='alert alert-success'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Changed ! </div>";       
        }             
    } 
    else{              
        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while changed !</div>";  
    }   
}

$MySQLi_CON->close();
?>

<div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="change_password.php" method="post" onsubmit="return checkPass(this);">
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>Change Password</strong>                  
                </h1>                 
                <hr>        
            </div>
            
                <?php 
                if(isset($msg)){         
                    echo $msg;   
                }         
                ?> 
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Existing Password">
            </div>
            
            <div class="form-group">
                <label for="pwd1">New Password</label>
                <input type="password" name="pwd1" class="form-control" placeholder="New Password">
            </div>
            
            <div class="form-group">
                <label for="pwd2">Confirm New Password</label>
                <input type="password" name="pwd2" class="form-control" placeholder="New Password">
            </div>
            
            <button type="submit" name="submit" class="btn btn-success">Reset Password</button>
            <a href="user_profile.php" class="btn btn-info" style="float:right;">Back</a>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>