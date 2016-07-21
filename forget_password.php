<?php
session_start();
include_once 'mysql_connect.php';

require ('header.php');

// Check if form is submitted
if (isset($_POST["submit"])){
    
    // Harvest submitted e-mail address	
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];	      
    }else {
        echo "email is not valid";
        exit;    
    }

    // Check to see if a user exists with this e-mail	
    //$query = 'SELECT email FROM user WHERE email = :email';	
    $check_email = $MySQLi_CON->query("SELECT email FROM user WHERE email='$email'");
    $chk_id = $MySQLi_CON->query("SELECT id FROM user WHERE email='".$email."'");
    $user_id = mysqli_fetch_assoc($chk_id);
    $id = $user_id['id'];
    $count1=$check_email->num_rows;
    //$query->bindParam(':email', $email);	
    //$query->execute();      
    //$userExists = $query->fetch(PDO::FETCH_ASSOC);
    
    // If user exists
    if ($count1==1) {
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'weirdteam7@gmail.com';   // SMTP username
        $mail->Password = 'thisisatest';            // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                          // TCP port to connect to

        $mail->setFrom('CoffeeNovel@cfn.com', 'NovelsRevolution');
        $mail->addReplyTo('Coffuire@cfn.com', 'NovelsRevolution');
        $mail->addAddress($email);   // Add a recipient
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //$mail->addAttachment('coffeerevo.PNG', 'new.PNG');
        
        // Add url with variable passing
        $link = 'http://localhost/WebDesign/resetpassword.php?value=' . $id  ;
        // Add image to send with email
        $mail->AddEmbeddedImage('coffeerevo.PNG',"my-attach", 'new.PNG');

        $mail->isHTML(true);                        // Set email format to HTML
        
        $bodyContent =  '<img src="cid:my-attach">';
        $bodyContent .= '<h1>Password Retrievel from CoffeeNovel</h1>'; 
        $bodyContent .= '<p>This is an auto generated message by <b>CoffeeNovel</b></p>';
        $bodyContent .= $link;

        $mail->Subject = 'CoffeeNovel Password Retrieval';
        $mail->Body    = $bodyContent;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;  
        } else {
            echo 'Message has been sent'; 
        }
    }	
    else		
        echo "No user with that e-mail address exists.";  
    }
?>

<div class="row">   
    <div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
        <form action="forget_password.php" method="post" onsubmit="return checkMail(this);">
            
            <div class="col-lg-12">                  
                <hr>               
                <h1 class="form-signin-heading text-center">                    
                    <strong>FORGET PASSWORD</strong>                  
                </h1>                 
                <hr>        
            </div>
            
                <?php 
                if(isset($msg)){         
                    echo $msg;   
                }         
                ?> 
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email Address">
            </div>

            <button type="submit" id="button" name="submit" class="btn btn-success">Submit Username</button>
        </form>
    </div>
</div>

<?php
require ('footer.php');
?>

