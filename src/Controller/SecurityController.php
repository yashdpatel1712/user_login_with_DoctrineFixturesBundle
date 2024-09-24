<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
{
    // $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();
    
    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();
    // dd($lastUsername);

    return $this->render('security/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}

#[Route('/logout', name: 'app_logout')]
    public function logout(): never
    {
        // controller can be blank: it will never be called!
        throw new \Exception('logout');
    }



#[Route('/welcome', name: 'app_welcome')]
public function welcome(): Response
{
    if (!$this->getUser()) {
        return $this->redirectToRoute('login');
    }
    return $this->render('security/welcome.html.twig');
}
}
