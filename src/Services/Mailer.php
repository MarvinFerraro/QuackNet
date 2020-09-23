<?php

namespace App\Services;

class Mailer
{
    private $mailer;

    public function __construct(\Swift_Mailer  $mailer)
    {
        $this->mailer= $mailer;
    }

    public function SendMail($body)
    {

        $message = new \Swift_Message('Test email');
        $message->setFrom('issou.jean.paul@gmail.com');
        $message->setTo('issou.jean.dupont@gmail.com');
        $message->setBody($body,
            'text/html');

        $this->mailer->send($message);

        return $this;
    }
}