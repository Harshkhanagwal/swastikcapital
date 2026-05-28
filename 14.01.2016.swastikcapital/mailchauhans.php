<?php
require 'PHPMailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;

                $mail->isSMTP();                                      // Set mailer to use SMTP
                //$mail->SMTPDebug = 2; //
                $mail->Host = "smtpout.ipage.com";  // Specify main and backup server
                $mail->Port = 25;
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'mail@swastikcapital.in';                            // SMTP username
                $mail->Password = 'Shekhar@123';                           // SMTP password
                //$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
                $aa=$_POST["emailid"];
                $mail->From = $aa;
                $mail->FromName = 'Mailer';
                $mail->addAddress('info@swastikcapital.in', 'Some email');  // Add a recipient

                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'This Request has been:';
                $messageBody = "User Details :-<br>Name:- %s<br>Product:- %s<br>Phone number:- %s<br>Email address:- %s<br>City:-%s<br>Loan Amount:-%s<br>";
                $mail->Body    = sprintf($messageBody, $_POST["fullname"], $_POST["loan"], $_POST["mobile"], $_POST["emailid"],$_POST['city'],$_POST['loanamount']);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
               // header("location:index.html");
                if(!$mail->send()) {
                   echo '<h3>Your message has not been sent due to a website error. Please call us at xxx.</h3>';
                   echo 'Mailer Error: ' . $mail->ErrorInfo;
                   exit;
                }else {
					
					header("Location: http://www.swastikcapital.in/index.html?in");
				}

?>