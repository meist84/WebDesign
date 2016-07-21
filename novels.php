<?php
session_start();
include_once 'mysql_connect.php';

require ('header.php');
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h3>Search Results</h3><br>
            
                <?php         
                $query = "SELECT * FROM novel";

                $result = $MySQLi_CON->query($query);


                if ($result->num_rows > 0) {
    
                    while($novelRow = $result->fetch_assoc()) {
            
            
                        $chk_id = $MySQLi_CON->query("SELECT id FROM novel WHERE title='".$novelRow["title"]."'");
            
                        $user_id = mysqli_fetch_assoc($chk_id);
            
                        $id = $user_id['id'];

            
                        $link = 'http://localhost/WebDesign/books.php?value=' . $id;
            
            
                        echo   
                
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
                else{    
                    echo 'No Result';           
                }
                $MySQLi_CON->close();
                ?>
            
        </div>
    </div>
</div>

<?php
require ('footer.php');
?>