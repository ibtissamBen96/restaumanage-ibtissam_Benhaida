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
     * @Route("/User", name="user")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('User/User.html.twig',['users'=>$users]);
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


    /**
     * @Route("/User/update/{id}", name="update_user", methods={"GET","POST"})
     */
    public function updateUser(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher User
            $user = $this->getDoctrine()->getRepository(User::class)->find($id);
            
            // modifier User
            $name = $request->get('name');
            $zipcode = $request->get('zipcode');
            
            $user->setName($name);
            $user->setZipcode($zipcode);
            
            $this->cityRepository->updateCity();
            $this->addFlash('success', 'city bien ajouter');
            return $this->redirectToRoute('city_show');

        }else{
            return $this->render('City/updateCity.html.twig');
        }
    }


    /**
     * @Route("/User/show/{id}", name="show_user")
     */
   
    public function showUser($id){
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->find($id);
        return $this->render('User/showUser.html.twig',['user'=>$user]);
    }


}
