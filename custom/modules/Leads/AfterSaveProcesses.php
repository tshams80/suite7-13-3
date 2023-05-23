<?php
require_once('config.php');

// Load necessary SuiteCRM files
require_once('include/SugarPHPMailer.php');


if (!defined('sugarEntry') || !sugarEntry) {
  die('Not A Valid Entry Point');
}

class AfterSaveProcesses
{


  public function sendEmail(&$bean, $event, $arguments)
  {
    // Example usage
    try {
      $to = 'tshams80@gmail.com';
      $subject = 'After Save Email for Lead';
      $body = 'Something about email is not right';
      $this->sendMail($to, $subject, $body);
      echo 'Email sent successfully!';
    } catch (Exception $e) {
      echo 'Error sending email: ' . $e->getMessage();
    }
  }



  // Load SuiteCRM configuration

  // Function to send email using system email account
  function sendMail($to, $subject, $body) {
    global $sugar_config;

    $mail = new SugarPHPMailer();
    $mail->setMailerForSystem();
    $mail->From = $sugar_config['email_from_address'];
    $mail->FromName = $sugar_config['email_from_name'];
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $body;

    if (!$mail->send()) {
      throw new Exception($mail->ErrorInfo);
    }
  }


}
