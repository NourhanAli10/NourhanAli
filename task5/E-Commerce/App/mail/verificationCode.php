<?php
namespace App\mail;
use App\mail\mail;
use PHPMailer\PHPMailer\Exception;


class verificationCode extends mail{
    public function send() 
    {
        try{
            //Recipients
            $this->mail->setFrom('from@example.com', 'Mailer'); 
            $this->mail->addAddress ($this->mailTo);            
            $this->mail->isHTML(true);                              
            $this->mail->Subject = $this->subject;
            $this->mail->Body    = $this->body;

            $this->mail->send();
            // echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
           //echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
            return false;
        }
        
    }
}
