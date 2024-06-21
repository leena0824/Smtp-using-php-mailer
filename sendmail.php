<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submitContact'])) {

// Basic form validation
if(empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
    $_SESSION['status'] = "Please fill out all required fields.";
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit(0);
}
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

 // File upload
 $attachment = $_FILES['attachment']['tmp_name']; // Temporary file path
 $attachment_name = $_FILES['attachment']['name']; // Original file name
 $attachment_size = $_FILES['attachment']['size'];
 $attachment_type = $_FILES['attachment']['type'];

// Check if attachment exists and meets criteria
if(!empty($attachment)){
    // Check file size (10MB max)
    if($attachment_size > 10 * 1024 * 1024) {
        $_SESSION['status'] = "Attachment size exceeds the limit of 10MB.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit(0);
    }
    
    // Allowed file types
    $allowed_types = array("image/jpeg", "image/png", "application/pdf", "application/msword");
    if(!in_array($attachment_type, $allowed_types)) {
        $_SESSION['status'] = "Invalid attachment type. Allowed types: JPEG, PNG, PDF, DOC.";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit(0);
    }
}

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->Username   = 'shrutisuryawanshi343@gmail.com';       //SMTP username
        $mail->Password   = 'recfcqcosvljttno';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('shrutisuryawanshi343@gmail.com', 'SHRUTI');
        $mail->addAddress('shrutisuryawanshi343@gmail.com', 'SHRUTI');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'New enquiry regarding internship';
        $mail->Body    = '<h3>Hello, you got a new enquiry</h3>
        <h4>Fullname: '.$fullname.'</h4>
        <h4>Email: '.$email.'</h4>
        <h4>Subject: '.$subject.'</h4>
        <h4>Message: '.$message.'</h4>';


// Add attachment if provided
if(!empty($attachment)){
    if (!$mail->addAttachment($attachment, $attachment_name)) {
        $_SESSION['status'] = "Failed to attach file: " . $mail->ErrorInfo;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit(0);
    }
}

        if($mail->send()) {
            $_SESSION['status'] = "Thank you for contacting us regarding Internship";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        } else {
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    } catch (Exception $e) {
        // Handle exceptions here
    }
}
?>
