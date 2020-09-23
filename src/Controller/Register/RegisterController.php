<?php

namespace App\Controller\Register;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Services\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    protected $userRepository;
    protected $em;
    protected $passwordEncoder;
    protected $mailer;

    /**
     * UserController constructor.
     * @param $userRepository
     * @param $entityManager
     */
    public function __construct(UserRepository $userRepository,
                                EntityManagerInterface $entityManager,
                                UserPasswordEncoderInterface $passwordEncoder,
                                Mailer $mailer)
    {
        $this->userRepository = $userRepository;
        $this->em = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/register", name="register", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //$this->em = $this->getDoctrine()->getManager();
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $this->em->persist($user);
            $this->em->flush();

            $this->mailer->SendMail($this->render(
                'emails/myemail.html.twig', [
                    'user' => $user
                ]
            ));

            return $this->redirectToRoute('app_login');
        }

        return $this->render('register/register.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

}
