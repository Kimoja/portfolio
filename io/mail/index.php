<?php
$config = json_decode(file_get_contents('../../config.json')); 

if (
    empty($_POST['name']) ||
    !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
    empty($_POST['subject']) ||
    empty($_POST['message'])
) 
{
    echo "No arguments Provided!";
    exit(1);
}

$response = json_decode(file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret={$config->recaptchaPrivateKey}&response=" 
        . $_POST['g-recaptcha-response'] 
        . "&remoteip=".$_SERVER['REMOTE_ADDR']
));

if(!is_object($response) || !$response->success)
{
    die (
        "The reCAPTCHA wasn't entered correctly. Go back and try it again."
    );
}
else{
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email_address = strip_tags(htmlspecialchars($_POST['email']));
    $subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    // Create the email and send the message
    $to = 'carrilho_joakim@yahoo.fr'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "Website Contact Form:  $name";
    $email_body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nMessage:\n$message";
    $headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email_address";
    mail($to, $email_subject, $email_body, $headers);    
        
}