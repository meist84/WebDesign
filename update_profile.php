<?php
session_start();
include_once 'mysql_connect.php';

if(!isset($_SESSION['userSession'])){
    header("Location: login.php");
}

require ('header.php');

if(isset($_POST['submit'])){
    $nickname = $MySQLi_CON->real_escape_string(trim($_POST['nickname']));
    $description = $MySQLi_CON->real_escape_string(trim($_POST['description']));
    
    $result = $MySQLi_CON->query("UPDATE user SET nickname = '$nickname', description = '$description' WHERE id='$check_level'" );
    
    if($result){            
        $msg = "<div class='alert alert-success'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Changed !</div>";   
    } 
    else{            
        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error while changed !</div>";   
    }
}
    
$MySQLi_CON->close();
?>

<div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="update_profile.php" method="post" onsubmit="return checkForm(this);">
            
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>UPDATE PROFILE</strong>                  
                </h1>                 
                <hr>        
            </div>
                        
                <?php       
                if(isset($msg)){               
                    echo $msg;                 
                }           
                ?>

            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" name="nickname" class="form-control" placeholder="Nickname">
            </div>
            
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" class="form-control"  pattern=".{1,99}" placeholder="Description" required>
            </div>
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="user_profile.php" class="btn btn-info" style="float:right;">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>