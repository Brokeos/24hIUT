<?php

namespace App\Controller;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaysController extends AbstractController
{
    /**
     * @Route("/pays", name="pays")
     * @param CountryRepository $countryRepository
     * @return Response
     */
    public function map(CountryRepository $countryRepository){

        $countries = $countryRepository->findAll();
        $countriesTotal = array();

        foreach($countries as $country){

            array_push($countriesTotal, $country->getFlag());

            $countriesTotal[$country->getFlag()] = 0;

            foreach ($country->getCoffees() as $coffee){

                $countriesTotal[$country->getFlag()] += $coffee->getQuantity();

            }

        }

        return $this->render('pays/index.html.twig', [
            'countries' => $countries,
            'countriesTotal' => $countriesTotal
        ]);

    }

    /**
     * @Route("/pays/{id}", name="pays.show")
     * @param Country $country
     * @return Response
     */
    public function show(Country $country){

        return $this->render('pays/show.html.twig', [
            'country' => $country
        ]);

    }

}
