<?php
session_start();
include_once 'mysql_connect.php';

// Check session is public or private session
if(isset($_SESSION['userSession'])){
    header("Location: index.php");
}

require ('header.php');

// Check if form is submitted
if(isset($_POST['submit'])){

    $username = $MySQLi_CON->real_escape_string(trim($_POST['username']));
    $password = $MySQLi_CON->real_escape_string(trim($_POST['password']));
    
    $query = $MySQLi_CON->query("SELECT * FROM user WHERE username='$username'");
    $row = $query->fetch_array();
    
    // If password match the database selected based on username
    if(password_verify($password, $row['password'])){    
        $_SESSION['userSession'] = $row['id'];        
        header("Location: user_profile.php");
    }	
    else{
        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; username or password does not exists !</div>";      
    }          
}
 
$MySQLi_CON->close();  
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="" method="post" class="form-horizontal" onsubmit="return checkForm(this);">

            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>LOGIN</strong>                  
                </h1>                 
                <hr>        
            </div>
            
                <?php 
                if(isset($msg)){         
                    echo $msg;   
                }         
                ?> 
            
            <div class="form-group">
                <label for="username" class="col-sm-2">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                </div>
            </div>
            
            <div class="form-group">
                <label for="password" class="col-sm-2">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                    <a href="forget_password.php" class="btn btn-info" style="float:right;">Forget Password</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>

