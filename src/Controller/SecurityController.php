<?php

namespace App\Controller;

use App\Entity\Account;
use App\Form\AccountType;
use App\Repository\GroupeRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="security.login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', [
            'error' => $error
        ]);
    }

    /**
     * @Route("/register", name="security.register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GroupeRepository $groupeRepository
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GroupeRepository $groupeRepository)
    {

        $account = new Account();
        $form = $this->createForm(AccountType::class, $account);

        $form->handleRequest($request);

        $role = $request->get("role", "");

        if ($form->isSubmitted() && $form->isValid() && ($role == "ROLE_IMPORTATEUR" || "ROLE_EXPORTATEUR") ) {

            $password = $passwordEncoder->encodePassword($account, $account->getPlainPassword());

            $account->setPassword($password);
            $account->setRole($role == "ROLE_IMPORTATEUR" ? $groupeRepository->getImportateurRole() : $groupeRepository->getExportateurRole());

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($account);
            $entityManager->flush();

            return $this->render('security/register.html.twig',[
                'form' => $form->createView(),
                'success' => 'true'
            ]);

        }

        return $this->render('security/register.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/logout", name="security.logout")
     * @throws Exception
     */
    public function logout()
    {

        throw new Exception("Déconnexion");

    }

}
