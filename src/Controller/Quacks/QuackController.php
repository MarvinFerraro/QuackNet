<?php

namespace App\Controller\Quacks;

use App\Entity\Quack;
use App\Entity\User;
use App\Form\QuackType;
use App\Repository\QuackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quack")
 */
class QuackController extends AbstractController
{

    protected $quackRepository;
    protected $em;
    private $session;

    public function __construct(QuackRepository $quackRepository, EntityManagerInterface $em, SessionInterface $session)
    {
        $this->quackRepository = $quackRepository;
        $this->em = $em;
        $this->session = $session;
    }

    /**
     * @Route("/", name="quack_index", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('quack/index.html.twig', [
            'quacks' => $this->quackRepository->findAll(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new", name="quack_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quack = new Quack();
        $form = $this->createForm(QuackType::class, $quack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $quack->setUser($this->getUser());

            $this->em->persist($quack);
            $this->em->flush();

            return $this->redirectToRoute('quack_index');
        }

        return $this->render('quack/new.html.twig', [
            'quack' => $quack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quack_show", methods={"GET"})
     */
    public function show(Quack $quack): Response
    {
        return $this->render('quack/show.html.twig', [
            'quack' => $quack,
        ]);
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}/edit", name="quack_edit", methods={"GET","POST"})
     *
     */
    public function edit(Request $request, Quack $quack): Response
    {
        $quackChoose = $this->quackRepository->find($quack)->getUser();
        $user = $this->getUser();

        if ($quackChoose == $user)
        {
            $form = $this->createForm(QuackType::class, $quack);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->em->flush();

                return $this->redirectToRoute('quack_index');
            }

            return $this->render('quack/edit.html.twig', [
                'quack' => $quack,
                'form' => $form->createView(),
            ]);

        } else {
            //return $this->redirectToRoute('quack_index');

            $errorMessage = "Pas votre quack!";
            return $this->render('quack/index.html.twig', [
                'quacks' => $this->quackRepository->findAll(),
                'errorMessage' => $errorMessage
            ]);
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/{id}", name="quack_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Quack $quack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quack->getId(), $request->request->get('_token'))) {

            $this->em->remove($quack);
            $this->em->flush();
        }

        return $this->redirectToRoute('quack_index');
    }
}
