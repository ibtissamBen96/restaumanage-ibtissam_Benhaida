<?php

namespace App\Controller;
use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{

    private $restaurantRepository;

    public function __construct(RestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @Route("/Restaurant", name="restaurant")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaurants = $repository->findAll();
        return $this->render('Restaurant/Restaurant.html.twig',['restaurants'=>$restaurants]);
    }



    /**
     * @Route("/Restaurant/new", name="create_restaurant")
     */

    public function createRestaurant(): Response{

        if ($request->getMethod() === 'POST') {
            
            $name = $request->get('name');
            $description = $request->get('description');
            $created_at = $request->get('created_at');
            $city_id = $request->get('city_id');


            $restaurant = new Restaurant();
            $restaurant->setName($name);
            $restaurant->setDescription($description);
            $restaurant->setCreated_at($created_at);
            $restaurant->setCityId($city_id);


            $this->restaurantRepository->addRestaurant($restaurant);

            $this->addFlash('success', 'restaurant bien ajouter');
            return $this->redirectToRoute('restaurant_show');

        }else{

            return $this->render('Restaurant/addRestaurant.html.twig');
        }  
    }


      /**
     * @Route("/Restaurant/delete/{id}", name="delete_restaurant")
     */
   
    public function deleteRestaurant($id){
        $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
        $this->restaurantRepository->deleteRestaurant($restaurant);       
        $this->addFlash('success', 'restaurant bien supprimer');
        return $this->redirectToRoute('restaurant_show');
    }


    /**
     * @Route("/Restaurant/update/{id}", name="update_restaurant", methods={"GET","POST"})
     */
    public function updateRestaurant(Request $request,$id): Response
    {
        if ($request->getMethod() === 'POST')
        {
            // chercher Restaurant
            $restaurant = $this->getDoctrine()->getRepository(Restaurant::class)->find($id);
            
            // modifier Restaurant
            $name = $request->get('name');
            $description = $request->get('description');
            $created_at = $request->get('created_at');
            $city_id = $request->get('city_id');


            $restaurant->setName($name);
            $restaurant->setDescription($description);
            $restaurant->setCreated_at($created_at);
            $restaurant->setCityId($city_id);


            $this->restaurantRepository->updateRestaurant();
            
            $this->addFlash('success', 'Restaurant  bien modifier');
            return $this->redirectToRoute('restaurant_show');

        }else{
            return $this->render('Restaurant/updateRestaurant.html.twig');
        }
    }

    /**
     * @Route("/Restaurant/show/{id}", name="show_restaurant")
     */
   
    public function showRestaurant($id){
        $repository = $this->getDoctrine()->getRepository(Restaurant::class);
        $restaurant = $repository->find($id);
        return $this->render('Restaurant/showRestaurant.html.twig',['restaurant'=>$restaurant]);
    }

}
