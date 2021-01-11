<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Welcome extends CI_Controller {

	public function __construct() { 
        parent::__construct(); 
        $this->load->helper('file');

                
        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
    }

    function index() 
    {
        
        echo $this->sendMail("setiawansatriani@gmail.com","xxxxxxxxxxx","setiawansatriani@gmail.com","setiawansatriani@gmail.com","akotes77@gmail.com","testing mail","testing mail body");
        
    }

    function sendMail($username,$password,$setFrom,$addReplyTo,$to,$subject,$body){
    // PHPMailer object
        $response = false;
        $mail = new PHPMailer();
                   
            
        // SMTP configuration
        $mail->isSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth   = true;
        $mail->Host       = 'smtp.gmail.com';   
        $mail->Username = $username; 
        $mail->Password = $password; 
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
                    
        $mail->setFrom($setFrom, ''); 
        $mail->addReplyTo($addReplyTo, '');

        $mail->addAddress($to); 
        $mail->Subject = $subject; 
        
        $mail->Body = $body;
            
        if(!$mail->send()){
                        $message = date('Y-m-d h:i:s').': Mailer Error: '. $mail->ErrorInfo ;
                        $this->writeFileLog($message);
        }else{
                        $message = date('Y-m-d h:i:s').': ['.$username.']'.' has just sent an email';
                        $this->writeFileLog($message);
        }

        return $message;
   }

    function writeFileLog($message){
        $file_path = APPPATH . "/cache/writeme.txt ";
        if(file_exists($file_path))
            {
                write_file($file_path, $message, 'a');
            }
        else
            {
                write_file($file_path, $message);
            }
   }

}

