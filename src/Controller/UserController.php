<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }


    /**
     * @Route("/User/new", name="create_user")
     */

    public function createUser(): Response{

        if ($request->getMethod() === 'POST') {
            
            $username = $request->get('username');
            $password = $request->get('password');

            $user = new User();

            $user->setUsername($username);
            $user->setPassword($password);

            $this->userRepository->addUser($user);

            $this->addFlash('success', 'User bien ajouter');
            return $this->redirectToRoute('user_show');

        }else{

            return $this->render('User/addUser.html.twig');
        }  
    }



    /**
     * @Route("/User/delete/{id}", name="delete_user")
     * @Method ({"DELETE"})
     */
   
    public function deleteUser($id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $this->userRepository->deleteUser($user);       
        $this->addFlash('success', 'user bien supprimer');
        return $this->redirectToRoute('user_show');
    }

}
