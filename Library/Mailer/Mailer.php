<?php 

namespace Mailer;
require dirname( __DIR__, 2).'/vendor/autoload.php';
include 'credentialsGmail.php';

class Mailer
{
    public static  function sendMail($to,  $name, $subject, $body)
    {
        $https['ssl']['verify_peer'] = FALSE;
        $https['ssl']['verify_peer_name'] = FALSE;

        // Create the Transport
        $transport = (new \Swift_SmtpTransport(GMAIL_HOST, GMAIL_PORT))
                        ->setUsername(GMAIL_USERNAME)
                        ->setPassword(GMAIL_PASSWORD)
                        ->setEncryption(GMAIL_ENCRYPTION)
        ;

        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        // Create a message
        $message = (new \Swift_Message('Blog de DD'))
                        ->setSubject($subject)
                        ->setFrom([$to => $name])
                        ->setTo([GMAIL_USERNAME => USER_NAME])
                        ->setBody($body, 'text/html')
        ;

        // Send the message
        $contact = $mailer->send($message);
        
    }
}
