<?php
session_start();
include_once 'mysql_connect.php';

if(!isset($_SESSION['userSession'])){
    header("Location: login.php");  
}

require ('header.php');

$query = $MySQLi_CON->query("SELECT * FROM user WHERE id=".$_SESSION['userSession']);
$userRow = $query->fetch_array();
$MySQLi_CON->close();
?>

<h1 align="center">Welcome 
    <?php 
    echo $userRow['username']; 
    ?>
</h1><br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Name
            </div>
            <div class="panel-body">
                
                <?php 
                echo $userRow['nickname']; 
                ?>
                
            </div>
        </div><br>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                Email
            </div>
            <div class="panel-body">
                
                <?php 
                echo $userRow['email']; 
                ?>
                
            </div>
        </div><br>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                Account Type
            </div>
            <div class="panel-body">
                
                <?php 
                if ( $userRow['level'] == '1') {
                    echo 'Admin';                   
                }  
                else {
                 echo 'Normal User';                  
                }
                ?>
                
            </div>   
        </div><br>
     
        <div class="panel panel-primary">
            <div class="panel-heading">
                Description
            </div>
            <div class="panel-body">
                
                <?php 
                echo $userRow['description']; 
                ?>
                
            </div>
        </div><br>
        
        <div class="panel panel-primary">
            <div class="panel-heading">
                Your Account created since
            </div>
            <div class="panel-body">
                
                <?php 
                echo $userRow['created_since']; 
                ?>
               
            </div>
        </div>
    </div>
</div>

<?php
require ('footer.php');
?>