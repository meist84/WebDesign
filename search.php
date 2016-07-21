<?php
include_once 'mysql_connect.php';

require ('header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3>Search Results</h3><br>
<?php
include_once 'mysql_connect.php';

if (isset($_GET['user_search'])){
    $user_search = $_GET['user_search'];


$query = "SELECT * FROM novel WHERE title LIKE '%" . $user_search . "%'";
$result = $MySQLi_CON->query($query);

if ($result->num_rows > 0) {
  
    while($novelRow = $result->fetch_assoc()) {
        $rlt = print 
                '<div class="col-xs-6 col-sm-4 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">'
                            . $novelRow["title"] . 
                '</div>
                    <div class="panel-body">
                        <img src="uploads/' . $novelRow["id"] . '.jpg" style="width:320px;height:380px;"><br><br>
                        <a href="'.$link.'">'. $novelRow["title"] .'</a><br>
                        '.$novelRow["description"].'
                    </div>
                    </div>
                    </div>';
     
    
        
    }  

    
    }
}

$MySQLi_CON->close();
?>
            
        </div>
    </div>
    <a href="novels.php" class="btn btn-success">Back to Novel Listing</a>
</div>

<?php
require ('footer.php');
?>