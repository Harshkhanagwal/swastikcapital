<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="res/colorbox.css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="res/jquery.colorbox-min.js"></script>
</head>

<body>
<?php


   $to = "monuchauhan2212@gmail.com";

        // Change this to your site admin email


        $from = "$_POST[email]";

        $subject = "Applied for DataEntry FROM $_POST[name] ";

        //Begin HTML Email Message where you need to change the activation URL inside


// Get all the values from input
    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $cno = $_POST['cno'];
	$Qualificaton = $_POST['Qualificaton'];
	$Profile = $_POST['Profile'];
	$Experience = $_POST['Experience'];

 // Now Generate a random string to be used as the boundary marker
   $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";

   // Now Store the file information to a variables for easier access
   $tmp_name = $_FILES['filename']['tmp_name'];
   $type = $_FILES['filename']['type'];
   $file_name = $_FILES['filename']['name'];
   $size = $_FILES['filename']['size'];



   // Now here we setting up the message of the mail
   $message = "

   \n\n Applied For DataEntry
   \n\n Name: $name 
   \n\n Email: $email_address 
   \n\n Qualificaton: $Qualificaton 
   \n\n Profile: $Profile 
   \n\n Experience: $Experience 
   \n\n Phone: $cno"; 


   // Check if the upload succeded, the file will exist
   if (file_exists($tmp_name)){

      // Check to make sure that it is an uploaded file and not a system file
      if(is_uploaded_file($tmp_name)){

         // Now Open the file for a binary read
         $file = fopen($tmp_name,'rb');

         // Now read the file content into a variable
         $data = fread($file,filesize($tmp_name));

         // close the file
         fclose($file);

         // Now we need to encode it and split it into acceptable length lines
         $data = chunk_split(base64_encode($data));
     }

      // Now we'll build the message headers
      $headers = "From: $from\r\n" .
         "MIME-Version: 1.0\r\n" .
         "Content-Type: multipart/mixed;\r\n" .
         " boundary=\"{$mime_boundary}\"";

      // Next, we'll build the message body note that we insert two dashes in front of the  MIME boundary when we use it
      $message = "This is a multi-part message in MIME format.\n\n" .
         "--{$mime_boundary}\n" .
         "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
         "Content-Transfer-Encoding: 7bit\n\n" .
         $message . "\n\n";

      // Now we'll insert a boundary to indicate we're starting the attachment we have to specify the content type, file name, and disposition as an attachment, then add the file content and set another boundary to indicate that the end of the file has been reached
      $message .= "--{$mime_boundary}\n" .
         "Content-Type: {$type};\n" .
         " name=\"{$file_name}\"\n" .
         //"Content-Disposition: attachment;\n" .
         //" filename=\"{$fileatt_name}\"\n" .
         "Content-Transfer-Encoding: base64\n\n" .
         $data . "\n\n" .
         "--{$mime_boundary}--\n";


      // Thats all.. Now we need to send this mail... :)
      if (@mail($to, $subject, $message, $headers))
      {
         ?>
    <div>
      <center>
     
        
<script type="text/javascript">
var id = window.location.href.split('/').pop()
if(1==1)
{  
$(document).ready(function(){
	setTimeout(function() {
		$.fn.colorbox({href:"res/homer.jpg" , open:true}); 
		$.colorbox({html:"<div><p>Your Data Has been submitted we will contact you soon !!</p></div>"});
	}, 0);
}); 
}
</script>  
//<?php
//header("Location: http://www.cserdtechnology.com/career.html");
//      ?>
      </center>
    </div>
    <?php
      }else
      {
         ?>
    <div>
      <center>
        <h1>Error !! Unable to send yor data..</h1>
        <script>

alert("Error !! Unable to send yor data..");

</script>
<?php
header("Location: http://www.cserdtechnology.com/career.html");
      ?>
      </center>
    </div>
    <?php
      }
   }

?>

 <!--<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <label>Name:</label>
  <input type="text" name="name"  value="<?php echo $_POST["name"]?>"/>
  <?php echo $nameErr?> <br />
  <br />
  <label>Email-ID:</label>
  <input type="text" name="email" value="<?php echo $_POST["email"]?>"/>
  <?php echo $emailErr?> <br />
  <br />
  <label>Phone No:</label>
  <input type="text" name="cno" value="<?php echo $_POST["cno"]?>"/>
  <?php echo $cnoErr?> <br />
  <br />

  <label for="tele">upload Resume</label>
  <input type="file" name="filename" id="tele"/>
  <?php echo $uploadresumeErr?> <br />
  <br />
  <input style="display:block; margin-left:35em;"type="submit" value="Submit"/>
</form>-->
</body>
</html>