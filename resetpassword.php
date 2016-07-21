<?php
session_start();
include_once 'mysql_connect.php';

if(isset($_SESSION['userSession'])!=""){
    header("Location: user_profile.php");
}

require ('header.php');

// Get variable from URL link pass by variable
$get_id = $_GET['value'];

if(isset($_POST['submit'])) {
    
    $password = $MySQLi_CON->real_escape_string(trim($_POST['pwd1']));
    
    // Change password into encrypted password using hash
    $new_password = password_hash($password, PASSWORD_DEFAULT);
    
    $result = $MySQLi_CON->query("UPDATE user SET password = '$new_password' WHERE id='$get_id'" );     // Use the id pass by the URL to know which account password is changing

    if($result){          
        $msg = "<div class='alert alert-success'> <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Changed ! </div>";    
    }
        
    else{   
        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while changed !</div>";      
    }
    
}

$MySQLi_CON->close();
?>

<div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="<?php 'http://localhost/WebDesign/resetpassword.php?value=' . $get_id; ?>" method="post" onsubmit="return checkPass(this);">
            
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>RESET PASSWORD</strong>                  
                </h1>                 
                <hr>        
            </div>
            
                <?php 
                if(isset($msg)){         
                    echo $msg;   
                }         
                ?> 
            
            <div class="form-group">
                <label for="pwd1">Password</label>
                <input type="password" name="pwd1" class="form-control" placeholder="Password">
            </div>
            
            <div class="form-group">
                <label for="pwd2">Confirm Password</label>
                <input type="password" name="pwd2" class="form-control" placeholder="Password">
            </div>
            
            <button type="submit" name="submit" class="btn btn-success">Reset Password</button>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>