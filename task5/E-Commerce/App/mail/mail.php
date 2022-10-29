<?php

namespace App\mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;




abstract class mail{

private $mailHost ='smtp.mailtrap.io';
private $mailusername ='c0e9c254b685c9';
private $mailPasword='63846aab9b446e';
private $mailPort = 587;
private $mailEncryption='tls';
protected PHPMailer $mail;
protected $mailTo,$subject,$body;

public function __construct($mailTo,$subject,$body)
{

    $this->mailTo = $mailTo;
    $this->subject = $subject;
    $this->body = $body;

    $this->mail= new PHPMailer(true);

//Server settings
$this->mail->SMTPDebug = SMTP::DEBUG_OFF;                     
$this->mail->isSMTP();                                           
$this->mail->Host       = $this->mailHost;                 
$this->mail->SMTPAuth   = true;                                
$this->mail->Username   = $this->mailusername;                   
$this->mail->Password   = $this->mailPasword ;                  
$this->mail->SMTPSecure = $this->mailEncryption;            
$this->mail->Port       = $this->mailPort;                                    

}



public abstract function send();




}
