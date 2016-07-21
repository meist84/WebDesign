<?php
session_start();
include_once 'mysql_connect.php';

if(!isset($_SESSION['userSession'])){
    header("Location: login.php");
    
}

require ('header.php');
$sql = "SELECT id, username, level FROM user";
$result = $MySQLi_CON->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         echo '<div class="col-xs-6 col-sm-4 col-md-4">

                            <div class="panel-body" >
                        "ID: " '. $row["id"] .'</a><br>
                        "Name: "'.$row["username"].'<br>
                        "LEVEL: "'.$row["level"].' <br>
                        </div>
                        </div>
                        </div>';
         //echo "id: " . $row["id"]. " - Name: " . $row["username"]. " " . $row["level"]. "<br>";
    }
} else {
    echo "0 results";
}

if(isset($_POST['submit'])){
    $id = $MySQLi_CON->real_escape_string(trim($_POST['id']));
    $level = $MySQLi_CON->real_escape_string(trim($_POST['level']));
    
    $result = $MySQLi_CON->query("UPDATE user SET level = '$level' WHERE id='$id'" );
    
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
        <form action="admin_page.php" method="post" onsubmit="return checkForm(this);">
            
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>ADMIN SETTING</strong>                  
                </h1>                 
                <hr>        
            </div>
                        
                <?php       
                if(isset($msg)){               
                    echo $msg;                 
                }           
                ?>

            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" name="id" class="form-control" placeholder="id">
            </div>
            
            <div class="form-group">
                <label for="description">LEVEL</label>
                <input type="text" name="level" class="form-control"  placeholder="level" >
            </div>
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a href="admin_page.php" class="btn btn-info" style="float:right;">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>