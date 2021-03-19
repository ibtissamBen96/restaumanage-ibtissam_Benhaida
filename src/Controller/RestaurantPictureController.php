<?php

namespace App\Controller;
use App\Entity\RestaurantPicture;
use App\Repository\RestaurantPictureRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantPictureController extends AbstractController
{

    private $restaurantPictureRepository;

    public function __construct(RestaurantPictureRepository $restaurantPictureRepository)
    {
        $this->restaurantPictureRepository = $restaurantPictureRepository;
    }

    /**
     * @Route("/restaurant/picture", name="restaurant_picture")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RestaurantPictureController.php',
        ]);
    }



    /**
     * @Route("/RestaurantPicture/new", name="create_restaurantPicture")
     */

    public function createRestaurantPicture(): Response{

        if ($request->getMethod() === 'POST') {
            
            $filename = $request->get('filename');
            $restaurantPicture = new RestaurantPicture();

            $restaurantPicture->setFilename($filename);

            $this->restaurantPictureRepository->addRestaurantPicture($restaurantPicture);

            $this->addFlash('success', 'Picture bien ajouter');
            return $this->redirectToRoute('RestaurantPicture_show');

        }else{

            return $this->render('RestaurantPicture/addRestaurantPicture.html.twig');
        }  
    }


}
