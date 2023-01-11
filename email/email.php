<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__FILE__) . '/src/Exception.php';
require_once dirname(__FILE__) . '/src/PHPMailer.php';
require_once dirname(__FILE__) . '/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {

    $mail->CharSet ="UTF-8";                     
    $mail->SMTPDebug = 0;                        
    $mail->isSMTP();                             
    $mail->Host = 'smtp.gmail.com';             
    $mail->SMTPAuth = true;                     
    $mail->Username = 'autoauctionmanager@gmail.com';   
	$mail->Password = 'tmqnchdkunbdnoot';
    $mail->SMTPSecure = 'ssl';  
    $mail->Port = 465;    

    $mail->setFrom('autoauctionmanager@gmail.com', 'Auction Manager');
    $mail->addAddress($email, $receiver);  
    //$mail->addAddress('ellen@example.com'); 
    $mail->addReplyTo('autoauctionmanager@gmail.com', 'info');
    //$mail->addCC('cc@example.com');  
    //$mail->addBCC('bcc@example.com');    


    // $mail->addAttachment('../xy.zip');   
    // $mail->addAttachment('../thumb-1.jpg', 'new.jpg'); 

    //Content
    $mail->isHTML(true);                     
    $mail->Subject = $email_title;
    $mail->Body    = $content;
    $mail->AltBody = 'Your mail client does not support HTML';

    $mail->send();
    echo ': )';
} catch (Exception $e) {
    echo 'Email sent unsuccessfully: ', $mail->ErrorInfo;
}
?>
