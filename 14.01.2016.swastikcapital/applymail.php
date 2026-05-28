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
                $mail->FromName ="Swastikmaler". $_POST['applicantname'];
                $mail->addAddress('sonukmr980@gmail.com', 'Some email');  // Add a recipient

                $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'This Request has been:';
                $messageBody = "Apply Loan Details :-<br>Loan Type:- %s<br>Annual Income:- %s<br>Annual Turnover:- %s<br>City:- %s<br>Loan Amount:-%s<br>Applicant Name:-%s<br>D.O.B:-%s<br>Pan No:-%s<br>Mobile No:-%s<br>Residence Address:-%s<br>Res Status Owned/Rented:-%s<br>Number of Years:-%s<br>Residence Phone No:-%s<br>Company Name:-%s<br>Office Address:-%s<br>Office Status Owned/Rented:-%s<br>Number of Years:-%s<br>Office Phone No:-%s<br>Email ID:-%s<br>Running OD/CC Limit and all Loan Details:-%s<br>";
               $mail->Body    = sprintf($messageBody, $_POST["loantype"], $_POST["annualincome"], $_POST["annualturnover"], $_POST["city"],$_POST['loanamount'],$_POST['applicantname'],$_POST['dob'],$_POST['panno'],$_POST['mobno'],$_POST['contact_message'],$_POST['res'],$_POST['noy'],$_POST['rpn'],$_POST['cmpnyname'],$_POST['officeadd'],$_POST['oso'],$_POST['numberyear'],$_POST['opn'],$_POST['emailid'],$_POST['rod']);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
              //  header("location:index.html");
                if(!$mail->send()) {
                   echo '<h3>Your message has not been sent due to a website error. Please call us at xxx.</h3>';
                   echo 'Mailer Error: ' . $mail->ErrorInfo;
                   exit;
                }

?>