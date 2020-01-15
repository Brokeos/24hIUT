<?php

namespace App\Controller;

use App\Entity\Coffee;
use App\Entity\Commande;
use App\Form\CoffeeType;
use App\Repository\CoffeeRepository;
use App\Repository\CommandeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ExportateurController
 * @package App\Controller
 * @IsGranted("ROLE_EXPORTATEUR")
 * @Route("exportateur")
 */
class ExportateurController extends AbstractController
{
    /**
     * @Route("/commandes/{type}", name="exportateur.commandes", defaults={"type"="enattente"})
     * @param CommandeRepository $commandeRepository
     * @return Response
     */
    public function commandes(CommandeRepository $commandeRepository, $type)
    {

        $commandes = null;

        if ($type == "enattente"){

            $commandes = $commandeRepository->findBy(['exportateur' => $this->getUser(), 'etat' => 'non validee']);

            return $this->render('exportateur/etats/enattente.html.twig', [
                'enattente' => '',
                'commandes' => $commandes,
            ]);

        } elseif ($type == "enpreparation"){

            $commandes = $commandeRepository->findBy(['exportateur' => $this->getUser(), 'etat' => 'en preparation']);

            return $this->render('exportateur/etats/enpreparation.html.twig', [
                'enpreparation' => '',
                'commandes' => $commandes
            ]);

        } elseif ($type == "enattenteexpe"){

            $commandes = $commandeRepository->findBy(['exportateur' => $this->getUser(), 'etat' => 'en attente expedition']);

            return $this->render('exportateur/etats/enattenteexpe.html.twig', [
                'enattenteexpe' => '',
                'commandes' => $commandes
            ]);

        }

    }

    /**
     * @Route("/commande/{commande}/{action}", name="commande.action")
     * @param Commande $commande
     * @param $action
     * @param Request $request
     * @return Response
     */
    public function actionCommande(Commande $commande, $action, Request $request){

        if ($action == "valider"){

            $coffeeType = $commande->getCoffeeType();

            $coffeeType->setQuantity($coffeeType->getQuantity() - $commande->getQuantity());

            $commande->setEtat("en preparation");

        } elseif ($action == "refuser") {

            $coffeeType = $commande->getCoffeeType();

            $coffeeType->setQuantity($coffeeType->getQuantity() + $commande->getQuantity());

            $commande->setEtat("refusee");

        } else if ($action == "validerprepa"){

            $commande->setEtat("en attente expedition");

        } else if ($action == "expedier"){

            $commande->setEtat("expediee");

        }

        $this->getDoctrine()->getManager()->flush();

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }

    /**
     * @Route("/stocks", name="exportateur.stocks", methods={"GET"})
     * @param CoffeeRepository $coffeeRepository
     * @return Response
     */
    public function index(CoffeeRepository $coffeeRepository): Response
    {
        return $this->render('stocks/index.html.twig', [
            'coffees' => $coffeeRepository->findBy(['account' => $this->getUser()]),
        ]);
    }

    /**
     * @Route("/stocks/ajouter", name="exportateur.stocks.add", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $coffee = new Coffee();
        $form = $this->createForm(CoffeeType::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $coffee->setAccount($this->getUser());
            $entityManager->persist($coffee);
            $entityManager->flush();

            return $this->redirectToRoute('exportateur.stocks');
        }

        return $this->render('stocks/new.html.twig', [
            'coffee' => $coffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/stocks/{id}/editer", name="exporateur.stocks.edit", methods={"GET","POST"})
     * @param Request $request
     * @param Coffee $coffee
     * @return Response
     */
    public function edit(Request $request, Coffee $coffee): Response
    {
        $form = $this->createForm(CoffeeType::class, $coffee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exportateur.stocks');
        }

        return $this->render('stocks/edit.html.twig', [
            'coffee' => $coffee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/stocks/{id}", name="exporateur.stocks.del", methods={"GET", "DELETE"})
     * @param Coffee $coffee
     * @return Response
     */
    public function delete(Coffee $coffee): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($coffee);
        $entityManager->flush();

        return $this->redirectToRoute('exportateur.stocks');
    }

}
