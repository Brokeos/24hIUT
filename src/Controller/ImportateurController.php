<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Country;
use App\Form\CommandeType;
use App\Repository\CoffeeRepository;
use App\Repository\CommandeRepository;
use App\Repository\CountryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ImportateurController
 * @package App\Controller
 * @IsGranted("ROLE_IMPORTATEUR")
 * @Route("/importateur")
 */
class ImportateurController extends AbstractController
{

    /**
     * @Route("/commander", name="importateur.map")
     * @param CountryRepository $countryRepository
     * @return Response
     */
    public function map(CountryRepository $countryRepository){

        $countries = $countryRepository->findAll();

        return $this->render('importateur/map.html.twig', [
            'countries' => $countries
        ]);

    }

    /**
     * @Route("/commander/{country}", name="importateur.commander", defaults={"country"="1"})
     * @param Request $request
     * @param CoffeeRepository $coffeeRepository
     * @param Country $country
     * @return Response
     * @throws \Exception
     */
    public function commander(Request $request, CoffeeRepository $coffeeRepository, Country $country)
    {

        $coffees = $coffeeRepository->findAll();
        $coffesR = array();

        foreach ($coffees as $coffee){

            if ($coffee->getCountry()->contains($country)){

                array_push($coffesR, $coffee);

            }

        }

        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);

        $form->handleRequest($request);

        if ($form->isSubmitted()){

            $coffee = $request->get('selected_coffee');
            $coffee = $coffeeRepository->findOneBy(['id' => $coffee]);

            $commande->setCoffeeType($coffee);
            $commande->setExportateur($coffee->getAccount());
            $commande->setCountry($country);
            $commande->setEtat("non validee");
            $commande->setDateCommande(new \DateTime('now'));
            $commande->setImportateurId($this->getUser());

            $this->getDoctrine()->getManager()->persist($commande);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('importateur.commandes');

        }

        return $this->render('importateur/commander.html.twig', [
            'form' => $form->createView(),
            'coffees' => $coffesR
        ]);
    }

    /**
     * @Route("/commandes", name="importateur.commandes")
     * @param CommandeRepository $commandeRepository
     * @return Response
     */
    public function commandes(CommandeRepository $commandeRepository)
    {

        $commandes = $commandeRepository->findBy(['importateur_id' => $this->getUser()]);

        return $this->render('importateur/commandes.html.twig', [
            'commandes' => $commandes
        ]);
    }
}
