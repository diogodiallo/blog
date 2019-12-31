<?php 

namespace Mailer;
require dirname( __DIR__, 2).'/vendor/autoload.php';
include 'credentialsGmail.php';

class Mailer
{
    public static  function sendMail($to, $username= '', $body, $subject = '', $token = '', $name = '')
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
        $message = new \Swift_Message();
        $headers = $message->getHeaders();
        $headers->addTextHeader('X-Mine', 'Mon blog pro');


        if (!empty(trim($username)) && !empty(trim($token))) {
            $message
                ->setTo([$to => $name])
                ->setSubject($subject)
                ->setFrom([GMAIL_USERNAME => USER_NAME])
                ->setBody($body, 'text/html');
        }
        
        $message
            ->setTo([GMAIL_USERNAME => USER_NAME])
            ->setSubject($subject)
            ->setFrom([$to => $name])
            ->setBody($body, 'text/html')
            ;

        // Send the message
        return  $mailer->send($message);
    }
}
