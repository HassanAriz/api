<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function getApiUsers()
    {
        $users = $this->userRepository->findAll();
        if($users == NULL) {
            return $this->view(null, Response::204);
        }
        return $this->view($users, Response::200);
    }

    public function postApiUser(User $user){
        $this->em->persist($user);
        $this->em->flush();
        return $this->view($user);}
}
