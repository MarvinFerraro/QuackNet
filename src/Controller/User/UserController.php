<?php

namespace App\Controller\User;

use App\Entity\Quack;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\QuackRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    protected $userRepository;
    protected $em;
    protected $quackRespository;
    private $session;

    /**
     * UserController constructor.
     * @param $userRepository
     * @param $entityManager
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, QuackRepository $quackRepository, SessionInterface $session)
    {
        $this->usersRepository = $userRepository;
        $this->em = $entityManager;
        $this->quackRespository = $quackRepository;
        $this->session = $session;
    }

        /**
         * @Route("/", name="user_index", methods={"GET"})
         */
        public function index(): Response
        {
            return $this->render('user/index.html.twig', [
                'user' => $this->userRepository->findAll(),
            ]);
        }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/show", name="user_show", methods={"GET"})
     */
    public function show(): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/quacksuser", name="quacksUser_show", methods={"GET"})
     */
    public function showAllQuacks(): Response
    {
        return $this->render('user/showAllQuacks.html.twig', [
            'quacks' => $this->getUser()->getQuacks(),
        ]);
}


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->em = $this->getDoctrine()->getManager();
            $this->em->remove($user);
            $this->em->flush();
        }

        return $this->redirectToRoute('users_index');
    }
}
