<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestMailController extends AbstractController
{
    /**
     * @Route("/test/mail", name="test_mail")
     */
    public function index(Request $request, \Swift_Mailer $mailer,
                          LoggerInterface $logger)
    {

        $message = new \Swift_Message('Test email');
        $message->setFrom('issou.jean.paul@gmail.com');
        $message->setTo('issou.jean.dupont@gmail.com');
        $message->setBody(
            $this->renderView(
                'emails/myemail.html.twig'
            ),
            'text/html'
        );

        $mailer->send($message);

        $logger->info('email sent');
        $this->addFlash('notice', 'Email sent');

        return $this->redirectToRoute('home');
    }
}