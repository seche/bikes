<?php
if(isset($_POST['g-recaptcha-response']))
          $captcha=$_POST['g-recaptcha-response'];
        
        
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=YOUR SECRET KEY&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == false)
        {
          echo '<h2>You are spammer ! Get the @$%K out</h2>';
        }
        else
        {
          echo '<h2>Thanks for posting comment.</h2>';
        }


// Check for empty fields
if(empty($_POST['name'])                   ||
   empty($_POST['email'])                  ||
   empty($_POST['phone'])                  ||
   empty($_POST['message'])                ||
   empty($_POST['g-recaptcha-response'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
     echo "No arguments Provided!";
     return false;
   }
   
$captcha = $_POST['g-recaptcha-response'];
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
   
$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeCnwcUAAAAAPsZi73syU8Wl2adv5FBTH00ue7C&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
if($response['success'] == false)
  {
    echo "No arguments Provided for captcha!";
    return false;
  }
// Create the email and send the message
$to = 'yourname@yourdomain.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";   
mail($to,$email_subject,$email_body,$headers);
return true;         
?>
