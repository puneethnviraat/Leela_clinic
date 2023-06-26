<?php require("PHPMailer/PHPMailerAutoload.php");

//collect the posted variables into local variables before calling $mail = new mailer

$senderName = $_POST['contact-name'];
$senderPhone = $_POST['contact-phone'];
$senderEmail = $_POST['contact-email'];
$senderDate = $_POST['contact-date'];
$senderTime= $_POST['contact-time'];

//Create a new PHPMailer instance
$mail = new PHPMailer();
	$mail->SMTPDebug = 2;  
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.hostinger.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'admin@leelaclinic.com';                 // SMTP username
    $mail->Password = 'Admin@123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('admin@leelaclinic.com', $senderName);
    $mail->addAddress('leelaclinic19@gmail.com', 'Leela clinic');    // Add a recipient
    //$mail->addAddress('puneethnviraat@gmail.com');               // Name is optional
    $mail->addReplyTo($senderEmail, $senderName);


    //Attachments
    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New appointment from website';

//now make those variables the body of the emails
$message = '<html><body>';
$message .= '<table rules="all" style="border:1px solid #666;width:300px;" cellpadding="10">';
$message .= ($senderName) ? "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $senderName . "</td></tr>" : '';
$message .= ($senderEmail) ?"<tr><td><strong>Email:</strong> </td><td>" . $senderEmail . "</td></tr>" : '';
$message .= ($senderPhone) ?"<tr><td><strong>Phone:</strong> </td><td>" . $senderPhone . "</td></tr>" : '';
$message .= ($senderDate) ?"<tr><td><strong>Date:</strong> </td><td>" . $senderDate . "</td></tr>" : '';
$message .= ($senderTime) ?"<tr><td><strong>Time:</strong> </td><td>" . $senderTime . "</td></tr>" : '';

$message .= "</table>";
$message .= "</body></html>";

$mail->Body = $message;

// $mail->Body="
// Name:$senderName<br/>
// Email: $senderEmail<br/>
// Suburb: $senderSubject<br/>
// Message: $senderMessage";

if(!$mail->Send()) {
	echo '<div class="alert alert-danger" role="alert">Error: '. $mail->ErrorInfo.'</div>';
} else {
	echo '<div class="alert alert-success" role="alert">Thank you. We will contact you shortly.</div>';
}
?>