<?php

if(isset($_SESSION['userSession'])){ 
 
    // Take the current page URL                          
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";                        
    $check_level= "".$_SESSION['userSession'];

    // Fetching all from current user by following the id
    $query = $MySQLi_CON->query("SELECT * FROM user WHERE id='$check_level'");
    $row = $query->fetch_array();

    // If level == 2, it is a banned account, controlled by admin
    if ($row['level'] == '2'){     
        header("Location: banned.php");  
   }
}
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Coffee Novels</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/coffee-novels.css.css" rel="stylesheet">
    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Form Validation JavaScript -->
    <script src="js/validation.js"></script>

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>
    
    <div class="brand">COFFEE NOVELS</div>
    <div class="address-bar">WHERE THE BEST GOES ALONG  </div>
     
        <form  method="post" action="novels.php"  id="submit" align="center">      
            <input  type="text" name="submit"> 
            <input  type="submit" name="submit" value="Search">    
        </form> 
    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="novels.php">Novels</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>                   
                    
                        <?php                   
                        
                        // To check if user is public or private session
                        if(isset($_SESSION['userSession'])){  

                            echo '<li ><a href="user_profile.php" id="welcome">'.'My Profile'.'</a>'.'</li>'           
                                    .'<li><a href="log_out.php">Logout</a>'.'</li>';                       
                            
                            // Check the user level 1 = admin or normal user, only show link in page user_profile.php
                            if ($row['level'] == '1' and $actual_link == 'http://localhost/WebDesign/user_profile.php') {                                                   
                                echo '<br><li><a href="update_profile.php">Profile Setting</a>'.'</li>'                                                                         
                                        . '<li><a href="change_password.php">Password Setting</a>'.'</li>'              
                                        . '<li><a href="admin_page.php">Admin Setting</a>'.'</li>';                                       
                            }
                        
                            else if ($actual_link == 'http://localhost/WebDesign/user_profile.php') {                                       
                                echo '<br><li><a href="update_profile.php">Profile Setting</a>'.'</li>'                                                            
                                        . '<li><a href="change_password.php">Password Setting</a>'.'</li>';                                                        
                            }         
                            }                 
                            else{                  
                                echo '<li><a href="login.php">Login</a>'.'</li>'                                       
                                        . '<li><a href="sign_up.php">Register</a>'.'</li>';                                       
                            }        
                            ?>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    
