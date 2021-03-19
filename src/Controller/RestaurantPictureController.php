<?php

namespace App\Controller;
use App\Entity\RestaurantPicture;
use App\Repository\RestaurantPictureRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class RestaurantPictureController extends AbstractController
{

    private $restaurantPictureRepository;

    public function __construct(RestaurantPictureRepository $restaurantPictureRepository)
    {
        $this->restaurantPictureRepository = $restaurantPictureRepository;
    }

    /**
     * @Route("/Restaurant/picture", name="restaurant_picture")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(RestaurantPicture::class);
        $restaurantPictures = $repository->findAll();
        return $this->render('RestaurantPicture/restaurantPicture.html.twig',['restaurantPictures'=>$restaurantPictures]);
    }



    /**
     * @Route("/Restaurant/picture/new", name="create_restaurantPicture")
     */

    public function createRestaurantPicture(): Response{

        if ($request->getMethod() === 'POST') {
            
            $filename = $request->get('filename');
            $restaurant_id = $request->get('restaurant_id');

            $restaurantPicture = new RestaurantPicture();

            $restaurantPicture->setFilename($filename);
            $restaurantPicture->getRestaurantId($restaurant_id);

            $this->restaurantPictureRepository->addRestaurantPicture($restaurantPicture);

            $this->addFlash('success', 'Picture bien ajouter');
            return $this->redirectToRoute('restaurantPicture_show');

        }else{

            return $this->render('RestaurantPicture/addRestaurantPicture.html.twig');
        }  
    }



    /**
     * @Route("/Restaurant/picture/delete/{id}", name="delete_RestaurantPicture")
     */
   
    public function deleteRestaurantPicture($id){
        $restaurantPicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
        $this->restaurantPictureRepository->deleteRestaurantPicture($restaurantPicture);       
        $this->addFlash('success', 'Restaurant Picture bien supprimer');
        return $this->redirectToRoute('restaurantPicture_show');
    }


    /**
     * @Route("/Restaurant/picture/update/{id}", name="update_restaurantPicture", methods={"GET","POST"})
     */
    public function updateRestaurantPicture(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher RestaurantPicture
            $restaurantPicture = $this->getDoctrine()->getRepository(RestaurantPicture::class)->find($id);
            
            // modifier RestaurantPicture
            $filename = $request->get('filename');
            $restaurant_id = $request->get('restaurant_id');

            $restaurantPicture->setFilename($filename);
            $restaurantPicture->getRestaurantId($restaurant_id);

            $this->restaurantPictureRepository->updateRestaurantPicture();
            
            $this->addFlash('success', 'Restaurant Picture bien modifier');
            return $this->redirectToRoute('restaurantPicture_show');

        }else{
            return $this->render('RestaurantPicture/updateRestaurantPicture.html.twig');
        }
    }


     /**
     * @Route("/Restaurant/picture/show/{id}", name="show_restaurantPicture")
     */
   
    public function showRestaurantPicture($id){
        $repository = $this->getDoctrine()->getRepository(RestaurantPicture::class);
        $restaurantPicture = $repository->find($id);
        return $this->render('RestaurantPicture/showRestaurantPicture.html.twig',['restaurantPicture'=>$restaurantPicture]);
    }



}
