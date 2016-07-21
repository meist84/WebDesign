<?php
include_once 'mysql_connect.php';

require ('header.php');

$getid = $_GET['value'];

$query = "SELECT * FROM novel WHERE id=$getid";
$result = $MySQLi_CON->query($query);

if ($result->num_rows > 0) {
    if($novelRow = $result->fetch_assoc()) {
            echo'<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading">
                
            </div>
            
            <div class="panel-body" align ="center">
                 <img src="uploads/' . $novelRow["id"] . '.jpg" style="width:320px;height:380px;"><br><br>
                        <a href="'.$getid.'">'. $novelRow["title"] .'</a><br>
                        '.$novelRow["author"].'<br>
                        '.$novelRow["genre"].'<br>
                        '.$novelRow["releases"].'<br>
                        '.$novelRow["description"].'<br>
            </div>
        </div>
';
            
    }

}        
         
$MySQLi_CON->close();
?>